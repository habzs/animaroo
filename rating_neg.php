<?php # Script 10.2 - delete_user.php
// This page is for deleting a user record.
// This page is accessed through view_users.php.
session_start();

include ('header.php');
include ('mysqli_connect.php');

if (isset($_SESSION['email'])) {
	$email = $_SESSION['email'];
} else {
	$email = "NOT LOGGED IN";
}

if (isset($_GET['id'])) {
	$id = $_GET['id'];
} else {
	$id = "NOT LOGGED IN";
}

$result = mysqli_query($dbc,"SELECT dislikes FROM pets WHERE id='$id'") or die(msyql_error());
$row = mysqli_fetch_array($result);
$dislikes = $row['dislikes'];


// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

		$newlikes = $_POST['dislikes'] + 1;
		$id = $_POST['id'];

		// Make the query:
		$q = "UPDATE pets SET dislikes='$newlikes' WHERE id='$id'";		
		$r = @mysqli_query ($dbc, $q);
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

			echo '
			<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header7.jpg);" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row">
					<div class="col-md-7 text-left">
						<div class="display-t">
							<div class="display-tc animate-box" data-animate-effect="fadeInUp">
								<h1 class="mb30">Voted!</h1>;
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
						<h3>Vote.</h3>
							<p>
								Your vote has been cast!
							</p>
								<div class="row col-md-13" style="width:1000px; margin:auto; text-align:center;" >
									<h2>You have voted! Head 
									<a href="registered_pets.php">Back.</a></h2>
								</div>
								</form>
								</div>
	
	
					</div>
				</div>
				
			</div>
		</div>
		
			
			';

		} else { // If the query did not run OK.
			echo '<p class="error">The user could not be deleted due to a system error.</p>'; // Public message.
			echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		}

} else { // Show the form. ?>

	<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header7.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-7 text-left">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeInUp">
							<h1 class="mb30">Vote.</h1>;
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<?php // Retrieve the user's information:
	$q = "SELECT dislikes FROM pets WHERE id='$id'";
	$r = @mysqli_query ($dbc, $q);

	if (mysqli_num_rows($r) == 1 && isset($_SESSION['email'])) { // Valid user ID, show the form.

		// Get the user's information:
		$row = mysqli_fetch_array ($r, MYSQLI_NUM); 
		$msg = "Current dislikes: " . $row[0] . ".<br> Do you want to DISLIKE it?"?>

	<div id="fh5co-contact">
		<div class="container">
			<div class="row">
				<div class="animate-box">
					<h3>Vote.</h3>
						<p>
							Vote for your favourite pet!
						</p>
                            <h3><?php echo '<div style="color:red;text-align:center;">' . $msg . '</div>';?></h3>
							<div class="row col-md-13" style="width:300px; margin:auto;" >
							<form action="rating_neg.php" method="post">
							<div style="text-align:center;margin:auto">
								<br>
								<input type="submit" class="btn btn-lg btn-primary centered" name="submit" value="Vote!" />
								<?php echo '<input type="hidden" name="id" value=' . $id . ' />';?>
								<?php echo '<input type="hidden" name="dislikes" value="' . $dislikes . '" />' ?>
								<br>
								<a href="registered_pets.php">Back</a>
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