<?php
require_once 'php/random/lib/random.php';
    $toReturn = array();
	if(true){
		$username = "jlopez";
		$password = "jlopez1";
			$salt = bin2hex(random_bytes(6));
			$password = $password . $salt;
			$password = md5($password);
			require('config.php');
			$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
            if ($conn -> connect_error) {
                die("Connection failed: " . $conn -> connecterror);
            }
            $sql = "INSERT INTO staff_faculty (utep_id, first_name, last_name, password, salt, email, username) VALUES(80512346, 'Juan', 'Lopez', '$password', '$salt', 'ericar@example.com', '$username')";
            $response = $conn -> query($sql);
            $toReturn['response'] = $response;
            $toReturn['sql'] = $sql;
	}
	//header('Location: admin.php');
	echo json_encode($toReturn);
  $conn->close();
?>
