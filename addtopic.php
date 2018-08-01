<?php
session_start();
include ('header.php');
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
					<h2>Add a topic</h2>
					<!--<p>Dignissimos asperiores vitae velit veniam totam fuga molestias accusamus alias autem provident. Odit ab aliquam dolor eius.</p>-->
				</div>
			</div>
			<div class="row col-md-13"  >
                      <form class="" method="post" action="do_addtopic.php">
                        <div class="form-group">
<!--                           <label>Email address</label>
                          <input type="email" name="topic_owner" class="form-control" placeholder="Enter email" value="<?php echo $_SESSION['email']; ?>"> </div> -->
                        <div class="form-group">
                          <label>Topic Title</label>
                          <input type="text" name="topic_title" id="topic_title" class="form-control" placeholder="Enter topic"> </div>
                        <div class="form-group">
                          <label>Post Text</label>
                          <textarea name="post_text" rows=8 cols=40 wrap=virtual class="form-control" placeholder="Enter text"></textarea></div>
						<button type="submit" name="submit" class="btn btn-primary">Send</button>
                      </form>
                     </div>


			</div>
		</div>
	</div>

<?php
include ("footer.php");
?>

