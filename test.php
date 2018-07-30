<?php # Script 10.2 - delete_user.php
// This page is for deleting a user record.
// This page is accessed through view_users.php.
session_start();

include ('header.php');
require ('mysqli_connect.php');

$emails = $_SESSION['email'];
$id = $_GET['id'];
echo $id . $emails;

$result = mysqli_query($dbc,"SELECT likes FROM pets WHERE id='$id'") or die(msyql_error());
$row = mysqli_fetch_array($result);
$likes = $row['likes'];
echo $nlikes;

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {


    $nlikes = $_POST['likes'] + 1;
    $id = $_POST['id'];

    // Make the query:
    $q = "UPDATE pets SET likes='$nlikes' WHERE id='$id'";
    $r = @mysqli_query ($dbc, $q);
    if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.
            
            // Print a message:
            echo 'YES'; 
            echo $newlikes;
                

        } else { // If the query did not run OK.
            echo '<p class="error">The user could not be deleted due to a system error.</p>'; // Public message.
            echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
        }

} else { // Show the form. ?>

    <header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header7.jpg);" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-7 text-left">
                    <div class="display-t">
                        <div class="display-tc animate-box" data-animate-effect="fadeInUp">
                            <h1 class="mb30">Modify Users.</h1>;
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <?php // Retrieve the user's information:
    $q = "SELECT likes FROM pets WHERE id=$id";
    $r = @mysqli_query ($dbc, $q);

    if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

        // Get the user's information:
        $row = mysqli_fetch_array ($r, MYSQLI_NUM); 
        $msg = "Current likes: " . $row[0] . ".<br> Do you want to like it?"?>

    <div id="fh5co-contact">
        <div class="container">
            <div class="row">
                <div class="animate-box">
                    <h3>Your Account.</h3>
                        <p>
                            Change everything, or update your profile.
                        </p>

                            <h3><?php echo '<div style="color:red;text-align:center;">' . $msg . '</div>';?></h3>
                            <div class="row col-md-13" style="width:300px; margin:auto;" >
                            <form action="rating.php" method="post">
                            <div style="text-align:center;margin:auto">
                                <input type="submit" class="btn btn-lg btn-primary centered" name="submit" value="Like!" />
                                <?php echo '<input type="hidden" name="id" value="' . $id . '" />' ?>
                                <?php echo '<input type="hidden" name="likes" value="' . $likes . '" />' ?>
                                

                            </div>
                            </form>
                            </div>
                </div>
            </div>
            
        </div>
    </div>
    
    <?php } else { // Not a valid user ID.
        echo '<p class="error">This page has been accessed in error.</p>';
    }

} // End of the main submission conditional.

mysqli_close($dbc);
        
include ('footer.php');
?>
