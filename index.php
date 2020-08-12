<?php 
	ob_start();
	session_start();
	// connect to mobile_web_app db
	$db = include ('connect.php');

	$error = false;

	if ( isset($_POST['booking_submit']) ) {

		$name = $_POST['name'];
		$email = $_POST['email'];
		$phone = $_POST['phone'];
		$description = $_POST['description'];
		$sdate = $_POST['startdate'];
		$stime = $_POST['starttime'];
		$edate = $_POST['enddate'];
		$etime = $_POST['endtime'];
		$equipment = $_POST['booking_checkbox'];
		$equipmentString = implode(",", $equipment);



		// check that the email is valid
		if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
			$error = true;
			$email_error = "Please Enter Valid Email";
		}
		if (!preg_match("/^[1-9][0-9]*$/",$phone) && strlen($phone) < 8) {
			$error = true;
			$phone_error = "Phone must contain minimum 8 numeric characters without spaces";
		}

		//If all the fields were filled corrected process form data 
		if (!$error) {
			// $sql =  "INSERT INTO mwa_booking (name, email, phone, description, startdate, starttime, enddate, endtime, equipment) VALUES ('$name', '$email', '$phone', '$description', '$sdate', '$stime', '$edate', '$etime', '$equipmentString')";
			// if (mysqli_query($db, $sql)) { ?>
			<script type="text/javascript">
			    window.onload = function() {
			    	alert("New record created successfully");
			    }
			</script>
		<?php 
				$to = $email;
				$subject = "Test Labs - Booking received";
				$txt = "Hello ". $name. ". Thank you for using our booking form - we will soon contact you for further notice. Best regards Test Labs";
				$headers = "From: peros09@student.sdu.dk";
				// mail($to,$subject,$txt,$headers);

			// } else {
			//    echo "Error: " . $sql . "<br>" . mysqli_error($db);
			// }; //end if-statement
		};
	}

