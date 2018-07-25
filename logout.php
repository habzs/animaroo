<?php
session_start();
include ('header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
include('config.php');

if (isset($_POST['username']))
{
	$username = $_POST['username'];
} else {
	$username = '';
}

if (isset($_POST['pass']))
{
	$pass = $_POST['pass'];
} else {
	$pass = '';
}


if (isset($_POST['username']))
{
    $encryptedpass = sha1($pass);

	$sql_statement  = "SELECT email,first_name,last_name ";
    $sql_statement .= "FROM users ";
    $sql_statement .= "WHERE email = '".$username."' ";
    $sql_statement .= "AND pass = '".$encryptedpass."' ";


    $result = mysqli_query($con, $sql_statement);
    $row = mysqli_fetch_row($result);


    $outputDisplay = "";
    $myrowcount = 0;

    if (!$row) {

        $outputDisplay = "Wrong Username/Password";
    } else {

    	$numresults = mysqli_num_rows($result);

    	if ($numresults == 0)
    	{
	    	$outputDisplay .= "Invalid Login <br /> ";
    		$outputDisplay .= "Please Go BACK and try again";
    	} else {

            $_SESSION["email"] = $row[0];
            $_SESSION["first_name"] = $row[1];
            $_SESSION["last_name"] = $row[2];
           
           $db = mysqli_connect("localhost:8889","root","root","animaroo"); 
$sql = "SELECT * FROM users WHERE email = $username";
$sth = $db->query($sql);
        }
      //  
    }
} else {
	

}

}


// LOG OUT SYSTEM

if ( isset( $_GET["action"] ) and $_GET["action"] == "logout" ) {
	logout();
} else {
	//
}


function logout() {
	unset( $_SESSION["email"] );
	session_write_close();
  }
?>

	<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/flash8.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-7 text-left">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeInUp">
							<?php 
							$returnTxt = "Welcome back, " . $_SESSION["first_name"] . ".";

							if ( isset( $_SESSION["email"] ) ) {

								echo "<h1> $returnTxt </h1>";

							} else {
								echo '<h1 class="mb30">We&#39;ll miss you! </h1>';
							}
							?>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	

	

	<div id="fh5co-contact">
		<div class="container">
			<div class="row">
				<div class="animate-box">
					
					<?php
						/* Form Required Field Validation */
					foreach($_POST as $key=>$value) {
						if(empty($_POST[$key])) {
						$error_message = "All Fields are required";
						break;
						}
					}

					?>

					<?php if(empty($_SESSION["email"])) { ?>

					<form name="loginForm" method="post" action="">
						<table border="0" width="500" align="center" class="demo-table">

							<?php if(!empty($success_message)) { ?>	
							<div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
							<?php } ?>

							<?php if(!empty($error_message)) { ?>	
							<div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
							<?php } elseif (!empty($outputDisplay)) {?>
							<div class="error-message"><?php if(isset($outputDisplay)) echo $outputDisplay; ?></div>
							<?php } ?>


							<div class="row centered" style="margin-top:50px;">
								<div>
									<h1>You've successfully signed out.</h1>
									<br>
									<h3>Please hold while we redirect you.</h3>
								</div>
							</div>	


						</table>
					</form>

					<?php } else { ?>
						<div>
						<h2><a href="indexphp.php? action=logout">Log Out.</a></h2> 
						
				
					<?php } ?>
						</div>
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

	<footer id="fh5co-footer" role="contentinfo">
		<div class="container">
			<div class="row row-pb-md">
				<div class="col-md-4 fh5co-widget">
					<h3>animaroo<span style="color:#F73859;">.</span></h3>
					<p>Groom with convenience.</p>
				</div>
				<div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1 ">
					<ul class="fh5co-footer-links">
						<li><a href="#">About</a></li>
						<li><a href="#">Help</a></li>
						<li><a href="#">Contact</a></li>
						<li><a href="#">Terms</a></li>
						<li><a href="#">Meetups</a></li>
					</ul>
				</div>

				<div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1 ">
					<ul class="fh5co-footer-links">
						<li><a href="#">Shop</a></li>
						<li><a href="#">Privacy</a></li>
						<li><a href="#">Testimonials</a></li>
						<li><a href="#">Handbook</a></li>
						<li><a href="#">Held Desk</a></li>
					</ul>
				</div>

				<div class="col-md-2 col-sm-4 col-xs-6 col-md-push-1 ">
					<ul class="fh5co-footer-links">
						<li><a href="#">Find Designers</a></li>
						<li><a href="#">Find Developers</a></li>
						<li><a href="#">Teams</a></li>
						<li><a href="#">Advertise</a></li>
						<li><a href="#">API</a></li>
					</ul>
				</div>
			</div>

			<div class="row copyright">
				<div class="col-md-12 text-center">
					<p>
						<small class="block">&copy; 2016 Free HTML5. All Rights Reserved.</small> 
						<small class="block">Designed by <a href="http://gettemplates.co/" target="_blank">GetTemplates.co</a> Demo Images: <a href="http://pixeden.com/" target="_blank">Pixeden</a> &amp; <a href="http://unsplash.com/" target="_blank">Unsplash</a></small>
					</p>
					<p>
						<ul class="fh5co-social-icons">
							<li><a href="#"><i class="icon-twitter"></i></a></li>
							<li><a href="#"><i class="icon-facebook"></i></a></li>
							<li><a href="#"><i class="icon-linkedin"></i></a></li>
							<li><a href="#"><i class="icon-dribbble"></i></a></li>
						</ul>
					</p>
				</div>
			</div>

		</div>
	</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Stellar -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>
	<!-- Redirect -->
	<script language="javascript" type="text/javascript">
	setTimeout(function () {
	window.location.href = "indexphp.php"; // points to indexphp.php for redirection
	}, 2000); // redirects after 2 seconds
 	</script>


	</body>
</html>

