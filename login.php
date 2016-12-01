<?php
    include('classes/User.class.php');
    session_start();
    if(isset($_POST['submit'])){
      $user = new User($_POST['username'], $_POST['password']);
      if($user->login()){
        header("Location: " . $user->getHome());
      }
    }
    else if(isset($_POST['register'])){
      $fname = $_POST['first-name'];
      $lname = $_POST['last-name'];
      $id = $_POST['utep-id'];
      $phone = $_POST['phone'];
      $dob = $_POST['dob'];
      $username = $_POST['username'];
      $password = $_POST['password'];
      $password2 = $_POST['password2'];
      $mail = $_POST['email'];
      $class = $_POST['class'];
      $tmp_name = "";

      $user = new User($username, $password);
      if($user->register($fname, $lname, $id, $phone, $dob, $mail, $class, $password2)){
        if(isset($_FILES['file'])){
          //handle the image here
          if($_FILES['file']['error'] === UPLOAD_ERR_OK){
            //case where image was recieved correctly
            if(preg_match("/image\/(jpe?g|png|gif|bmp)/", $_FILES['file']['type']) == 1){
              //it is indeed an image
              $tmp_name = $_FILES['file']['tmp_name'];
              if($user->addImage($tmp_name)){
                header('Location: ' . $user->getHome());
              }
              else{
                echo "image could not be stored to database";
              }
            }
            else{
              echo "file was not image it was" . $_FILES['file']['type'];
            }
          }
          else{
            echo "image was not uploaded correctly";
          }
        }
      }
    }
    else if(isset($_GET['logout']) AND $_GET['logout']){
      $_SESSION = array();
      header("Location: index.php");
    }
?>
