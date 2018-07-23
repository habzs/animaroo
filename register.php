<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.
session_start();
$page_title = 'Register';
include ('header.php');

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for a first name:
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}
	
	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}
	
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	
	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}
	
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		// Make the query:
		$q = "INSERT INTO users (first_name, last_name, email, pass, registration_date) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW() )";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '
			<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/cat2.jpg);" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-7 text-left">
						<div class="display-t">
							<div class="display-tc animate-box" data-animate-effect="fadeInUp">
								
								<h1 class="mb30">Welcome! You are registered!</h1>

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
						<h3>You can now Log In!</h3>
							<p>
								Once you are logged in, you can update your profile under "My Account".
							</p>

							<h2><a href="login.php">Log In.</a></h2> 
	
					</div>
				</div>
				
			</div>
		</div>
	
		<div id="fh5co-started">
			<div class="container">
				<div class="row animate-box">
					<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
						<span>Let us work together</span>
						<h2>Try this template for free</h2>
						<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
						<p><button type="submit" class="btn btn-default">Get In Touch</button></p>
					</div>
				</div>
			</div>
		</div>
			';
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include ('footer.php'); 
		exit();
		
	} else { // Report the errors.
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>

	<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/cat2.jpg);" data-stellar-background-ratio="0.5">
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
							if ( isset( $_SESSION["email"] ) ) {
								echo '<h1 class="mb30">You&#39;re already registered!</h1>';
							} else { ?>

							<div class="row form-group">
							<form action="register.php" method="post">
								<div style="width:300px;" class="centered">
									<label>First Name</label>
									<input name="first_name" type="text" class="form-control" placeholder="First Name" size="15" maxlength="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" />
								</div>
								<br>
								<div style="width:300px;" class="centered">
									<label>Last Name</label>
									<input name="last_name" type="text" class="form-control" placeholder="Last Name" size="15" maxlength="40" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" />
								</div>
								<br>
								<div style="width:300px;" class="centered">
									<label>Email Address</label>
									<input name="email" type="text" class="form-control" placeholder="Email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" />
								</div>
								<br>
								<div style="width:300px;" class="centered">
									<label>Password</label>
									<input name="pass1" type="password" class="form-control" placeholder="Password" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" />
								</div>
								<br>
								<div style="width:300px;" class="centered">
									<label>Confirm Password</label>
									<input name="pass2" type="password" class="form-control" placeholder="Password" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" />
								</div>
							</div>	

							<div class="row">
								<div class="centered">
									<input type="submit" name="submit" value="Register" class="btn btn-lg btn-primary centered">
								</div>
						</form>
						</div>
							<?php } ?>

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


<?php include ('footer.php'); ?>
