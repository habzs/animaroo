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
      

    
  if (mysqli_num_rows($verify_topic_res) < 1) {
      //this topic does not exist
     $display_block = "<P><em>You have selected an invalid topic.
        Please <a href=\"topiclist.php\">try again</a>.</em></p>";
  } else {
      //get the topic title
      while($topic_title = mysqli_fetch_array($verify_topic_res)){
            
      }
     //$topic_title = mysqli_fetch_array($verify_topic_res, 'topic_title');
    
  
     //gather the posts
     $get_posts = "select post_id, post_text, date_format(post_create_time,
          '%b %e %Y at %r') AS fmt_post_create_time, post_owner from
          forum_posts where topic_id = $_GET[topic_id]
          order by post_create_time asc";
  
     $get_posts_res = mysqli_query($dbc, $get_posts) or die(mysqli_connect_error());
  
     //create the display string
     $display_block = "
     <P>Showing posts for the <strong>$topic_title</strong> topic:</p>
  
     <table width=100% cellpadding=3 cellspacing=1 border=1>
     <tr>
     <th>AUTHOR</th>
     <th>POST</th>
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

	

	<div id="fh5co-blog" class="fh5co-bg-section">
		<div class="container">
			<div class="row animate-box row-pb-md" data-animate-effect="fadeInUp">
				<div class="col-md-8 col-md-offset-2 text-left fh5co-heading">
					<span>Thoughts &amp; Ideas</span>
					<h2>Posts in Topic</h2>
					<!--<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>-->
				</div>
			</div>
			<div class="row col-md-13">
                <div class="col-md-8 col-md-offset-2 table text-left table fh5c0-heading" style="align-self:center">
                <?php print $display_block; ?>
                
            </div>    
            

				<!--<div class="col-md-4 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="fh5co-post">
						<span class="fh5co-date">Sep. 12th</span>
						<h3><a href="#">Web Design for the Future</a></h3>
						<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
						<p class="author"><img src="images/person1.jpg" alt="Free HTML5 Bootstrap Template by gettemplates.co"> <cite> Mike Adam</cite></p>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="fh5co-post">
						<span class="fh5co-date">Sep. 23rd</span>
						<h3><a href="#">Web Design for the Future</a></h3>
						<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
						<p class="author"><img src="images/person1.jpg" alt="Free HTML5 Bootstrap Template by gettemplates.co"> <cite> Mike Adam</cite></p>
					</div>
				</div>
				<div class="clearfix visible-sm-block"></div>

				<div class="col-md-4 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="fh5co-post">
						<span class="fh5co-date">Sep. 24th</span>
						<h3><a href="#">Web Design for the Future</a></h3>
						<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
						<p class="author"><img src="images/person1.jpg" alt="Free HTML5 Bootstrap Template by gettemplates.co"> <cite> Mike Adam</cite></p>
					</div>
				</div>

				<div class="clearfix visible-md-block"></div>

				<div class="col-md-4 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="fh5co-post">
						<span class="fh5co-date">Sep. 12th</span>
						<h3><a href="#">Web Design for the Future</a></h3>
						<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
						<p class="author"><img src="images/person1.jpg" alt="Free HTML5 Bootstrap Template by gettemplates.co"> <cite> Mike Adam</cite></p>
					</div>
				</div>

				<div class="clearfix visible-sm-block"></div>

				<div class="col-md-4 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="fh5co-post">
						<span class="fh5co-date">Sep. 23rd</span>
						<h3><a href="#">Web Design for the Future</a></h3>
						<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
						<p class="author"><img src="images/person1.jpg" alt="Free HTML5 Bootstrap Template by gettemplates.co"> <cite> Mike Adam</cite></p>
					</div>
				</div>

				<div class="col-md-4 col-sm-6 animate-box" data-animate-effect="fadeInUp">
					<div class="fh5co-post">
						<span class="fh5co-date">Sep. 24th</span>
						<h3><a href="#">Web Design for the Future</a></h3>
						<p>Facilis ipsum reprehenderit nemo molestias. Aut cum mollitia reprehenderit. Eos cumque dicta adipisci architecto culpa amet.</p>
						<p class="author"><img src="images/person1.jpg" alt="Free HTML5 Bootstrap Template by gettemplates.co"> <cite> Mike Adam</cite></p>
					</div>
				</div>
				
				<div class="clearfix visible-md-block"></div>-->


			</div>
		</div>
	</div>


<?php
include ("footer.php");
?>
