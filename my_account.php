<?php
session_start();
include ('header.php');

?>

	<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header7.jpg);" data-stellar-background-ratio="0.5">
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
								echo '<h1 class="mb30">Hi! Please Log In. </h1>';
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
					<h3>Your Account.</h3>
						<p>
							Change everything, or update your profile.
						</p>
					
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
							<div class="row centered" style="margin-top:50px;">
								<div><h1>You're not logged in!</h1></div>
							</div>	
						</table>
					</form>

					<?php } else { ?>
						<?php
						$email = $_SESSION['email'];

						include ('mysqli_connect.php');

						$result = mysqli_query($dbc,"SELECT image FROM users WHERE email = '$email'") or die(msyql_error());
						$row = mysqli_fetch_array($result);
						$image = $row['image'];

							echo "<img style='width:15%;' src='images/users/".$row['image']."' >";
						?>
						<div>
						<h2><a href="logout.php? action=logout">Log Out.</a></h2> 
						<h2><a href="edit_details.php">Edit Details.</a></h2>
						<h2><a href="my_pets.php">Manage Pets.</a></h2>
						
			
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

<?php 
include ("footer.php");
?>

