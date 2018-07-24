<?php 
session_start();
include('header.php');

$connection = mysqli_connect('localhost:8889', 'root', 'root');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'animaroo');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}

if((isset($_POST['name']) && !empty($_POST['name']))
&& (isset($_POST['email']) && !empty($_POST['email']))
&& (isset($_POST['subject']) && !empty($_POST['subject']))){

	// print_r($_POST);
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	
	$to = "owenlee22@gmail.com";
	$headers = "From : " . $email;
	
	if( mail($to, $subject, $message, $headers)){
		// echo "E-Mail Sent successfully, we will get back to you soon.";
		
		$query = "INSERT INTO `contact` (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
		$result = mysqli_query($connection, $query);
	}
}
?>
	<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/shibainu.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-7 text-left">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeInUp">
							<h1 class="mb30">Your Feedback</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	

	<div id="fh5co-blog" class="fh5co-bg-section">
		<div class="container">
			<div class="row animate-box row-pb-md" data-animate-effect="fadeInUp">
				<div class="col-md-8 col-md-offset-2 text-left fh5co-heading">
					<span>Enquire here</span>
					<h2>Contact Us</h2>
				</div>
			</div>

			<div class="display-t">
						<div class="display-tc animate-box centered" data-animate-effect="fadeInUp">					
						<p>
							Your response has been submitted!
							<br>
							We normally respond within a day. Hold tight!
						</p>


						</div>
					</div>



			</div>
		</div>
	</div>



	
	<div id="fh5co-started">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<span>Let's work together</span>
					<h2>Try this template for free</h2>
					<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
					<p><button type="submit" class="btn btn-default">Get In Touch</button></p>
				</div>
			</div>
		</div>
	</div>

<?php
include('footer.php');
?>