<?php
session_start();

if(isset($_SESSION['usr_id'])) {
	header("Location: index.php");
}

$db = include ('connect.php');

//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
	//if the form is submitted place the superglobal values 
	//into small manageable variables with special character escaped. 
	$fname = mysqli_real_escape_string($db, $_POST['fname']);
	$lname = mysqli_real_escape_string($db, $_POST['lname']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password = mysqli_real_escape_string($db, $_POST['password']);
	$cpassword = mysqli_real_escape_string($db, $_POST['cpassword']);
	$memberid = mysqli_real_escape_string($db, $_POST['memberid']);
	$campus = mysqli_real_escape_string($db, $_POST['campus']);
	$phone = mysqli_real_escape_string($db, $_POST['phone']);
	$address = mysqli_real_escape_string($db, $_POST['address']);
	$city = mysqli_real_escape_string($db, $_POST['city']);
	$postalCode = mysqli_real_escape_string($db, $_POST['postalCode']);
	$country = mysqli_real_escape_string($db, $_POST['country']);
	
	
	//check that first and last names contains only alpha characters and spaces
	if (!preg_match("/^[a-zA-ZæøåÆØÅ ]+$/",$fname)) {
		$error = true;
		$fname_error = "First name must contain only alphabet characters and spaces";
	}
	if (!preg_match("/^[a-zA-ZæøåÆØÅ ]+$/",$lname)) {
		$error = true;
		$lname_error = "Last name must contain only alphabet characters and spaces";
	}
	// check that the email is valid
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Please Enter Valid Email";
	}
	// check password is at least 6 characters long
	if(strlen($password) < 6) {
		$error = true;
		$password_error = "Password must be minimum of 6 characters";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
	}
	if (!preg_match("/^[1-9][0-9]*$/",$memberid) || strlen($memberid) != 6) {
		$error = true;
		$memberid_error = "ID must contain only 6 numeric characters without spaces";
	}
	if (!preg_match("/^[1-9][0-9]*$/",$phone) || strlen($phone) < 8) {
		$error = true;
		$phone_error = "Phone must contain minimum 8 numeric characters without spaces";
	}
	if (!preg_match("/^[a-zA-ZæøåÆØÅ0-9\s\,\.\-_\?:]{1,128}$/",$address)) {
		$error = true;
		$address_error = "Address must contain only alphabet and numeric characters and spaces";
	}
	if (!preg_match("/^[a-zA-ZæøåÆØÅ ]+$/",$city)) {
		$error = true;
		$city_error = "City must contain only alphabet characters and spaces";
	}
	if (!preg_match("/^[1-9][0-9]*$/",$postalCode) || strlen($postalCode) < 4) {
		$error = true;
		$postalCode_error = "Postal Code must contain minimum 4 numeric characters without spaces";
	}
	if (!preg_match("/^[a-zA-ZæøåÆØÅ ]+$/",$country)) {
		$error = true;
		$country_error = "Country must contain only alphabet characters and spaces";
	}
	//If all the fields were filled corrected process form data 
	if (!$error) {
		//check that the user is not already registered, checking by unique email  
		$querycheckexist= "SELECT * FROM test_users WHERE email = '" . $email. "'";
    	$result = mysqli_query($db, $querycheckexist);
    	if(mysqli_num_rows($result)>0){
    		$errormsg = "You are already registered, proceed to login";
    	}else{
    		// Insert new user into the database 
    		//$query = "INSERT INTO agora_users(id,fname,lname,email,password,memberid,campus,phone,address,city,postal,country) VALUES('','" . $fname . "', '" . $lname . "', '" . $email . "', '" . sha1($password) . "', '" . $memberid . "', '" . $campus . "', '" . $phone . "', '" . $address . "', '" . $city . "', '" . $postalCode . "', '" . $country . "')";
			//if(mysqli_query($db, $query)) {
			//	$successmsg = "Successfully Registered! <a href='login.php'>Click here to Login</a>";
			//} else {
				$errormsg = "Error in registering...Please try again later!";
				echo 'Error: ' . $query . '<br>' . $conn->error;
			//}
		}
	}
}
?>

<!DOCTYPE html>

