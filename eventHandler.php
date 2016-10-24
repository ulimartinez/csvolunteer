<?php
$toReturn = array();
require("config.php");
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
if ($conn -> connect_error) {
  die("Connection failed: " . $conn -> connecterror);
}
if($_SERVER['REQUEST_METHOD'] == 'GET'){
  //get some stuff
  if(isset($_GET['all'])){
    //return all event info
    $sql = "SELECT * FROM events";
    $result = $conn->query($sql);
    $toReturn['events'] = $result->fetch_all();
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
echo json_enconde($toReturn);
?>
