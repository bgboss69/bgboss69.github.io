<?php 
session_start(); // call $_SESION; ??
	// $_SESION; ???

	// import php file
	include("connection.php"); 
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>My website</title>
</head>
<body>

	<a href="logout.php">Logout</a>
	<h1>This is the index page</h1>

	<br>

<!-- 
	then can insert the $user_data which mean include all data of that user 
	so can get name of user or something information of user insert to html code 
-->

	Hello, <?php echo $user_data['user_name']; ?>
</body>
</html>