<?php # Script 10.2 - delete_user.php
// This page is for deleting a user record.
// This page is accessed through view_users.php.

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

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	if ($_POST['sure'] == 'Yes') { // Delete the record.

		// Make the query:
		$q = "DELETE FROM users WHERE user_id=$id LIMIT 1";		
		$r = @mysqli_query ($dbc, $q);
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

			// Print a message:
			echo '';	
			include ('footer.php');	

		} else { // If the query did not run OK.
			echo '<p class="error">The user could not be deleted due to a system error.</p>'; // Public message.
			echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		}
	
	} else { // No confirmation of deletion.
		include ('header.php');
		
		echo '';	
	include ('footer.php');
	}

} else { // Show the form. ?>

	<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header7.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-7 text-left">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeInUp">
							<h1 class="mb30">Modify Users.</h1>;
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<?php // Retrieve the user's information:
	$q = "SELECT CONCAT(last_name, ', ', first_name) FROM users WHERE user_id=$id";
	$r = @mysqli_query ($dbc, $q);

	if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

		// Get the user's information:
		$row = mysqli_fetch_array ($r, MYSQLI_NUM); 
		$msg = "Are you sure you want to delete " . $row[0] . "?"?>

	<div id="fh5co-contact">
		<div class="container">
			<div class="row">
				<div class="animate-box">
					<h3>Your Account.</h3>
						<p>
							Change everything, or update your profile.
						</p>

							<h3><?php echo '<div style="color:red;text-align:center;">' . $msg . '</div>';?></h3>
							<div class="row col-md-13" style="width:300px; margin:auto;" >
							<form action="delete_user.php" method="post">
							<div style="text-align:center;margin:auto">
								<input type="radio"  name="sure" value="Yes" /> Yes 
								<input type="radio" name="sure" value="No" checked="checked" /> No
								<br><br>
								<input type="submit" class="btn btn-lg btn-primary centered" name="submit" value="Save Changes" />
								<?php echo '<input type="hidden" name="id" value=' . $id . ' />';?>
							</div>
							</form>
							</div>
				</div>
			</div>
			
		</div>
	</div>
	
	<?php } else { // Not a valid user ID.
		echo '<p class="error">This page has been accessed in error.</p>';
	}

} // End of the main submission conditional.

mysqli_close($dbc);
		
include ('footer.php');
?>