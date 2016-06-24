<?php


	/*
	problems:
	pic not being passed to the database!
	no date being passed
	sanitation doesn't work
	*/


	//include files
	include "functions.php";


	//get user inputs from the html form
	$name 		= sanitizeString($_POST["name"]);
	$location 	= sanitizeString($_POST["location"]);
	$gender 	= sanitizeString($_POST["gender"]);
	$username 	= sanitizeString($_POST["username"]);
	$password 	= sanitizeString($_POST["password"]);
	$email 		= sanitizeString($_POST["email"]);
	$pic 		= sanitizeString($_POST["pic"]);  
	$dob 		= sanitizeString($_POST["dob"]);    
	$verification_question 	= sanitizeString($_POST["verification_question"]);
	$verification_answer 	= sanitizeString($_POST["verification_answer"]);

	$dbhost = "localhost";	
	$dbuser = "root";
	$dbpass = "root";
	$dbname = "myDB";


	//convert password to hash
	$password = password_hash($password, PASSWORD_BCRYPT);

	
	//Connect to database
	$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

	if( mysqli_connect_errno($conn)){
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	
	//formulate query
	$sql = "INSERT INTO users (name, location, gender, username, password, email, dob, verification_question, verification_answer) 
	VALUES ('$name', '$location', '$gender', '$username', '$password', '$email', $dob,'$verification_question', '$verification_answer')";

	if ($conn->query($sql) === TRUE) {
  		echo "New record created successfully";
	} else {
    	echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
?>

