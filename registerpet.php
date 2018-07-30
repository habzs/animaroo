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

	// Check for petname
 	if (empty($_POST['petname'])) {
		$errors[] = 'You forgot to enter your pet name.';
	} else {
		$pn = mysqli_real_escape_string($dbc, trim($_POST['petname']));
	}
	
	// Check for age
	if (empty($_POST['age'])) {
		$errors[] = 'You forgot to enter your pet age.';
	} else {
		$age = mysqli_real_escape_string($dbc, trim($_POST['age']));
	}
	
	// Check for your pet species
	if (empty($_POST['species'])) {
		$errors[] = 'You forgot to enter pet species.';
	} else {
		$sp = mysqli_real_escape_string($dbc, trim($_POST['species']));
	}

	// Check for pet breed
	if (empty($_POST['breed'])) {
		$errors[] = 'You forgot to enter pet breed.';
	} else {
		$br = mysqli_real_escape_string($dbc, trim($_POST['breed']));
	}
	
	if (empty($errors)) { // If everything's OK.
	
	
/* 		// Upload picture
		$image = $_FILES['image']['name'];
		$target = "images/users/".basename($image);
		$moveimg = move_uploaded_file($_FILES['image']['tmp_name'], $target);
 */
		// Register the user in the database...
		
		// Make the query:
		$q = "INSERT INTO pets (petname, age, species, breed, owner_email) VALUES ('$pn', '$age', '$sp', '$br', '$email')";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '
			<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header7.jpg);" data-stellar-background-ratio="0.5">
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

	<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header5.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-7 text-left">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeInUp">
							<h1 class="mb30">Register your pet</h1>
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
					<span>Thoughts &amp; Ideas</span>
					<h2>Add your pet</h2>
					<!--<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>-->
				</div>
			</div>
			<div class="row col-md-13"  >
                      <form class="" method="post" action="registerpet.php" enctype="multipart/form-data">
                        <div class="form-group">
                          <label>Name of Pet</label>
                          <input type="text" name="petname" id="text" class="form-control" placeholder="Enter your pet's name"> </div>
                        <div class="form-group">
                          <label>Age</label>
                          <input type="text" name="age" id="age" class="form-control" placeholder="Enter your pet's age"> </div>
                        <div class="form-group">
                          <label>Species</label>
                          <input type="text" name="species" id="species" class="form-control" placeholder="Enter your pet's type"> </div>
                        <div class="form-group">
                          <label>Breed</label>
                          <input type="text" name="breed" id="breed" class="form-control" placeholder="Enter your pet's type"> </div>
                        <div class="form-group">
                          <label>Photo</label>
                          <input type="file" name="photo" id="photo" class="form-control" placeholder="Upload your pet's photo"> </div>
						<button type="submit" name="submit" class="btn btn-primary">Send</button>
                      </form>
                     </div>

			</div>
		</div>
	</div>

<?php
include ("footer.php");
?>