<html>
	<head>
		
		<!-- Website Title & Description for Search Engine purposes -->
		<title>Test Labs</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta name="description" content="Test Labs - book a session for using some of our creative tools on your current project. Currently only avaliable on SDU Kolding and for SDU students and employees only.">
		<link rel="shortcut icon" type="image/png" href="favicon.png"/>
		<!-- Mobile viewport optimized -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- Bootstrap CSS -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="includes/css/bootstrap-glyphicons.css" rel="stylesheet">
		
		<!-- Custom CSS -->
		<link rel="stylesheet" href="includes/css/styles.css">
		<link rel="stylesheet" href="includes/css/social.css">
	</head>
	<body>
	
		<div class="container" id="main"> <!-- Main Content excl. community -->
		
			<div class="navbar navbar-fixed-top"> <!-- Navigation -->
				<div class="container">
					
					<!-- .btn-navbar is used as the toggle for collapsed navbar content -->
					<button class="navbar-toggle" data-target=".navbar-responsive-collapse" data-toggle="collapse" type="button">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				
					<a class="navbar-brand" href="index.php"><img src="images/test_logo.png" alt="Your Logo"></a>
					
					<div class="nav-collapse collapse navbar-responsive-collapse white">
						<ul class="nav navbar-nav">
							<li>
								<a href="index.php#bigCallout">Welcome</a>
							</li>
							<li>
								<a href="index.php#portfolio">Portfolio</a>
							</li>
							<li>
								<a href="index.php#moreInfo">Contact</a>
							</li>
						</ul>
						
						<ul class="nav navbar-nav pull-right white"> <!-- Sign-in -->
							<?php if (isset($_SESSION['usr_id'])) { ?>
							<li><p class="navbar-text">Signed in as <?php echo $_SESSION['usr_name']; ?></p></li>
							<li><a href="logout.php">Log Out</a></li>
							<?php } else { ?>
							<li>
								<a href="login.php">Login</a>
							</li>
							<li>
								<a href="registration.php" class="btn btn-success white"><span class="glyphicon glyphicon-user"></span> Register </a>
							</li>
							<?php } ?>
						</ul><!-- end sign-in menu-->

					</div><!-- end nav-collapse -->
				
				</div><!-- end container -->
			</div><!-- end navbar -->
			<div class="white_space"></div><!-- White Space: 60px; -->
			<div class="row">
				<div class="col-md-4 col-md-offset-4 well">
					<form role="form" action="registration.php" method="post" name="signupform">
						<fieldset>
							<legend>Register</legend>

							<div class="form-group">
								<label for="fname">First Name</label>
								<input type="text" name="fname" placeholder="Enter First Name" required value="<?php if($error) echo $fname; ?>" class="form-control" />
								<span class="text-danger"><?php if (isset($fname_error)) echo $fname_error; ?></span>
							</div>

							<div class="form-group">
								<label for="lname">Last Name</label>
								<input type="text" name="lname" placeholder="Enter Last Name" required value="<?php if($error) echo $lname; ?>" class="form-control" />
								<span class="text-danger"><?php if (isset($lname_error)) echo $lname_error; ?></span>
							</div>
							
							<div class="form-group">
								<label for="email">Email</label>
								<input type="email" name="email" placeholder="Email" required value="<?php if($error) echo $email; ?>" class="form-control" />
								<span class="text-danger"><?php if (isset($email_error)) echo $email_error; ?></span>
							</div>

							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" name="password" placeholder="Password" required class="form-control" />
								<span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
							</div>

							<div class="form-group">
								<label for="cpassword">Confirm Password</label>
								<input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
								<span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>
							</div>

							<!--<div class="form-group">
								<label for="memberid">Student ID / Staff ID</label>
								<input type="text" name="memberid" placeholder="ID" required class="form-control" />
								<span class="text-danger"><?php if (isset($memberid_Error)) echo $memberid_Error; ?></span>
							</div>-->
							<!--<div class="form-group">
								<label for="campus">Campus</label>
								<select name="campus">
									<option value="esbjerg">Esbjerg</option>
									<option value="kolding">Kolding</option>
									<option value="odense">Odense</option>
									<option value="slagelse">Slagelse</option>
									<option value="sønderborg">Sønderborg</option>
								</select>
							</div>-->
							<div class="form-group">
								<label for="phone">Phone</label>
								<input type="number" name="phone" placeholder="Phone" required class="form-control" />
								<span class="text-danger"><?php if (isset($phone_error)) echo $phone_error; ?></span>
							</div>
							<div class="form-group">
								<label for="address">Address</label>
								<input type="text" name="address" placeholder="Address" required class="form-control" />
								<span class="text-danger"><?php if (isset($address_error)) echo $address_error; ?></span>
							</div>
							<div class="form-group">
								<label for="city">city</label>
								<input type="text" name="city" placeholder="city" required class="form-control" />
								<span class="text-danger"><?php if (isset($city_error)) echo $city_error; ?></span>
							</div>
							<div class="form-group">
								<label for="postalCode">Postal Code</label>
								<input type="number" name="postalCode" placeholder="Postal code" required class="form-control" />
								<span class="text-danger"><?php if (isset($postal_error)) echo $postal_error; ?></span>
							</div>
							<div class="form-group">
								<label for="country">Country</label>
								<input type="text" name="country" placeholder="country" required class="form-control" />
								<span class="text-danger"><?php if (isset($country_error)) echo $country_error; ?></span>
							</div>
							<div class="form-group">
								<input type="submit" name="signup" value="Register" class="btn btn-primary" />
							</div>
						</fieldset>
					</form>
					<span class="text-success"><?php if (isset($successmsg)) { echo $successmsg; } ?></span>
					<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-md-offset-4 text-center">	
				<p>Already Registered? <a href="login.php">Login Here</a></p>
				</div>
			</div>
		</div> <!-- /end Main container -->
		<footer>
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
					<h4>Test Labs</h4>

					<h5 class="grey">Test Adress 1<br>9999 Test City</h5>
					</div><!-- end col-sm-2 -->
					
					<div class="col-sm-4">
						<h4>Follow Us</h4>
						
						<ul class="unstyled" id="social">
							<li><a id="twitter" href="#"></a></li>
							<li><a id="facebook" href="#"></a></li>
							<li><a id="linkedin" href="#"></a></li>
							<li><a id="instagram" href="#"></a></li>
						</ul>
					</div><!-- end col-sm-4 -->
					
					
					<div class="col-sm-4" id="credits">
						<h5 class="grey">Webdesign customized by Peter Rosendahl</h5>
					</div><!-- end col-sm-2 -->
				</div><!-- end row -->
			</div><!-- end container -->
		</footer>

	<!-- All Javascript at the bottom of the page for faster page loading -->
		
	<!-- First try for the online version of jQuery-->
	<script src="http://code.jquery.com/jquery.js"></script>
	
	<!-- If no online access, fallback to our hardcoded version of jQuery -->
	<script>window.jQuery || document.write('<script src="includes/js/jquery-1.8.2.min.js"><\/script>')</script>
	
	<!-- Bootstrap JS -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<!-- Custom JS -->
	<script src="includes/js/script.js"></script>

</body>
</html>