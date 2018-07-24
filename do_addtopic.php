<?php
session_start();
$topic_title = $_SESSION['topic_title'];

//check for required fields from the form
  if ((!$_POST['topic_owner']) || (!$_POST['topic_title'])
       || (!$_POST['post_text'])) {
       header("Location: addtopic.php");
       exit;
   }
   
   //connect to server and select database
  $dbc = mysqli_connect("localhost:8889", "root", "root", "animaroo") OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );
      /*or die(mysql_error());*/
  //mysqli_set_charset($dbc, 'animaroo');
  
  //create and issue the first query
  $add_topic = "insert into forum_topics values ('', '$_POST[topic_title]',
      now(), '$_POST[topic_owner]')";
  //mysqli_query($dbc, $add_topic); //or die(mysql_error());
  
  //get the id of the last query 
  //mysqli_insert_id($topic_id);
  
  //create and issue the second query
  $add_post = "insert into forum_posts values ('', '$topic_id',
      '$_POST[post_text]', now(), '$_POST[topic_owner]')";
  //mysqli_query($dbc, $add_post); //or die(mysql_error());
  
  //create nice message for user
  $msg = "<P>The <strong>$topic_title</strong> topic has been created.</p>";
  ?>
  <html>
  <head>
  <title>New Topic Added</title>
  </head>
  <body>
  <h1>New Topic Added</h1>
  <?php print $msg; ?>
  </body>
  </html>