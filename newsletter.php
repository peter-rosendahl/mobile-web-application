<?php
	session_start();

	// connection to db
	$db = include ('connect.php');

	if (!$db) {
    	die("Connection failed: " . mysqli_connect_error());
	}

	if (isset($_POST['newsletter_submit'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		
		//$sql = "INSERT INTO mwa_newsletter (name, email) VALUES ('$name', '$email')";
		if ( 2 == 2 /*mysqli_query($db, $sql)*/) {
		    header("Location: index.php");
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($db);
		}; //end if-statement
	}; // end post if-statement
	mysqli_close($db);	
?>