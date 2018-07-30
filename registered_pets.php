<?php
session_start();
include('header.php');

$page_title = 'View the Current Users';
include ('header.php');
require ('mysqli_connect.php');

$user = $_SESSION['email'];
// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(id) FROM pets";
	$r = @mysqli_query ($dbc, $q);
	$row = @mysqli_fetch_array ($r, MYSQLI_NUM);
	$records = $row[0];
	// Calculate the number of pages...
	if ($records > $display) { // More than 1 page.
		$pages = ceil ($records/$display);
	} else {
		$pages = 1;
	}
} // End of p IF.

// Determine where in the database to start returning results...
if (isset($_GET['s']) && is_numeric($_GET['s'])) {
	$start = $_GET['s'];
} else {
	$start = 0;
}

// Determine the sort...
// Default is by registration date.
$sort = (isset($_GET['sort'])) ? $_GET['sort'] : 'rd';

// Determine the sorting order:
switch ($sort) {
	case 'petname':
		$order_by = 'petname ASC';
		break;
	case 'age':
		$order_by = 'age ASC';
		break;
	case 'species':
		$order_by = 'species ASC';
		break;
	case 'breed':
		$order_by = 'breed ASC';
		break;

	default:
		$order_by = 'petname ASC';
		$sort = 'petname';
		break;
}
	
// Define the query:
$q = "SELECT petname, age, species, breed, id, dislikes, likes, image FROM pets ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.
?>

	<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header7.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-7 text-left">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeInUp">
							<h1 class="mb30">Pets Under Us</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	

	<div id="fh5co-team">
		<div class="container">
			<div class="row animate-box row-pb-md">
				<div class="col-md-8 col-md-offset-2 text-left fh5co-heading">
					<span>Pets with us</span>
					<h2>Pets that we are caring for!</h2>
					<br>
					<p>
						Here's a list of pets who are under our care!<br>
						Feel free to rate them! :)
					</p>
					<br>
					<form action="search.php" method="POST">
					<input class="col-xs-2 form-control" style="width:150px; height:40px; font-size:15px" type="text" placeholder="Search" name="search" >
		

					<button type="submit" name="submit-search" class="form-control-new"><img src="images/search.png" style="width:18px; align-items:center"/> </button>
					
				</div>
			</div>
			<div class="row">
				<div class="animate-box" data-animate-effect="fadeIn">

						<?php

						// Table header:
						echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
						<tr>
							<td align="left"><b><a href="registered_pets.php?sort=petname">Pet Name</a></b></td>
							<td align="left"><b><a href="registered_pets.php?sort=age">Age</a></b></td>
							<td align="left"><b><a href="registered_pets.php?sort=species">Species</a></b></td>
							<td align="left"><b><a href="registered_pets.php?sort=breed">Breed</a></b></td>
							<td align="left"><b><a href="?">Image</a></b></td>
							<td align="left"><b><a href="?">Likes</a></b></td>
							<td align="left"><b><a href="?">Dislikes</a></b></td>
						</tr>
						';

						// Fetch and print all the records....
						$bg = '#eeeeee'; 
						while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
							$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
								echo '<tr bgcolor="' . $bg . '">
								<td align="left">' . $row['petname'] . '</td>
								<td align="left">' . $row['age'] . '</td>
								<td align="left">' . $row['species'] . '</td>
								<td align="left">' . $row['breed'] . '</td>
								<td align="left" style="width: 100px;"><img style="width:80%;" src="images/users/' . $row['image'] . '"></td>
								<td align="left"><a href="rating_pos.php?id=' . $row['id'] . '">'. $row['likes'] . '</a></td>
								<td align="left"><a href="rating_neg.php?id=' . $row['id'] . '">'. $row['dislikes'] . '</a></td>
							</tr>
							';
						} // End of WHILE loop.

							// Check if user already likes post or not
							function userLiked($post_id)
							{
							global $conn;
							global $user_id;
							$sql = "SELECT * FROM rating_info WHERE user_id=$user_id 
									AND post_id=$post_id AND rating_action='like'";
							$result = mysqli_query($conn, $sql);
							if (mysqli_num_rows($result) > 0) {
								return true;
							}else{
								return false;
							}
							}

						echo '</table>';
						mysqli_free_result ($r);
						mysqli_close($dbc);

						// Make the links to other pages, if necessary.
						if ($pages > 1) {
							
							echo '<br /><p>';
							$current_page = ($start/$display) + 1;
							
							// If it's not the first page, make a Previous button:
							if ($current_page != 1) {
								echo '<a href="registered_users.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
							}
							
							// Make all the numbered pages:
							for ($i = 1; $i <= $pages; $i++) {
								if ($i != $current_page) {
									echo '<a href="registered_users.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
								} else {
									echo $i . ' ';
								}
							} // End of FOR loop.
							
							// If it's not the last page, make a Next button:
							if ($current_page != $pages) {
								echo '<a href="registered_users.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
							}
							
							echo '</p>'; // Close the paragraph.
							
						} // End of links section.
							

						?>

						
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
include('footer.php')
?>