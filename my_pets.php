<?php
session_start();
include('header.php');

$page_title = 'View the Current Users';
include ('header.php');
require ('mysqli_connect.php');
$email = $_SESSION['email'];

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
$q = "SELECT petname, age, species, breed, id, image FROM pets WHERE owner_email='$email' ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.
?>

	<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header7.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-7 text-left">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeInUp">
							<h1 class="mb30">Manage your furballs</h1>
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
					<span>Behind the scenes</span>
					<h2>Edit your pets!</h2>
					<br>
					<p>
						View, delete or modify your pets!
					</p>
				</div>
			</div>
			<div class="row">
				<div class="animate-box" data-animate-effect="fadeIn">
						<?php

						// Table header:
						echo '<table align="center" cellspacing="0" cellpadding="5" width="75%">
						<tr>
							<td align="left"><b>Edit</b></td>
							<td align="left"><b>Delete</b></td>
							<td align="left"><b><a href="my_pets.php?sort=petname">Pet Name</a></b></td>
							<td align="left"><b><a href="my_pets.php?sort=age">Age</a></b></td>
							<td align="left"><b><a href="my_pets.php?sort=species">Species</a></b></td>
							<td align="left"><b><a href="my_pets.php?sort=breed">Breed</a></b></td>
							<td align="left"><b><a href="?">Image</a></b></td>
						</tr>
						';

						// Fetch and print all the records....
						$bg = '#eeeeee'; 
						while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
							$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
								echo '<tr bgcolor="' . $bg . '">
								<td align="left"><a href="edit_pet.php?id=' . $row['id'] . '">Edit</a></td>
								<td align="left"><a href="delete_pet.php?id=' . $row['id'] . '">Delete</a></td>
								<td align="left">' . $row['petname'] . '</td>
								<td align="left">' . $row['age'] . '</td>
								<td align="left">' . $row['species'] . '</td>
								<td align="left">' . $row['breed'] . '</td>
								<td align="left" style="width: 35px;"><img style="width:80%;" src="data:image/png;base64,' . base64_encode($row['image'
								]) . '"></td>
							</tr>

							';
						} // End of WHILE loop.

						echo '</table>';
						mysqli_free_result ($r);
						mysqli_close($dbc);

						// Make the links to other pages, if necessary.
						if ($pages > 1) {
							
							echo '<br /><p>';
							$current_page = ($start/$display) + 1;
							
							// If it's not the first page, make a Previous button:
							if ($current_page != 1) {
								echo '<a href="my_pets.php?s=' . ($start - $display) . '&p=' . $pages . '&sort=' . $sort . '">Previous</a> ';
							}
							
							// Make all the numbered pages:
							for ($i = 1; $i <= $pages; $i++) {
								if ($i != $current_page) {
									echo '<a href="my_pets.php?s=' . (($display * ($i - 1))) . '&p=' . $pages . '&sort=' . $sort . '">' . $i . '</a> ';
								} else {
									echo $i . ' ';
								}
							} // End of FOR loop.
							
							// If it's not the last page, make a Next button:
							if ($current_page != $pages) {
								echo '<a href="my_pets.php?s=' . ($start + $display) . '&p=' . $pages . '&sort=' . $sort . '">Next</a>';
							}
							
							echo '</p>'; // Close the paragraph.
							
						} // End of links section.
							

						?>
					</div>
				</div>
				<br><br>
					<h2><div style="text-align:center;"><a class="btn btn-lg btn-primary centered animate-box" href="registerpet.php">Add Pet</a></div></h2>
			</div>
		</div>
	</div>

<?php
include('footer.php')
?>