<?php # Script 10.3 - edit_user.php
// This page is for editing a user record.
// This page is accessed through view_users.php.
session_start();

$page_title = 'Edit a User';
include ('header.php');

// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('footer.php'); 
	exit();
}

require ('mysqli_connect.php'); 

$email = $_SESSION['email'];
$result = mysqli_query($dbc,"SELECT admin FROM users WHERE email = '$email'") or die(msyql_error());
$row = mysqli_fetch_array($result);
$admin = $row['admin'];

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array();
	
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
	
	if (empty($errors)) { // If everything's OK.
	
		//  Test for unique email address:
		$q = "SELECT user_id FROM users WHERE email='$e' AND user_id != $id";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 0) {

			// Make the query:
			$q = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e' WHERE user_id=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				$msg = "The user has been edited";	
				
			} else { // If it did not run OK.
				echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
				
		} else { // Already registered.
			echo '<p class="error">The email address has already been registered.</p>';
		}
		
	} else { // Report the errors.

		echo '<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';
	
	} // End of if (empty($errors)) IF.

} // End of submit conditional.

// Always show the form...

// Retrieve the user's information:
$q = "SELECT first_name, last_name, email FROM users WHERE user_id=$id";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array ($r, MYSQLI_NUM); ?>

	<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header8.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-7 text-left">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeInUp">
							<?php 
							$returnTxt = "Edit your details.";

							if ( isset( $_SESSION["email"] ) ) {

								echo "<h1> $returnTxt </h1>";

							} else {
								echo '<h1 class="mb30">Hi! You are not allowed to view this content.</h1>';
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

							if (isset($_SESSION["email"]) && $admin == 1){ ?>
							<h3><?php echo '<div style="color:red;">' . $msg . '</div>';?></h3>
							<div class="row col-md-13" style="width:300px; margin:auto;" >
							<form action="edit_user.php" method="post" enctype="multipart/form-data">
								<div>
									<label>First Name</label>
									<input name="first_name" type="text" class="form-control" placeholder="First Name" size="15" maxlength="20" value="<?php echo $row[0]; ?>" required />
								</div>
								<br>
								<div>
									<label>Last Name</label>
									<input name="last_name" type="text" class="form-control" placeholder="Last Name" size="15" maxlength="40" value="<?php echo $row[1]; ?>" required />
								</div>
								<br>
								<div>
									<label>Email Address</label>
									<input name="email" type="email" class="form-control" placeholder="Email" size="20" maxlength="60" value="<?php echo $row[2]; ?>" required />
								</div>
								<br>
<!-- 								<div>
									<label>Picture</label>
									<input type="hidden" name="size" value="1000000">
									<input name="image" type="file" class="form-control"/>
								</div> -->
							</div>	

							<div class="row">
								<div class="centered">
									<br>
									<input type="submit" name="submit" value="Save Changes" class="btn btn-lg btn-primary centered">
									<br>
									<br>
									<a href="registered_users.php" class="btn btn-lg btn-primary centered">Back</a>
									<input type="hidden" name="id" value="<?php echo $id; ?>" />
								</div>
						</form>
						</div>
							<?php } else { ?>
								You're not allowed to view this content.
							<?php } ?>

				</div>
			</div>
			
		</div>
	</div>

	
	<?php

} else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);
		
include ('footer.php');
?>