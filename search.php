<?php
session_start();
include('header.php');

  $dbc = @mysqli_connect ('localhost:8889', 'root', 'root', 'animaroo') OR die ('Could not connect to MySQL:' . mysqli_connect_error());

?>

<style>
tr:nth-child(even){background-color: #f2f2f2}
</style>
<header id="fh5co-header" class="fh5co-cover fh5co-cover-sm" role="banner" style="background-image:url(images/header7.jpg);" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row">
				<div class="col-md-7 text-left">
					<div class="display-t">
						<div class="display-tc animate-box" data-animate-effect="fadeInUp">
							<h1 class="mb30">Our Pets</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	

	<div id="fh5co-team">
		<div class="container">
			<div class="row animate-box row-pb-md">
				<div class="col-md-8 col-md-offset-2 text-left fh5co-heading">
					<span>Pets with us</span>
					<h2>Pets that we are caring for!</h2>
					<br>
					<p>
						Here's a list of pets who you searched for!<br>
						Feel free to rate them! :)
					</p>
					<br>
					<!--<form action="search.php" method="POST">
					<input class="col-xs-2 form-control" style="width:150px; height:40px; font-size:15px" type="text" placeholder="Search" name="search" >
		

					<button type="submit" name="submit-search" class="form-control-new"><img src="images/search.png" style="width:18px; align-items:center"/> </button>-->
					
                </div>
                
			</div>
			<div class="row">
				<div class="animate-box" data-animate-effect="fadeIn">

                    <?php 
                        if (isset($_POST['submit-search'])) {
                            $search = mysqli_real_escape_string($dbc, $_POST["search"]);
                            $sql = "SELECT * FROM pets WHERE petname LIKE '%$search%' OR age LIKE '%$search%' OR species LIKE '%$search%' OR breed LIKE '%$search%'";
                            $result = mysqli_query($dbc, $sql);
                            $queryResult = mysqli_num_rows($result);

                            echo "There are ".$queryResult." results!";
                            echo "<br><br>";

                            if($queryResult > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                   echo "<table align='center' cellspacing='0' cellpadding='5' width='75%' class='table col-md-8' border=1px>
                                                    <tr>    
                                                        <th style='color:#F73859'>Pet Name</th>
                                                        <th style='color:#F73859'>Age</th>
                                                        <th style='color:#F73859'>Species</th>
                                                        <th style='color:#F73859'>Breed</th>
                                                    </tr>
                                                    <tr>
                                                        <td><p>".$row['petname']."</p></td>
                                                        <td><p>".$row['age']."</p></td>
                                                        <td><p>".$row['species']."</p></td>
                                                        <td><p>".$row['breed']."</p></td>
                                                    </tr>
                                        </table>";
                                }       
                            } else {
                                echo "There are no results matching your search!";
                            }
                        }
                    ?>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php
include('footer.php')
?>