<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Register an account</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <form action="register.php" method="POST">
        Username: <input type="text" name="username">
        <br />
        Password: <input type="password" name="password">
        <br />
        Confirm Password: <input type="password" name="repassword">
        <br />
        Email: <input type="text" name="email">
        <br />
        <input type="submit" name="submit" value="Register"> or <a href="loginnewtest.php">Login</a>
    </form>    
        
</body>
</html>

<?php
require('mysqli_connect.php');
$username = @$_POST['username'];
$password = @$_POST['password'];
$repass = @$_POST['repassword'];
$email = @$_POST['email'];

if (isset($_POST['submit'])) {
   if ($query = mysqlquery("INSERT INTO users ('user_id', 'first_name', 'last_name', 'email', 'pass') VALUES ('', '', '', '".$email."')"))
        echo "Success";
    } else {
        echo "Failure";
    }
?>