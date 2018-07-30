<?php
session_start();
include ('header.php');

  $topic_id ='topic_id';
  $topic_title =$_POST['topic_title'];
 //check for required fields from the form
   if ((!$_POST['topic_owner']) || (!$_POST['topic_title'])
       || (!$_POST['post_text'])) {
       header("Location: addtopic.php");
       exit;
   }
   
   //connect to server and select database
  $dbc = @mysqli_connect ('localhost:8889', 'root', 'root', 'animaroo') OR die ('Could not connect to MySQL:' . mysqli_connect_error());
  //mysqli_select_db($dbc"animaroo") or die(mysqli_connect_error());
  
  //create and issue the first query
  $add_topic = "insert into forum_topics values ('', '$_POST[topic_title]',
      now(), '$_POST[topic_owner]')";
  mysqli_query($dbc, $add_topic) or die(mysqli_connect_error());
  
  //get the id of the last query 
  $topic_id = mysqli_insert_id($dbc);
  //$topic_id = mysqli_insert_id();
  //create and issue the second query
  $add_post = "insert into forum_posts values ('', '$topic_id',
      '$_POST[post_text]', now(), '$_POST[topic_owner]')";
  mysqli_query($dbc, $add_post) or die(mysqli_connect_error());
  
  //create nice message for user
  $msg = "<P>The <strong>$topic_title</strong> topic has been created.</p>";
  ?>

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
					<h2>New Topic Added</h2>

				</div>
			</div>
			<div class="row col-md-13">  
                <div class="text-center"> 
				<?php print $msg; ?>
				<a href="topiclist.php" class="btn btn-primary">Go to Forum Page</a>
            </div>


			</div>
		</div>
	</div>

<?php
include ("footer.php");
?>