<?php
session_start();
include ('header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
include('config.php');

if (isset($_POST['username']))
{
	$username = $_POST['username'];
} else {
	$username = '';
}

if (isset($_POST['pass']))
{
	$pass = $_POST['pass'];
} else {
	$pass = '';
}


if (isset($_POST['username']))
{
    $encryptedpass = sha1($pass);

	$sql_statement  = "SELECT email,first_name,last_name ";
    $sql_statement .= "FROM users ";
    $sql_statement .= "WHERE email = '".$username."' ";
    $sql_statement .= "AND pass = '".$encryptedpass."' ";


    $result = mysqli_query($con, $sql_statement);
    $row = mysqli_fetch_row($result);


    $outputDisplay = "";
    $myrowcount = 0;

    if (!$row) {

        $outputDisplay = "Wrong Username/Password";
    } else {

    	$numresults = mysqli_num_rows($result);

    	if ($numresults == 0)
    	{
	    	$outputDisplay .= "Invalid Login <br /> ";
    		$outputDisplay .= "Please Go BACK and try again";
    	} else {

            $_SESSION["email"] = $row[0];
            $_SESSION["first_name"] = $row[1];
            $_SESSION["last_name"] = $row[2];
           
           $db = mysqli_connect("localhost:8889","root","root","animaroo"); 
$sql = "SELECT * FROM users WHERE email = $username";
$sth = $db->query($sql);
        }
      //  
    }
} else {
	

}

}


// LOG OUT SYSTEM

if ( isset( $_GET["action"] ) and $_GET["action"] == "logout" ) {
	logout();
} else {
	//
}


function logout() {
	unset( $_SESSION["email"] );
	session_write_close();
  }
?>

	<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header7.jpg);" data-stellar-background-ratio="0.5">
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
								echo '<h1 class="mb30">Hi! Please Log In. </h1>';
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
						/* Form Required Field Validation */
					foreach($_POST as $key=>$value) {
						if(empty($_POST[$key])) {
						$error_message = "All Fields are required";
						break;
						}
					}

					?>

					<?php if(empty($_SESSION["email"])) { ?>

					<form name="loginForm" method="post" action="">
						<table border="0" width="500" align="center" class="demo-table">

							<?php if(!empty($success_message)) { ?>	
							<div class="success-message"><?php if(isset($success_message)) echo $success_message; ?></div>
							<?php } ?>

							<?php if(!empty($error_message)) { ?>	
							<div class="error-message"><?php if(isset($error_message)) echo $error_message; ?></div>
							<?php } elseif (!empty($outputDisplay)) {?>
							<div class="error-message"><?php if(isset($outputDisplay)) echo $outputDisplay; ?></div>
							<?php } ?>


							<div class="row centered" style="margin-top:50px;">
								<div><h1>You're not logged in!</h1></div>
							</div>	
						



						</table>
					</form>

					<?php } else { ?>
						<div>
						<h2><a href="logout.php? action=logout">Log Out.</a></h2> 
						<h2><a href="edit_details.php">Edit Details.</a></h2>
						
				
					<?php } ?>
						</div>
					</div>

				</div>
			</div>
			
		</div>
	</div>

	<div id="fh5co-started">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<span>Let's work together</span>
					<h2>Try this template for free</h2>
					<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>
					<p><button type="submit" class="btn btn-default">Get In Touch</button></p>
				</div>
			</div>
		</div>
	</div>

<?php 
include ("footer.php");
?>

