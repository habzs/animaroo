<?php
session_start();
include ('header.php');


if(isset($_POST['topic_id'])){$topic_id=$_POST['topic_id'];}

    //echo $_POST["topic_id"];
    //$topic_title = $_POST['topic_title'];
   //connect to server and select database; we'll need it soon
   $dbc = mysqli_connect("localhost:8889", "root", "root")
       or die(mysqli_connect_error());
   mysqli_select_db($dbc,"animaroo") or die(mysql_connect_error());
   
	$post_owner = $_SESSION['email'];

   //check to see if we're showing the form or adding the post
   if (isset($_POST["op"]) != "addpost") {
      // showing the form; check for required item in query string
     if (!$_GET['post_id']) {
         header("Location: topiclist.php");
         exit;
     }
  
       //still have to verify topic and post
     //$verify = "select ft.topic_id, ft.topic_title from
      //forum_posts as fp left join forum_topics as ft on
      //fp.topic_id = ft.topic_id where fp.post_id = $_GET[post_id]";

      $verify = "SELECT forum_topics.topic_id, forum_topics.topic_title
                FROM forum_posts
                INNER JOIN forum_topics ON forum_posts.topic_id=forum_topics.topic_id 
                WHERE forum_posts.post_id = $_GET[post_id]";


 
     $verify_res = mysqli_query($dbc, $verify) or die(mysqli_connect_error());
      
     if (mysqli_num_rows($verify_res) < 1) {
         //this post or topic does not exist
         header("Location: topiclist.php");
         exit;
     } else {
         //get the topic id and title
         $string = mysqli_fetch_array($verify_res,MYSQLI_ASSOC);
        // $string = implode($string);
         //print_r($string);
         $topic_id = $string['topic_id'];
         $topic_title = $string['topic_title'];
         //echo $string;


         //echo $topic_id;

        //$topic_title = mysqli_fetch_array($verify_res, MYSQLI_ASSOC);
        //$string = explode(',', $topic_title);
        //print implode($string);
         //echo $topic_title;

        $display_block = "
         <form method=post action=\"$_SERVER[PHP_SELF]\">
  
  
         <P><strong>Post Text:</strong><br>
         <textarea name=\"post_text\" class=\"form-control\" rows=8 cols=40 wrap=virtual></textarea>
  
         <input type=\"hidden\" name=\"op\" value=\"addpost\">
         <input type=\"hidden\" name=\"topic_id\" value=\"$topic_id\">
  
         <P><input type=\"submit\" name=\"submit\" class=\"btn btn-primary\" value=\"Add Post\"></p>
  
         </form>";
     }
  } else if (isset($_POST["op"]) == "addpost") {
     //check for required items from form
     if ((!$_POST['topic_id']) || (!$_POST['post_text'])) {
         header("Location: topiclist.php");
         exit;
     }
  
     //add the post
     $add_post = "insert into forum_posts values ('', '$_POST[topic_id]',
      '$_POST[post_text]', now(), '$post_owner')";
     mysqli_query($dbc, $add_post) or die(mysqli_connect_error());
 
     //redirect user to topic
     header("Location: showtopic.php?topic_id=$topic_id");
     exit;
  }
  ?>

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

	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	
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
	<link rel="stylesheet" href="css/popupemail.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	<!-- ajax 
	<script src="http://code.jquery.com/jquery-1.9.1.js"></script> -->


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


				<div class="col-xs-10 text-right menu-1" style="float:right">
					<ul>
						<li><a href="indexphp.php">Home</a></li>
						<li class="has-dropdown">
							<a href="services.php">Services</a>
							<ul class="dropdown">
								<li><a href="services.php#test">Bath</a></li>
								<li><a href="services.php#test">Grooming</a></li>
								<li><a href="services.php#test">Walk</a></li>
								<li><a href="services.php#rate">Rates</a></li>
							</ul>
						</li>
						<li class="has-dropdown">
								<a href="productsdog.html">Products</a>
								<ul class="dropdown">
									<li><a href="productsdog.html">Dog</a></li>
									<li><a href="productscat.html">Cat</a></li>
									<li><a hred="productsother.html">Others</a></li>
								</ul>
							</li>
						<li><a href="about.php">About</a></li>
						<li><a href="topiclist.php">Feedback</a></li>
						<li><a href="contact_us.php">Contact</a></li>
						<?php 
						if ( isset( $_SESSION["email"] ) ) {
							echo '<li><a href="my_account.php ">My Account</a></li>';
						} else {
							echo '<li><a href="login.php">Log In</a></li>';
						}
						?>
					</ul>
				</div>
			</div>
			
		</div>
	</nav>

  <header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header5.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-7 text-left">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeInUp">
							<h1 class="mb30">Your Feedback</h1>
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
					<h2>Post your reply in <strong><?php echo $topic_title; ?></strong> </h2>

				</div>
			</div>
			<div class="row col-md-13">
                <div class="form-group">
                <?php print $display_block; ?>
                
            </div>    


			</div>
		</div>
	</div>


<?php
include ("footer.php");
?>
