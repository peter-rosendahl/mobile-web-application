<?php
	// connection to db

	$servername = "mysql47.unoeuro.com";
	$username = "prmedia_dk";
	$password = "T1e2nnis8903";
	$databasename = "prmedia_dk_db";	

	// Create connection
	$conn = new mysqli($servername, $username, $password, $databasename);

	if (mysqli_connect_errno()) 
	  {
	     echo 'Error: Could not connect to database.  Please try again later.';
	     exit;
	  }
	  return $conn;
	  
	// Change character set to utf8
	mysqli_set_charset($conn,"utf8");

?>