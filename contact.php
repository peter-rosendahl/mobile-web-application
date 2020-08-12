<?php
	session_start();

	// connection to db
	$db = include ('connect.php');

	if (!$db) {
    	die("Connection failed: " . mysqli_connect_error());
	}

	if (isset($_POST['contact_submit'])){


		$name = $_POST['name'];
  		$email = $_POST['email'];

		$message = $_POST['message'];
  		

		// check that the email is valid
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
			$error = true;
			$email_error = "Please Enter Valid Email";
		}

		//$sql = "INSERT INTO mwa_contact (name, email, message) VALUES ('$name', '$email', '$message')";
		if ( 2 == 2 /*mysqli_query($db, $sql)*/) {
		    header("Location: index.php");
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($db);
		}; //end if-statement
	}; // end post if-statement
	mysqli_close($db);	
?>

