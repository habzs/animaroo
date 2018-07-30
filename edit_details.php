<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.
session_start();
$page_title = 'Register';
include ('header.php');

$email = $_SESSION["email"];
// echo $email;

include ('mysqli_connect.php');

$result = mysqli_query($dbc,"SELECT first_name FROM users WHERE email = '$email'") or die(msyql_error());
$row = mysqli_fetch_array($result);
$first_name = $row['first_name'];

$result = mysqli_query($dbc,"SELECT last_name FROM users WHERE email = '$email'") or die(msyql_error());
$row = mysqli_fetch_array($result);
$last_name = $row['last_name'];

$result = mysqli_query($dbc,"SELECT image FROM users WHERE email = '$email'") or die(msyql_error());
$row = mysqli_fetch_array($result);
$images = $row['image'];


$msg = "";

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
			$q = "SELECT user_id FROM users WHERE email='$e'";
			$r = @mysqli_query($dbc, $q);
			if (mysqli_num_rows($r) == 0) {
	

				// Upload picture
				$image = $_FILES['image']['name'];
				$target = "images/users/".basename($image);
				$moveimg = move_uploaded_file($_FILES['image']['tmp_name'], $target);
				
				// Make the query:
				$q = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e', image='$image' WHERE email='$email'";
				$r = @mysqli_query ($dbc, $q);
				if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
					
					$email = $e;
					$_SESSION["email"] = $email;
					$first_name = $_POST['first_name'];
					$last_name = $_POST['last_name'];
					
	
					// Print a message:
					// echo '<p>The user has been edited.</p>';	
					$msg = "Your details have been edited!";
					
				} else { // If it did not run OK.
					echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
					echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
				}
					
			} else { // Already registered.
				// echo '<p class="error">The email address has already been registered.</p>';
				$msg = "The email address has already been registered.";
			}
			
		} else { // Report the errors.
	
			echo '<p class="error">The following error(s) occurred:<br />';
			foreach ($errors as $msg) { // Print each error.
				echo " - $msg<br />\n";
			}
			echo '</p><p>Please try again.</p>';
		
		} // End of if (empty($errors)) IF.
	
	} // End of submit conditional.
	
	mysqli_close($dbc); // Close the database connection.

?>

	<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header8.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-7 text-left">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeInUp">
							<?php 
							$returnTxt = "Welcome back, " . $first_name . ".";

							if ( isset( $_SESSION["email"] ) ) {

								echo "<h1> $returnTxt </h1>";

							} else {
								echo '<h1 class="mb30">Hi! Please Register. </h1>';
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
							if ( isset( $_SESSION["email"] ) ) { ?>
							<h3><?php echo '<div style="color:red;">' . $msg . '</div>';?></h3>
							<div class="row col-md-13" style="width:300px; margin:auto;" >
							<form action="edit_details.php" method="post" enctype="multipart/form-data">


								<div>
									<label>First Name</label>
									<input name="first_name" type="text" class="form-control" placeholder="First Name" size="15" maxlength="20" value="<?php echo $first_name; ?>" required />
								</div>
								<br>
								<div>
									<label>Last Name</label>
									<input name="last_name" type="text" class="form-control" placeholder="Last Name" size="15" maxlength="40" value="<?php echo $last_name; ?>" required />
								</div>
								<br>
								<div>
									<label>Email Address</label>
									<input name="email" type="email" class="form-control" placeholder="Email" size="20" maxlength="60" value="<?php echo $email; ?>" required />
								</div>
								<br>
								<div>
									<label>Picture</label>
									<input type="hidden" name="size" value="1000000">
									<input name="image" type="file" class="form-control"/>
								</div>
							</div>	

							<div class="row">
								<div class="centered">
									<br>
									<input type="submit" name="submit" value="Save Changes" class="btn btn-lg btn-primary centered">
								</div>
						</form>
						</div>
							<?php } else { ?>
								Hi! Please log in first.
							<?php } ?>

				</div>
			</div>
			
		</div>
	</div>


<?php include ('footer.php'); ?>
