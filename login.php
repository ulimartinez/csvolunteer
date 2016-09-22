<?php
    session_start();
    if(isset($_POST['username'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($username === "admin" AND $password === "admin1") {
          $_SESSION['admin'] = true;
        }
        else if($username === "user" AND $password === "user1"){
          $_SESSION['admin'] = false;
        }
        else {
          echo "Invalid Credentials.";
          exit();
        }
        $_SESSION['loggedin'] = true;
        header('Location: index.php');
    }
?>
