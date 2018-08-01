<?php
session_start();
include ('header.php');

   //check for required info from the query string
   if (!$_GET['topic_id']) {
      header("Location: topiclist.php");
      exit;
   }
   
   //connect to server and select database
   $dbc = @mysqli_connect ('localhost:8889', 'root', 'root', 'animaroo') OR die ('Could not connect to MySQL:' . mysqli_connect_error());
   
  //verify the topic exists
  $verify_topic = "select topic_title from forum_topics where
      topic_id = $_GET[topic_id]";
  $verify_topic_res = mysqli_query($dbc, $verify_topic)
      or die(mysqli_connect_error());
      

    
  if (mysqli_num_rows($verify_topic_res) < 1 ) {
      //this topic does not exist
     $display_block = "<P><em>You have selected an invalid topic.
        Please <a href=\"topiclist.php\">try again</a>.</em></p>";
  } else {
      //get the topic title
		$topic_title = mysqli_fetch_array($verify_topic_res,MYSQLI_ASSOC);
		$string= implode($topic_title);
		// echo $string;
		
  };
		//$topic_title = mysqli_fetch_array($verify_topic_res, 'topic_title');
    
  
     //gather the posts
     $get_posts = "select post_id, post_text, date_format(post_create_time,
          '%b %e %Y at %r') AS fmt_post_create_time, post_owner from
          forum_posts where topic_id = $_GET[topic_id]
          order by post_create_time asc";
  
     $get_posts_res = mysqli_query($dbc, $get_posts) or die(mysqli_connect_error());
  
     //create the display string
     $display_block = "
	 <P>Showing posts for the <strong>$string</strong> topic:</p>

     <table border=1 class=table>
     <tr>
     <th><center>AUTHOR</center></th>
     <th width=70%><center>POST</center></th>
     </tr>";
  
     while ($posts_info = mysqli_fetch_array($get_posts_res)) {
         $post_id = $posts_info['post_id'];
         $post_text = nl2br(stripslashes($posts_info['post_text']));
         $post_create_time = $posts_info['fmt_post_create_time'];
         $post_owner = stripslashes($posts_info['post_owner']);
  
         //add to display
         $display_block .= "
         <tr>
         <td width=35% valign=top>$post_owner<br>[$post_create_time]</td>
         <td width=45% valign=top>$post_text<br><br>
          <a href=\"replytopost.php?post_id=$post_id\"><strong>REPLY TO
          POST</strong></a></td>
         </tr>";
     }
  
     //close up the table
     $display_block .= "</table>";
    
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
					<h2>Posts in Topic</h2>
				</div>
			</div>
			<div class="row col-md-13">
                <div class="col-md-8 table text-left table fh5c0-heading" style="align-self:center">
                <?php print $display_block; ?>
                <p><a href="/topiclist.php"><button type="submit" class="btn btn-primary" style="margin-left:515px">Back to Forum!</button></a></p>
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
