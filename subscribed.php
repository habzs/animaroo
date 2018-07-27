<?php

$name = $_POST['name'];
$connection = mysqli_connect('localhost:8889', 'root', 'root');
if (!$connection){
    die("Database Connection Failed" . mysqli_error($connection));
}
$select_db = mysqli_select_db($connection, 'animaroo');
if (!$select_db){
    die("Database Selection Failed" . mysqli_error($connection));
}

$name = $_POST['name'];
$emailcheck="select email from newsletter where (email='$name');";
$res=mysqli_query($connection,$emailcheck);

if (mysqli_num_rows($res) > 0) {
// output data of each row
$row = mysqli_fetch_assoc($res);
if($name==$_POST['name'])
{
    $title = "Email already exists!";
    echo $title;
    $errors[] = "ERROR";
}
}

if (empty($errors)) {
    $query = "INSERT INTO newsletter (email) VALUES ('$name')";
    $result = mysqli_query($connection, $query);

    $title = 'Thanks for subscribing!';
    echo $title;    
}

?>