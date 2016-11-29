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
      $toReturn['students'] = $result->fetch_all();
    }
    else{
      $toReturn['error'] = "Couldn't get from database";
    }
  }
}
else if($_SERVER['REQUEST_METHOD'] == 'POST'){
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
