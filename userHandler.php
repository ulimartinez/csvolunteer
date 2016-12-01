<?php
  $toReturn = array();
  require("config.php");
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  if(isset($_POST['staff'])){
    $id = $_POST['utepid'];
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    if($password === $password2){
      require_once 'php/random/lib/random.php';
      $salt = bin2hex(random_bytes(6));
      $password2 = $password2 . $salt;
      $password2 = md5($password2);
      $sql = "INSERT INTO staff_faculty (utep_id, first_name, last_name, phone_number, password, salt, email, username) VALUES($id, '$fname', '$lname', '$phone', '$password2', '$salt', '$email', '$username')";
      $result = $conn->query($sql);
      if($result){
        $toReturn['success'] = "User created";
      }
    }
    else{
      $toReturn['error'] = "Could not create user";
    }
  }
  else if(isset($_POST['admin'])){
    $username = $_POST['username'];
    $password = $_POST['password'];

    if(true){
      require_once 'php/random/lib/random.php';
      $salt = bin2hex(random_bytes(6));
      $password = $password . $salt;
      $password = md5($password);
      $sql = "INSERT INTO administrators (username, password, salt) VALUES('$username', '$password', '$salt')";
      $result = $conn->query($sql);
      if($result){
        $toReturn['success'] = "User created";
      }
    }
    else{
      $toReturn['error'] = "Could not create user";
    }
  }
  $conn->close();
  header('Content-Type: application/json');
  echo json_encode($toReturn);
?>
