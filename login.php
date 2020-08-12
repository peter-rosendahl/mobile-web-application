<?php
ob_start();
session_start();

$db = include ('connect.php');

require_once 'connect.php';

if(isset($_SESSION['usr_id'])!="") {
	header("Location: index.php");
}


//check if form is submitted
if (isset($_POST['login'])) {
	//copy global variables into short variables while escaping special characters
	$email = "test@123.dk";// mysqli_real_escape_string($db, $_POST['email']);
	$password = "test123";// mysqli_real_escape_string($db, $_POST['password']);
	$querylogin= "SELECT * FROM test_users WHERE email = '" . $email . "' and password = '" . sha1($password) . "'";
	echo $querylogin;
	$result = mysqli_query($db, $querylogin);

	if ($row = mysqli_fetch_array($result)) {
		$_SESSION['usr_id'] = $row['id'];
		$_SESSION['usr_name'] = $row['fname'] . " " . $row['lname'];
		header("Location: index.php");
	} else {
		$errormsg = "Incorrect Email or Password!!!";
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<!-- Website Title & Description for Search Engine purposes -->
		<title>Test Labs</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta name="description" content="Test Labs - book a session for using some of our creative tools on your current project.">
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
					<form role="form" action="login.php" method="post" name="loginform">
						<fieldset>
							<legend>Login</legend>
							
							<div class="form-group">
								<label for="name">Email</label>
								<input disabled type="text" name="email" id="usr_mail" placeholder="Your Email" required class="form-control" />
							</div>

							<div class="form-group">
								<label for="name">Password</label>
								<input disabled type="password" name="password" id="usr_pasw" placeholder="Your Password" required class="form-control" />
							</div>

							<div class="form-group">
								<input type="submit" name="login" value="Login" class="btn btn-primary" />
							</div>
						</fieldset>
					</form>
					<span class="text-danger"><?php if (isset($errormsg)) { echo $errormsg; } ?></span>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4 col-md-offset-4 text-center">	
				<p>New User? <a href="registration.php">Register Here</a></p>
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

		<!-- Modal -->
		<div id="myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog">
		    <!-- Modal content-->
		    <div class="modal-content">
		      <div class="modal-header">
		        <button type="button" class="close" data-dismiss="modal">&times;</button>
		        <h4 class="modal-title">Help to login</h4>
		      </div>
		      <div class="modal-body">
		        <b>Username: test@123.dk</b>
		        <p>password: test123</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		      </div>
		    </div>
		  </div>
		</div>

	<!-- All Javascript at the bottom of the page for faster page loading -->
		
	<!-- First try for the online version of jQuery-->
	<script src="http://code.jquery.com/jquery.js"></script>
	
	<!-- If no online access, fallback to our hardcoded version of jQuery -->
	<script>window.jQuery || document.write('<script src="includes/js/jquery-1.8.2.min.js"><\/script>')</script>
	
	<!-- Bootstrap JS -->
	<script src="bootstrap/js/bootstrap.min.js"></script>
	
	<!-- Custom JS -->
	<script src="includes/js/script.js"></script>

	<!-- place focus on first input field when entering the page -->
	<script>
	$(window).on('load',function(){
		$('#usr_mail').val("test@123.dk");
		$('#usr_pasw').val("test123");
        // $('#myModal').modal('show');
    });

	$(document).ready(function() {
	    $('form:first *:input[type!=hidden]:first').focus();
	});
	</script>
</body>
</html>
<?php ob_end_flush(); ?>