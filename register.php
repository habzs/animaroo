<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.
session_start();
$page_title = 'Register';
include ('header.php');

$email = $_SESSION['email'];

$msg = "";
// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.

// Checks for duplicate email
	$email = $_POST['email'];
	$emailcheck="select email from users where (email='$email');";
	$res=mysqli_query($dbc,$emailcheck);
	if (mysqli_num_rows($res) > 0) {
	// output data of each row
	$row = mysqli_fetch_assoc($res);
	if($email==$_POST['email'])
	{
		$errors[] = "Email already exists!";
	}
}
//	

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
			$errors[] = 'Your passwords aren&#39;t the same!';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}
	
	if (empty($errors)) { // If everything's OK.
	
	
		// Upload picture
		$image = $_FILES['image']['name'];
		$target = "images/users/".basename($image);
		$moveimg = move_uploaded_file($_FILES['image']['tmp_name'], $target);

		// Register the user in the database...
		
		// Make the query:
		$q = "INSERT INTO users (first_name, last_name, email, pass, registration_date, image) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW(), '$image'  )";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '
			<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header8.jpg);" data-stellar-background-ratio="0.5">
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
	
		//echo '<h1>Error!</h1>
		//<p class="error">The following error(s) occurred:<br />';
		//foreach ($errors as $msg) { // Print each error.
		//	echo " - $msg<br />\n";
		//}
		// echo '</p><p>Please try again.</p><p><br /></p>';

		foreach ($errors as $msg) {
			$msg;
		}

	
		
	} // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>

	<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header8.jpg);" data-stellar-background-ratio="0.5">
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
							if ( isset( $_SESSION["email"] ) ) {
								echo '<h1 class="mb30">You&#39;re already registered!</h1>';
							} else { ?>

							<h3><?php echo '<div style="color:red;">' . $msg . '</div>';?></h3>
							<div class="row col-md-13" style="width:300px; margin:auto;" >
							<form action="register.php" method="post" enctype="multipart/form-data">


								<div>
									<label>First Name</label>
									<input name="first_name" type="text" class="form-control" placeholder="First Name" size="15" maxlength="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" required />
								</div>
								<br>
								<div>
									<label>Last Name</label>
									<input name="last_name" type="text" class="form-control" placeholder="Last Name" size="15" maxlength="40" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" required />
								</div>
								<br>
								<div>
									<label>Email Address</label>
									<input name="email" type="email" class="form-control" placeholder="Email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" required />
								</div>
								<br>
								<div>
									<label>Password</label>
									<input name="pass1" type="password" class="form-control" placeholder="Password" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" required />
								</div>
								<br>
								<div>
									<label>Confirm Password</label>
									<input name="pass2" type="password" class="form-control" placeholder="Password" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" required />
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
									<input type="submit" name="submit" value="Register" class="btn btn-lg btn-primary centered">
								</div>
						</form>
						</div>
							<?php } ?>

				</div>
			</div>
			
		</div>
	</div>


<?php include ('footer.php'); ?>
