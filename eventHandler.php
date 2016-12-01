<?php
session_start();
ini_set('memory_limit', '128M');

function finishEventCreate($id, $slots, $skills){
  include_once 'classes/Event.class.php';
  $event = new Event($id, $slots, $skills);
  if($event->addData()){
    $arr = array();
    $arr['success'] = "event created";
    header('Content-Type: application/json');
    echo json_encode($arr);
  }
}
$toReturn = array();
require("config.php");
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if($_SERVER['REQUEST_METHOD'] == 'GET'){
  //get some stuff
  if(isset($_GET['all'])){
    //return all event info
    $sql = "SELECT id, title, `date`, place, description FROM events WHERE approved=1";
    $result = $conn->query($sql);
    if($result){
      $toReturn['events'] = $result->fetch_all();
    }
    else{
      $toReturn['error'] = "Couldn't get from database";
    }
  }
  else if(isset($_GET['range'])){
    //return all event info
    $start = $_GET['start'];
    $end = $_GET['end'];
    $sql = "CALL eventBetween('$start', '$end')";
    $result = $conn->query($sql);
    if($result){
      $toReturn['events'] = array();
      $rows = $result->fetch_all();
      foreach ($rows as $row) {
        $row[13] = base64_encode($row[13]);
        array_push($toReturn['events'], $row);
      }
    }
    else{
      $toReturn['error'] = "Couldn't get from database";
    }
  }
  else if(isset($_GET['image'])){
    $id = $_GET['event_id'];
    $sql = "SELECT photo FROM events WHERE id=$id";
    $result = $conn->query($sql);
    if($result){
      $toReturn['photo'] = base64_encode($result->fetch_array()[0]);
    }
  }
}
else if($_SERVER['REQUEST_METHOD'] == 'POST'){
  //update some stuff
  if(isset($_POST['create'])){
    //creating a new event
    $title = $conn->real_escape_string($_POST['title']);
    $place = $conn->real_escape_string($_POST['place']);
    $datetime = $_POST['datetime'];
    $datetime = explode(' ', $datetime);
    $date = $datetime[0];
    $time = $datetime[1];
    $tmp_name = "";
    $slots = $_POST['slots'];
    $skills = $_POST['skills'];
    $description = $_POST['description'];
    if(isset($_FILES['image'])){
      //handle the image here
      if($_FILES['image']['error'] === UPLOAD_ERR_OK){
        //case where image was recieved correctly
        if(preg_match("/image\/(jpe?g|png|gif|bmp)/", $_FILES['image']['type']) == 1){
          //it is indeed an image
          $tmp_name = $_FILES['image']['tmp_name'];
          if($_SESSION['user_type'] == "admin" OR $_SESSION['user_type'] == "staff"){
            $sql = "INSERT INTO events (title, date, time, place, approved, photo, description) VALUES('$title', '$date', '$time', '$place', 1, '".$conn->real_escape_string(file_get_contents($tmp_name))."', '$description')";
            if($conn->query($sql)){
              $insert_id = $conn->insert_id;
              finishEventCreate($insert_id, $slots, $skills);
            }
          }
          else{
            $sql = "INSERT INTO events (title, date, time, place, approved, photo, description, student_utep_id) VALUES('$title', '$date', '$time', '$place', 0, '".$conn->real_escape_string(file_get_contents($tmp_name))."', '$description', ".$_SESSION['user_id'].")";
            if($conn->query($sql)){
              $insert_id = $conn->insert_id;
              finishEventCreate($insert_id, $slots, $skills);
            }
            else{
              $toReturn['sql'] = $sql;
            }
          }
        }
        else{
          $toReturn['error'] = "file was not image it was" . $_FILES['image']['type'];
        }
      }
      else{
        $toReturn['error'] = "image was not uploaded correctly";
      }
    }
    else{
      if($_SESSION['user_type'] == 'admin' OR $_SESSION['user_type'] == "staff"){
        $sql = "INSERT INTO events (title, date, time, place, approved, description, student_utep_id) VALUES('$title', '$date', '$time', '$place', 1, '$description', ".$_SESSION['user_id'].")";
        if($conn->query($sql)){
          $insert_id = $conn->insert_id;
          finishEventCreate($insert_id, $slots, $skills);
        }
      }
      else{
        $sql = "INSERT INTO events (title, date, time, place, approved, description) VALUES('$title', '$date', '$time', '$place', 0, '$description')";
        if($conn->query($sql)){
          $insert_id = $conn->insert_id;
          finishEventCreate($insert_id, $slots, $skills);
        }
      }
    }
  }
  else if(isset($_POST['approve'])){
    $eventid = $_POST['eventid'];
    $sql = "UPDATE events SET approved=1 WHERE id = $eventid";
    $result = $conn->query($sql);
    if($result){
      $toReturn['success'] = "approved";
    }
    else{
      $toReturn['error'] = "Something went wrong";
    }
  }
  else if(isset($_POST['participate'])){
    // user participate
    $userid = $_POST['userid'];
    $eventid = $_POST['eventid'];
    $timeid = $_POST['timeid'];
    $hours = $_POST['hours'];
    $sql = "INSERT INTO participate VALUES($userid, $eventid, $timeid, $hours)";
    $result = $conn->query($sql);
    if($result){
      $toReturn['success'] = "participating";
    }
    else{
      $toReturn['error'] = "You are already participating in this event";
    }
  }
  else if(isset($_POST['delete'])){
    $id = $_POST['eventid'];
    $sql = "DELETE FROM events WHERE id=$id";
    $result = $conn->query($sql);
    if($result){
      $toReturn['success'] = "deleted";
    }
  }
}
else if($_SERVER['REQUEST_METHOD'] == 'PUT'){
  //create some stuff
}
else if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
  //delete some stuff
}
$conn->close();
header('Content-Type: application/json');
echo json_encode($toReturn);
?>
