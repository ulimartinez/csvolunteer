<?php
class User{
    protected $_username;    // using protected so they can be accessed
    protected $_password; // and overidden if necessary

    protected $_user;     // stores the user data

    public function __construct($username, $password) {
       $this->_username = $username;
       $this->_password = $password;
    }

    public function login(){
        session_start();
        $user = $this->_checkCredentials();
        if ($user) {
            $this->_user = $user; // store it so it can be accessed later
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['type'];
            return $user['id'];
        }
        return false;
    }
    public function register($fname, $lname, $id, $phone, $dob, $email, $class, $password2, $tmp_name){
      include('utils.php');
      if(checkEmpty($fname) OR checkEmpty($lname) OR checkEmpty($id) OR checkEmpty($dob) OR checkEmpty($email) OR checkEmpty($password2)){
        echo "Must imput all values";
        return false;
      }
      else if(!is_numeric($id)){
        echo "invalid Id";
        return false;
      }
      else if($this->_password !== $password2){
        echo "Passwords do not match " . $this->_password . " and " . $password2;
        return false;
      }
      else{
        require('config.php');
        require_once 'php/random/lib/random.php';

        $salt = bin2hex(random_bytes(6));
  			$password2 = $password2 . $salt;
  			$password2 = md5($password2);

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
        if ($conn -> connect_error) {
            die("Connection failed: " . $conn -> connect_error);
        }
        $fname = $conn->real_escape_string($fname);
        $lname = $conn->real_escape_string($lname);
        $id = $conn->real_escape_string($id);
        $email = $conn->real_escape_string($email);
        $dob = $conn->real_escape_string($dob);
        $phone = $conn->real_escape_string($phone);
        $username = $conn->real_escape_string($this->_username);
        if(checkEmpty($tmp_name)){
          $sql = "INSERT INTO students (utep_id, first_name, last_name, phone_number, username, password, salt, email, classification, dob) VALUES($id, '$fname', '$lname', '$phone', '$username', '$password2', '$salt', '$email', '$class', '$dob')";
        }
        else{
          $sql = "INSERT INTO students (utep_id, first_name, last_name, phone_number, username, password, salt, email, classification, dob, photo) VALUES($id, '$fname', '$lname', '$phone', '$username', '$password2', '$salt', '$email', '$class', '$dob', '" . $conn->real_escape_string(file_get_contents($tmp_name)) ."')";
        }
        if($conn->query($sql)){
          return login();
        }
        else{
          echo "something went wrong";
          return false;
        }
      }
    }

    public function addImage($filename){
      echo "<br/>";
      print_r($this->getUser());
      //$sql = "UPDATE students SET photo = '" . mysql_escape_string(file_get_contents($filename)) . "' WHERE utep_id = " . $this->_user['utep_id'];
      //echo $sql;
    }

    protected function _checkCredentials(){
      require('config.php');
      $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
      if ($conn -> connect_error) {
          die("Connection failed: " . $conn -> connect_error);
      }
      $username = $conn->real_escape_string($this->_username);
      $sql = "SELECT * FROM login WHERE username = '$username'";
      $result = $conn->query($sql);
      if($result && $result->num_rows > 0){
        $user = $result->fetch_assoc();
        $salt = $user['salt'];
        $hash = md5($this->_password . $salt);
        if($hash === $user['password']){
            $conn->close();
            return $user;
        }
        else{
          $conn->close();
          return false;
        }
      }
    }

    public function getUser(){
        return $this->_user;
    }

    public function getHome(){
      $type = $this->_user['type'];
      if($type === "admin"){
        return "adminPanel.php";
      }
      else{
        return "index.php";
      }
    }
}
?>
