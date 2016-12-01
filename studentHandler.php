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
    $sql = "SELECT * FROM students";
    $result = $conn->query($sql);
    if($result){
      $toReturn['students'] = array();
      $rows = $result->fetch_all();
      foreach ($rows as $row) {
        $row[11] = base64_encode($row[11]);
        array_push($toReturn['students'], $row);
      }
    }
    else{
      $toReturn['error'] = "Couldn't get from database";
    }
  }
}
else if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(isset($_POST['delete'])){
    $id = $_POST['userid'];
    $sql = "DELETE FROM students WHERE utep_id=$id";
    $result = $conn->query($sql);
    if($result){
      $toReturn['success'] = "Deleted";
    }
  }
  //update some stuff
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
