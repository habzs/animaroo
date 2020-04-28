<?php
session_start();
include('header.php'); 

	$topic_id = "topic_id";

   //connect to server and select database
   $dbc = @mysqli_connect ('localhost:8889', 'root', 'root', 'animaroo') OR die ('Could not connect to MySQL:' . mysqli_connect_error());
   
   //gather the topics
   $get_topics = "select topic_id, topic_title,
   date_format(topic_create_time, '%b %e %Y at %r') as fmt_topic_create_time,
  topic_owner from forum_topics order by topic_create_time desc";
  $get_topics_res = mysqli_query($dbc, $get_topics) or die(mysqli_connect_error());
  if (mysqli_num_rows($get_topics_res) < 1) {
     //there are no topics, so say so
     $display_block = "<P><em>No topics exist.</em></p>";
  } else {
     //create the display string
     $display_block = "
	 <table border=	1 class=table>
     <tr>
     <th><center>TOPIC TITLE</center></th>
     </tr>";
  
      while ($topic_info = mysqli_fetch_array($get_topics_res)) {
         $topic_id = $topic_info['topic_id'];
         $topic_title = stripslashes($topic_info['topic_title']);
         $topic_create_time = $topic_info['fmt_topic_create_time'];
         $topic_owner = stripslashes($topic_info['topic_owner']);
  
         //get number of posts
         $get_num_posts = "select count(post_id) from forum_posts
              where topic_id = '$topic_id'";
         $get_num_posts_res = mysqli_query($dbc,$get_num_posts)
                or die(mysqli_connect_error());
        $num_posts = mysqli_fetch_array($get_num_posts_res,MYSQLI_BOTH);
        $post_id = 'post_id';
        //$num_posts = (count("post_id"));
        $num_posts = mysqli_fetch_array($get_num_posts_res);
        //$num_posts = mysqli_fetch_array($get_num_posts_res, 'count(post_id');
  
         //add to display
         $display_block .= "
         <tr>
         <td><a href=\"showtopic.php?topic_id=$topic_id\">
         <strong>$topic_title</strong></a><br>
         Created on $topic_create_time by $topic_owner</td>
         </tr>";
     }
  
     //close up the table
     $display_block .= "</table>";
  }
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

	
<?php 
if ( isset( $_SESSION["email"] ) ) { ?>

	<div id="fh5co-blog" class="fh5co-bg-section">
		<div class="container">
			<div class="row animate-box row-pb-md" data-animate-effect="fadeInUp">
				<div class="col-md-8 col-md-offset-2 text-left fh5co-heading">
					<span>Thoughts &amp; Ideas</span>
					<h2>Topics in animaroo.</h2>
					<!--<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>-->
				</div>
			</div>
			<div>
                <div class="col-md-8 text-left table text-left fh5c0-heading" style="align-self:center; padding:20px">
                <?php print $display_block; ?>
                <br>
                <p align="left" class"walk">Would you like to <a href ="addtopic.php">Add a Topic</a></center>
                
            </div>    
			</div>
		</div>
	</div>

<?php } else { ?>
	
	<div id="fh5co-blog" class="fh5co-bg-section">
		<div class="container">
			<div class="row animate-box row-pb-md" data-animate-effect="fadeInUp">
				<div class="col-md-8 col-md-offset-2 text-left fh5co-heading">
					<span>Thoughts &amp; Ideas</span>
                    <h2>It appears that you're not logged in!</h2>
                    <br>
					<p>Please log in to participate in the forums!</p>
				</div>
			</div>
		</div>
	</div>

<?php }
?>


<?php
include ("footer.php");
?>