?>
<!DOCTYPE html>
<html lang="en">
	<head>	
		<!-- Website Title & Description for Search Engine purposes -->
		<title>Test Labs</title>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
		<meta name="description" content="Test Labs - book a session for using some of our creative tools on your current project.">
		<link rel="shortcut icon" type="image/png" href="favicon.png"/>
		<!-- Mobile viewport optimized -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		
		<!-- Bootstrap CSS -->
		<link async href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
		<link async href="includes/css/bootstrap-glyphicons.css" rel="stylesheet" media="none" onload="if(media!='all')media='all'">
		
		<!-- Custom CSS -->
		<link async rel="stylesheet" href="includes/css/styles.css" media="none" onload="if(media!='all')media='all'">
		<link async rel="stylesheet" href="includes/css/social.css" media="none" onload="if(media!='all')media='all'">
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
				
					<a class="navbar-brand" href="index.php#main"><img src="images/test_logo.png" alt="Your Logo"></a>
					
					<div class="nav-collapse collapse navbar-responsive-collapse white">
						<ul id="top_menu" class="nav navbar-nav">
							<li>
								<a href="#bigCallout">Welcome</a>
							</li>
							<?php if (isset($_SESSION['usr_id'])) { ?>
							<li>
								<a href="#booking_form">Booking</a>
							</li>
							<?php } else { ?>
							<li>
								<a href="#portfolio">Portfolio</a>
							</li>
							<?php } ?>
							<li>
								<a href="#moreInfo">Contact</a>
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

		    <div class="row" id="tab_slider">
		        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
		            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8 bhoechie-tab">

		            	<?php 

							include_once 'connect.php';

							$sql = 'SELECT `device_name`, `img_file`, `description` FROM `equipment`';
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									echo '
									<div class="bhoechie-tab-content" style="background: url('. $row["img_file"]. '); background-size: cover;">
										<div class="bhoechie-tab-inner">
											<div class="centered">
												<h1>'. $row["device_name"]. '</h1><hr><br>'. 
												'<i>'. $row["description"]. '</i>
											</div>
										</div>
									</div>';
								}
							}
         	            	?>
		            </div> <!-- end .bhoechie-tab -->
		            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 bhoechie-tab-menu">
		              <div class="list-group">
						<?php 

							include_once 'connect.php';

							$sql = 'SELECT `device_name`, `img_file`, `description` FROM `equipment`';
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									echo '
									<a href="javascript:void(0);" class="list-group-item text-center">'. 
									$row["device_name"]. 
									'</a>';
								}
							}
							?>
		              </div> <!-- end .list-group -->
		            </div> <!-- end .bhoechie-tab-menu -->
		        </div> <!-- end .bhoechie-tab-container -->
		  	</div> <!-- end #tab_slider -->
			
			<div class="row" id="bigCallout">
				<div class="col-12">
					
					<div class="well">
						<div class="page-header">
							<h1>Multimedia through MySQLi <small class="grey">Adding content dynamically from a database</small></h1>
						</div><!-- end page-header -->
						
						<p class="lead">Both the tab box above and the portfolio elements below are generated through MySQLi enquiries.<br>By referring to server stored images, I can call their file locations and place them here in the website.<br><br>Pretty cool, huh?</p>
						
					</div><!-- end well -->
					
				</div><!-- end col-12 -->
			</div><!-- end bigCallout -->
			
			<!-- Booking or Portfolio -->
			<?php if (isset($_SESSION['usr_id'])) { ?>
			<h1>Gadget booking</h1>
			<form id="booking_form" class="form-horizontal" method="post"  autocomplete="off">
				<fieldset>
					<div class="row">
					<legend>Book for a session with our awesome gadgets here:</legend>
					<h4 class="white booking_step">Step 1 of 2 - Fill in the basic information about you and your project.</h4>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="name" class="control-label col-sm-3">Name</label>
								<div class="col-sm-9">
									<input required type="text" name="name" placeholder="Your full name" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="email" class="control-label col-sm-3">Email</label>
								<div class="col-sm-9">
									<input required type="text" name="email" placeholder="Your Email address" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="phone" class="control-label col-sm-3">Phone</label>
								<div class="col-sm-9">
									<input required type="text" name="phone" placeholder="Your phone number" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="description" class="control-label col-sm-3">Description</label>
								<div class="col-sm-9">
									<textarea required name="description" placeholder="Your project description" class="form-control"></textarea>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="startdate" class="control-label col-sm-3">Start Date</label>
								<div class="col-sm-9">
									<input required type="date" name="startdate" placeholder="YYYY-MM-DD" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="starttime" class="control-label col-sm-3">Start Time</label>
								<div class="col-sm-9">
									<input required type="time" step="1" name="starttime" placeholder="HH:MM:SS" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="enddate" class="control-label col-sm-3">End date</label>
								<div class="col-sm-9">
									<input required type="date" name="enddate" placeholder="YYYY-MM-DD" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label for="endtime" class="control-label col-sm-3">End Time</label>
								<div class="col-sm-9">
									<input required type="time" step="1" name="endtime" placeholder="HH:MM:SS" class="form-control">
								</div>
							</div>
						</div>
					</div>
					<div class="container-fluid" id="booking">
						<h4 class="white booking_step">Step 2 of 2 - Click on the images to add the equipments to the booking basket.</h4>
						<div class="row no-space portfolio booking">
							<div class="col-sm-3 figblock booking" id="portflio1">
								<div class="box" style=" background: url('images/image-01_thumb.png') no-repeat center; background-size: cover;"></div>
								<figcaption>
									<h4>raspberry pi</h4>
									<input type="checkbox" class="checkbox" name="booking_checkbox[]" value="Raspberry Pi"><label for="booking_checkbox">CLICK ON IMAGE TO BOOK</label>
								</figcaption>
							</div> <!-- end figblock -->
							<div class="col-sm-3 figblock booking" id="portflio2">
								<div class="box" style=" background: url('images/image-02_thumb.png') no-repeat center; background-size: cover;"></div>
								<figcaption>
									<h4>Oculus Rift</h4>
									<input type="checkbox" class="checkbox" name="booking_checkbox[]" value="Oculus Rift"><label for="booking_checkbox">CLICK ON IMAGE TO BOOK</label>
								</figcaption>
							</div> <!-- end figblock -->
							<div class="col-sm-3 figblock booking" id="portflio3">
								<div class="box" style=" background: url('images/image-03_thumb.png') no-repeat center; background-size: cover;"></div>
								<figcaption>
									<h4>Eye-Tracker</h4>
									<input type="checkbox" class="checkbox" name="booking_checkbox[]" value="Eye-Tracker"><label for="booking_checkbox">CLICK ON IMAGE TO BOOK</label>
								</figcaption>
							</div> <!-- end figblock -->
							<div class="col-sm-3 figblock booking" id="portflio4">
								<div class="box" style=" background: url('images/image-04_thumb.png') no-repeat center; background-size: cover;"></div>
								<figcaption>
									<h4>Kinect</h4>
									<input type="checkbox" class="checkbox" name="booking_checkbox[]" value="Kinect"><label for="booking_checkbox">CLICK ON IMAGE TO BOOK</label>
								</figcaption>
							</div> <!-- end figblock -->
							
						</div>
						<div class="row no-space portfolio booking">
							<div class="col-sm-4 figblock booking" id="portflio5">
								<div class="box" style=" background: url('images/image-05_thumb.png') no-repeat center; background-size: cover;"></div>
								<figcaption>
									<h4>Leap Motion</h4>
									<input type="checkbox" class="checkbox" name="booking_checkbox[]" value="Leap Motion"><label for="booking_checkbox">CLICK ON IMAGE TO BOOK</label>
								</figcaption>
							</div> <!-- end figblock -->
							<div class="col-sm-4 figblock booking" id="portflio6">
								<div class="box" style=" background: url('images/image-06_thumb.png') no-repeat center; background-size: cover;"></div>
								<figcaption>
									<h4>Neurosky Mindwave</h4>
									<input type="checkbox" class="checkbox" name="booking_checkbox[]" value="Neurosky Mindwave"><label for="booking_checkbox">CLICK ON IMAGE TO BOOK</label>
								</figcaption>
							</div> <!-- end figblock --> <!-- end php GET equipment data -->
							<div class="col-sm-4 figblock booking" id="portflio7">
								<div class="box" style=" background: url('images/image-07_thumb.png') no-repeat center; background-size: cover;"></div>
								<figcaption>
									<h4>Web Cam</h4>
									<input type="checkbox" class="checkbox" name="booking_checkbox[]" value="Web Cam"><label for="booking_checkbox">CLICK ON IMAGE TO BOOK</label>
								</figcaption>
							</div> <!-- end figblock -->
						</div>	
						<div class="row no-space portfolio booking">
							<div class="col-sm-6 figblock booking" id="portflio8">
								<div class="box" style=" background: url('images/image-08_thumb.png') no-repeat center; background-position-y: inherit; background-size: cover;"></div>
								<figcaption>
									<h4>Microphone</h4>
									<input type="checkbox" class="checkbox" name="booking_checkbox[]" value="Microphone"><label for="booking_checkbox">CLICK ON IMAGE TO BOOK</label>
								</figcaption>
							</div> <!-- end figblock -->
							<div class="col-sm-6 figblock booking" id="portflio9">
								<div class="box" style=" background: url('images/image-10_thumb.png') no-repeat center; background-position-y: inherit; background-size: cover;"></div>
								<figcaption>
									<h4>Holosonic Speakers</h4>
									<input type="checkbox" class="checkbox" name="booking_checkbox[]" value="Holosonic Speakers"><label for="booking_checkbox">CLICK ON IMAGE TO BOOK</label>
								</figcaption>
							</div> <!-- end figblock -->
						</div>
					</div><!-- end fluid-container -->
					<div id="submit_booking" class="form-group">
						<input type="submit" name="booking_submit" class="btn btn-primary newsletter" value="Send Request">
						<input type="reset" class="btn btn-default" value="Reset">
					</div>
				</fieldset>
			</form> <!-- end booking form -->
			<hr>
			<?php } else { ?>

			<div class="container-fluid" id="portfolio">
				<h1>Gadget portfolio<br><small>Give them some focus, and they'll show you more</small></h1>
				<div class="row no-space portfolio">
					<?php 
							include_once "connect.php";

							$sql = "SELECT `deviceid`, `device_name`, `thumb_file`, `description`, `device_code` FROM `equipment` WHERE `deviceid` <= 4";
							$result = $conn->query($sql);
							if (isset($_SESSION['usr_id'])) { 
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										echo '
										<div class="col-sm-3 figblock booking" id="portflio'. $row["deviceid"]. '">
											<div class="box" style=" background: url(\''. $row["thumb_file"]. '\') no-repeat center;"></div>
											<figcaption>
												<h4>'. $row["device_name"]. '</h4><p>If you login or register as an Test Lab user, you can book this '. $row["device_name"]. '</p>
												<input type="checkbox" name="booking_checkbox" value="'. $row["device_code"]. '">Book '. $row["device_name"]. '
											</figcaption>
										</div> <!-- end figblock -->';
									}
								}
							} else {
								if ($result->num_rows > 0) {
									// output data of each row
									while($row = $result->fetch_assoc()) {
										echo '
										<div class="col-sm-3 figblock" id="portflio'. $row["deviceid"]. '">
											<div class="box" style=" background: url(\''. $row["thumb_file"]. '\') no-repeat center; background-size: cover;"></div>
											<figcaption>
												<h4>'. $row["device_name"]. '</h4><p>'. $row["description"]. '</p>
											</figcaption>
										</div> <!-- end figblock -->';
									}
								}
							}
					?> <!-- end php GET equipment data -->
				</div> <!-- end portfolio class -->
				<div class="row no-space portfolio">
					<?php 
							include_once "connect.php";

							$sql = "SELECT `deviceid`, `device_name`, `img_file`, `description` FROM `equipment` WHERE `deviceid` > 4 && `deviceid` <= 7";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									echo '
									<div class="col-sm-4 figblock" id="portflio'. $row["deviceid"]. '">
										<div class="box" style=" background: url(\''. $row["img_file"]. '\') no-repeat center; background-size: cover;"></div>
										<figcaption>
											<h4>'. $row["device_name"]. '</h4><p>'. $row["description"]. '</p>
										</figcaption>
									</div> <!-- end figblock -->';
								}
							}
					?> <!-- end php GET equipment data -->
				</div> <!-- end portfolio class -->
				<div class="row no-space portfolio">
					<?php 
							include_once "connect.php";

							$sql = "SELECT `deviceid`, `device_name`, `img_file`, `description` FROM `equipment` WHERE `deviceid` > 7 && `deviceid` <= 10";
							$result = $conn->query($sql);

							if ($result->num_rows > 0) {
								// output data of each row
								while($row = $result->fetch_assoc()) {
									echo '
									<div class="col-sm-6 figblock" id="portflio'. $row["deviceid"]. '">
										<div class="box" style=" background: url(\''. $row["img_file"]. '\') no-repeat center; background-size: cover; background-position-y: inherit;"></div>
										<figcaption>
											<h4>'. $row["device_name"]. '</h4><p>'. $row["description"]. '</p>
										</figcaption>
									</div> <!-- end figblock -->';
								}
							}
					?> <!-- end php GET equipment data -->
				</div> <!-- end portfolio class -->
			</div><!-- end fluid-container -->
			<?php }; ?>

			<?php if (isset($_SESSION['usr_id'])) { ?>
			<div class="row" id="moreInfo">
				<div class="col-sm-6">
					<h2>What happens after I press submit?</h2>
					<p>This is a simple input form, where you can fill in your contact information and such.</p>
					<p>When you press the "submit" button will your inserted data be converted and placed into the website's database.</p>
					<p>Also, an email will be sent to the web administrator including your submitted data, so that he/she can follow up on the request.</p>
				</div>
				<div class="col-sm-6">
					<h3>Let's get in touch!</h3>
					<div class="tabbable">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1" data-toggle="tab">Location</a></li>
							<li><a href="#tab3" data-toggle="tab">Newsletter</a></li>
							<li><a href="#tab4" data-toggle="tab">Contact us</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab1">
								<h3>This is just an image, but can also be a Google Maps view:</h3>
								<iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.ca/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=waikiki+beach&amp;aq=&amp;sll=19.896766,-155.582782&amp;sspn=8.711424,11.854248&amp;ie=UTF8&amp;hq=&amp;hnear=Waikiki+Beach,+Honolulu,+Hawaii,+United+States&amp;t=m&amp;ll=21.277298,-157.8265&amp;spn=0.015996,0.036478&amp;z=14&amp;output=embed"></iframe>
							</div><!-- end tab-pane -->						
							<div class="tab-pane" id="tab3">
								<div id="newsletter_form">
									<h3>A simple newsletter form</h3>
							    	<form method="POST" action="newsletter.php" class="horizontal-form">
							          	<label for="name">Name</label>
							            <input required class="col-sm-12" type="text" name="name" id="name" placeholder="Name"><br>
							            <label for="email">Email</label>
							            <input required class="col-sm-12" type="text" name="email" id="email" placeholder="Email"><br>
							            <input type="submit" name="newsletter_submit" class="btn btn-primary newsletter" value="Sign in for newsletter">
							            <input type="reset" class="btn btn-default" value="Reset">
							    	</form>
							    </div> <!-- end #newsletter_form -->
							</div><!-- end tab-pane -->
							<div class="tab-pane" id="tab4">
								<div id="contact_form">
									<h3>A contact form, that sends the data to an email:</h3>
						        	<form method="POST" action="contact.php" class="horizontal-form">
							          	<label for="name">Name</label>
							            <input required class="col-sm-12" type="text" name="name" id="name" placeholder="Name"><br><br>
							            <label for="email">Email</label>
							            <input required class="col-sm-12" type="text" name="email" id="email" placeholder="Email"><br><br>
							            <label for="message">Message</label>
							            <textarea id="message" class="col-sm-12" name="message"></textarea><br><br>
							            <input type="submit" name="contact_submit" class="btn btn-primary newsletter" value="Send message">
							            <input type="reset" class="btn btn-default" value="Reset">
						        	</form>
						        </div> <!-- end #contact_form -->
							</div><!-- end tab-pane -->

						</div><!-- end tab-content -->
					</div><!-- end tabbable -->
				</div><!-- end col-sm-6 -->	
			</div><!-- end moreInfo -->
			<?php } else { ?>
			<div class="row" id="moreInfo">
				<div class="col-sm-6">
					<h2>What is the website build of?</h2>
					<p>With inspiration from Responsive Web Designer, Brad Hussey, this website is developed through basic HTML5, CSS3 and with a BootStrap framework.</p>
					<p>Also, the various input and login functions are built in PHP, so that the browser can save and make use of an active login session.</p>
					<br>
					<p>This project was a part of an exam during my MSc. in Information Technology. Thus, the featured equipments comes from the project description.</p>
					<p>Otherwise, the rest of the elements in this Test Lab website is merely a presentation of what I can create through PHP, HTML5 and CSS3.
					<br>
					<h3>A frame with a YouTube video of Oculus rift!</h3>

					<div class="responsive-video">
						<iframe src="https://www.youtube.com/embed/hzzondIECZU" frameborder="0" allowfullscreen></iframe>
					</div>
					
				</div><!-- end col-sm-6 -->

				<div class="col-sm-6">
					<h3>Let's get in touch!</h3>
					<div class="tabbable">
						<ul class="nav nav-tabs">
							<li class="active"><a href="#tab1" data-toggle="tab">Location</a></li>
							<li><a href="#tab3" data-toggle="tab">Newsletter</a></li>
							<li><a href="#tab4" data-toggle="tab">Contact us</a></li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab1">
								<h3>This is where we live:</h3>
								<img src="images/maps_example.png" class="img-responsive"/>
								<!--<iframe width="100%" height="200" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.ca/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=waikiki+beach&amp;aq=&amp;sll=19.896766,-155.582782&amp;sspn=8.711424,11.854248&amp;ie=UTF8&amp;hq=&amp;hnear=Waikiki+Beach,+Honolulu,+Hawaii,+United+States&amp;t=m&amp;ll=21.277298,-157.8265&amp;spn=0.015996,0.036478&amp;z=14&amp;output=embed"></iframe>-->
							</div><!-- end tab-pane -->
							
							<div class="tab-pane" id="tab3">
								<div id="newsletter_form">
									<h3>Get our newsletter</h3>
						        	<form method="POST" action="newsletter.php" class="horizontal-form">
							          	<label>Name</label>
							            <input required class="col-sm-12" type="text" name="name" placeholder="Name"><br>
							            <label>Email</label>
							            <input required class="col-sm-12" type="text" name="email" placeholder="Email"><br>
							            <input type="submit" name="newsletter_submit" href="#tab3" class="btn btn-primary newsletter" value="Sign in for newsletter">
							            <input type="reset" class="btn btn-default" value="Reset">
						        	</form>
						        </div> <!-- /#newsletter_form -->
							</div><!-- end tab-pane -->
							<div class="tab-pane" id="tab4">
								<div id="contact_form">
									<h3>Send us an email:</h3>
						        	<form method="POST" action="contact.php" class="horizontal-form">
							          	<label>Name</label>
							            <input required class="col-sm-12" type="text" name="name" placeholder="Name"><br><br>
							            <label>Email</label>
							            <input required class="col-sm-12" type="text" name="email" placeholder="Email"><br><br>
							            <label for="message">Message</label>
							            <textarea id="message" class="col-sm-12" name="message"></textarea><br><br>
							            <input type="submit" name="contact_submit" class="btn btn-primary newsletter" value="Send message">
							            <input type="reset" class="btn btn-default" value="Reset">
						        	</form>
						        </div> <!-- /#contact_form -->
							</div><!-- end tab-pane -->

						</div><!-- end tab-content -->
					</div><!-- end tabbable -->
				</div><!-- end col-sm-6 -->	
			</div><!-- end moreInfo -->
			<?php }; ?>
			<hr>
		</div> <!-- end container -->
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


	<!-- jQuery Green Checkmark function -->
	<script>
	$(function() {
		$("input[type='checkbox']").change(function() {

			if($( this ).is(":checked")){
				$(this).parent().css('background', 'url(images/green_mark.png) no-repeat center');
			} else {
				$(this).parent().css('background', '');
			};
		});
		$("input[type='reset']").click(function() {
			$("#booking figcaption").css('background', '');
		});
	});
	</script>
	</body>
</html>
<?php ob_end_flush(); ?>