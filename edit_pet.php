<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.
session_start();
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

$result = mysqli_query($dbc,"SELECT petname FROM pets WHERE id = '$id'") or die(msyql_error());
$row = mysqli_fetch_array($result);
$petname = $row['petname'];

$result = mysqli_query($dbc,"SELECT age FROM pets WHERE id = '$id'") or die(msyql_error());
$row = mysqli_fetch_array($result);
$age = $row['age'];

$result = mysqli_query($dbc,"SELECT species FROM pets WHERE id = '$id'") or die(msyql_error());
$row = mysqli_fetch_array($result);
$species = $row['species'];

$result = mysqli_query($dbc,"SELECT breed FROM pets WHERE id = '$id'") or die(msyql_error());
$row = mysqli_fetch_array($result);
$breed = $row['breed'];


$msg = "";

// Check if the form has been submitted:
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$errors = array();
		
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
		
		// Upload picture
		$image = $_FILES['image']['name'];
		$target = "images/pets/".basename($image);
		$moveimg = move_uploaded_file($_FILES['image']['tmp_name'], $target);

		if ($_FILES['image']['size'] == 0) {
	//
				// Make the query:
				$q = "UPDATE pets SET petname='$pn', age='$age', species='$sp', breed='$br' WHERE id='$id'";
				$r = @mysqli_query ($dbc, $q);
				if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
					
					$id = $_POST['id'];
					$petname = $_POST['petname'];
					$age = $_POST['age'];
					$species = $_POST['species'];
					$breed = $_POST['breed'];
					
	
					// Print a message:
					// echo '<p>The user has been edited.</p>';	
					$msg = "Your details have been edited!";
					
				} else { // If it did not run OK.
					// echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
					$msg = "You have not changed any details!";
					echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
				}
	//		
			} else {
					//
				// Make the query:
				$q = "UPDATE pets SET petname='$pn', age='$age', species='$sp', image='$image', breed='$br' WHERE id='$id'";
				$r = @mysqli_query ($dbc, $q);
				if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
					
					$id = $_POST['id'];
					$petname = $_POST['petname'];
					$age = $_POST['age'];
					$species = $_POST['species'];
					$breed = $_POST['breed'];
					
	
					// Print a message:
					// echo '<p>The user has been edited.</p>';	
					$msg = "Your details have been edited!";
					
				} else { // If it did not run OK.
					// echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
					$msg = "You have not changed any details!";
					//echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
				}
	//		
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

	<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header7.jpg);" data-stellar-background-ratio="0.5">
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
								echo '<h1 class="mb30">Hi! Please Log In before managing your pets. </h1>';
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
							<form action="edit_pet.php" method="post" enctype="multipart/form-data">
								<div>
									<label>Pet Name</label>
									<input name="petname" type="text" class="form-control" placeholder="Pet Name" size="15" maxlength="20" value="<?php echo $petname; ?>" required />
								</div>
								<br>
								<div>
									<label>Age</label>
									<input name="age" type="text" class="form-control" placeholder="Age" size="15" maxlength="40" value="<?php echo $age; ?>" required />
								</div>
								<br>
								<div>
									<label>Species</label>
									<input name="species" type="text" class="form-control" placeholder="Species" size="15" maxlength="40" value="<?php echo $species; ?>" required />
								</div>
								<br>
								<div>
									<label>Breed</label>
									<input name="breed" type="text" class="form-control" placeholder="Breed" size="15" maxlength="40" value="<?php echo $breed; ?>" required />
								</div>
								<br>
								<div>
									<label>Picture</label>
									<input type="hidden" name="size" value="1000000">
									<input name="image" type="file" class="form-control"/>
								</div>
								<?php echo '<input type="hidden" name="id" value=' . $id . ' />';?>
								<br>
							</div>	

							<div class="row">
								<div class="centered">
									<br>
									<input type="submit" name="submit" value="Save Changes" class="btn btn-lg btn-primary centered">
									<br>
									<br>
									<a href="my_pets.php" class="btn btn-lg btn-primary centered">Back</a>
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
