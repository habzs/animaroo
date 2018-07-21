<!DOCTYPE HTML>
<!--
	Concept by gettemplates.co
	Twitter: http://twitter.com/gettemplateco
	URL: http://gettemplates.co
-->
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>animaroo. &mdash; we groom.</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by gettemplates.co" />
	<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
	<meta name="author" content="gettemplates.co" />

  	<!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Comfortaa:300,400,700" rel="stylesheet">
	
	<link rel="stylesheet" href="css/searchbar.css">
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/add_style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	<!-- hero video -->
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://www.gordonmac.com/wp-content/themes/2016/vendor/vide/jquery.vide.min.js"></script>


	</head>
	<body>
		
	<div class="fh5co-loader"></div>
	
	<div id="page">
	<nav class="fh5co-nav" role="navigation">
		<div class="container">
			<div class="row">
				<div class="col-xs-2 text-left">
					<div id="fh5co-logo"><a href="index.html">animaroo<span>.</span></a></div>
				</div>

				
				<div class="col-xs-3-new" style="float: right; position: relative; left: 50px; ">
					<input class="col-xs-2 form-control" style="width:150px; height:40px; font-size:15px" type="text" placeholder="Search" aria-label="Search" ></li>
					
						<button type="button" class="form-control-new"><img src="images/search_icon.png" style="width:18px; align-items:center" /></button>
					
				</div>

				<div class="col-xs-10-new text-right menu-1" style="float:right">
					<ul>
						<li class="has-dropdown">
							<a href="index.html">Home</a>
							<ul class="dropdown">
								<li><a href="indexphp.php">IndexPHP</a></li>
							</ul>
						</li>
						<!-- <li class="active"><a href="index.html">Home</a></li> -->
						<li class="has-dropdown">
							<a href="services.html">Services</a>
							<ul class="dropdown">
								<li><a href="#">Bath</a></li>
								<li><a href="#">Grooming</a></li>
								<li><a href="#">Walk</a></li>
								<li><a href="#">Rates</a></li>
							</ul>
						</li>
						<li class="has-dropdown">
								<a href="products.html">Products</a>
								<ul class="dropdown">
									<li><a href="#">Canine</a></li>
									<li><a href="#">Feline</a></li>
								</ul>
							</li>
						<li><a href="about.html">About</a></li>
						<li><a href="blog.html">Feedback</a></li>
						<li><a href="contact.html">Contact</a></li>
						<!-- <li><a href="#">Login</a></li> -->
						<?php 
						if ( isset( $_SESSION["email"] ) ) {
							echo '<li><a href="my_account.php ">My Account</a></li>';
						} else {
							#echo '<li><a href="login.php">Log In</a></li>';
						}
						?>
					</ul>
				</div>
			</div>
			
		</div>
	</nav>