<?php
session_start();
ini_set('memory_limit', '128M');
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
    $sql = "SELECT * FROM events WHERE approved=1";
    $result = $conn->query($sql);
    if($result){
      $toReturn['events'] = $result->fetch_all();
    }
    else{
      $toReturn['error'] = "Couldn't get from database";
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
    if(isset($_FILES['image'])){
      //handle the image here
      if($_FILES['image']['error'] === UPLOAD_ERR_OK){
        //case where image was recieved correctly
        if(preg_match("/image\/(jpe?g|png|gif|bmp)/", $_FILES['image']['type']) == 1){
          //it is indeed an image
          $tmp_name = $_FILES['image']['tmp_name'];
          $toReturn['session'] = $_SESSION;
          if($_SESSION['user_type'] == "admin" OR $_SESSION['user_type'] == "staff"){
            $sql = "INSERT INTO events (title, date, time, place, approved) VALUES('$title', '$date', '$time', '$place', 1)";

            if($conn->query($sql)){
              $toReturn['success'] = "event created";
            }
          }
          else{
            $sql = "INSERT INTO events (title, date, time, place, approved) VALUES('$title', '$date', '$time', '$place', 0)";
            if($conn->query($sql)){
              $toReturn['success'] = "event created";
            }
            else{
              echo $sql;
            }
          }
        }
        else{
          echo "file was not image it was" . $_FILES['image']['type'];
        }
      }
      else{
        echo "image was not uploaded correctly";
      }
    }
    else{
      if($_SESSION['user_type'] == 'admin' OR $_SESSION['user_type'] == "staff"){
        $sql = "INSERT INTO events (title, date, time, place, approved) VALUES('$title', '$date', '$time', '$place', 1)";
        if($conn->query($sql)){
          $toReturn['success'] = "event created";
        }
      }
      else{
        $sql = "INSERT INTO events (title, date, time, place, approved) VALUES('$title', '$date', '$time', '$place', 0)";
        if($conn->query($sql)){
          $toReturn['success'] = "event created";
        }
      }
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
