<?php
		
	include 'functions.php';
	//start session
	session_start();	

	//get username and password from $_POST
	$username = sanitizeString($_POST["username"]);
	$password = sanitizeString($_POST["password"]);

	$dbhost = "localhost";	
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "myDB";

	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	if( mysqli_connect_errno($conn)){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}




	$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
	//$result = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND password='$password'");

	$num_of_rows = mysqli_num_rows($result);
	//Check in the DB



	if($num_of_rows > 0){
		while ($row = $result->fetch_assoc()){
			if( $password_verified = password_verify( $password, $row['Password'])){
				break;
			}
		}
		if($password_verified){
			$_SESSION["username"] = $username;
			header("Location: feed.php");
		}else{
			echo "Password not found, try again";
		}
		
	}else{
		//else ask to login again..	
		echo "Username not found, try again";

	}
?>