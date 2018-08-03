<?php
session_start();
include('header.php');

$page_title = 'View the Current Users';
include ('header.php');
require ('mysqli_connect.php');

$email = $_SESSION['email'];

$result = mysqli_query($dbc,"SELECT admin FROM users WHERE email = '$email'") or die(msyql_error());
$row = mysqli_fetch_array($result);
$admin = $row['admin'];
$_SESSION['admin'] = $admin;

// Number of records to show per page:
$display = 10;

// Determine how many pages there are...
if (isset($_GET['p']) && is_numeric($_GET['p'])) { // Already been determined.
	$pages = $_GET['p'];
} else { // Need to determine.
 	// Count the number of records:
	$q = "SELECT COUNT(user_id) FROM users";
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
	case 'ln':
		$order_by = 'last_name ASC';
		break;
	case 'fn':
		$order_by = 'first_name ASC';
		break;
	case 'rd':
		$order_by = 'registration_date ASC';
		break;
	case 'email':
		$order_by = 'email ASC';
		break;

	default:
		$order_by = 'registration_date ASC';
		$sort = 'rd';
		break;
}
	
// Define the query:
$q = "SELECT last_name, first_name, email, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr, user_id, image FROM users ORDER BY $order_by LIMIT $start, $display";		
$r = @mysqli_query ($dbc, $q); // Run the query.
?>

	<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header7.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-7 text-left">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeInUp">
							<h1 class="mb30">Admin Corner</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

<?php 
if (isset($_SESSION["email"]) && $admin == 1) { ?>

	<div id="fh5co-team">
		<div class="container">
			<div class="row animate-box row-pb-md">
				<div class="col-md-8 col-md-offset-2 text-left fh5co-heading">
					<span>Behind the scenes</span>
					<h2>Admin Corner</h2>
					<br>
					<p>
						Welcome to your restricted corner, admin.
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
							<td align="left"><b><a href="registered_users.php?sort=ln">Last Name</a></b></td>
							<td align="left"><b><a href="registered_users.php?sort=fn">First Name</a></b></td>
							<td align="left"><b><a href="registered_users.php?sort=email">Email</a></b></td>
							<td align="left"><b><a href="registered_users.php?sort=rd">Date Registered</a></b></td>
							<td align="left"><b><a href="?">Image</a></b></td>
						</tr>
						';

						// Fetch and print all the records....
						$bg = '#eeeeee'; 
						while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
							$bg = ($bg=='#eeeeee' ? '#ffffff' : '#eeeeee');
								echo '<tr bgcolor="' . $bg . '">
								<td align="left"><a href="edit_user.php?id=' . $row['user_id'] . '">Edit</a></td>
								<td align="left"><a href="delete_user.php?id=' . $row['user_id'] . '">Delete</a></td>
								<td align="left">' . $row['last_name'] . '</td>
								<td align="left">' . $row['first_name'] . '</td>
								<td align="left">' . $row['email'] . '</td>
								<td align="left">' . $row['dr'] . '</td>
								<td align="left" style="width: 35px;"><img style="width:80%;" src="images/users/' . $row['image'] . '"></td>
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

<?php } else { ?>
	<div class="col-md-8 col-md-offset-2 text-left fh5co-heading">
		<span>Behind the scenes</span>
		<h2>Admin Corner</h2>
		<br>
		<p>
			You must be in the wrong place, you're not an admin!
		</p>
	</div>
<?php } ?>




<?php
include('footer.php')
?>