<?php 
session_start();

	include("connection.php");
	include("functions.php");


	//if server erm may be like in this page got post request 
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		// eg: 
		//	<input id="text" type="text" name="user_name"><br><br>
		//  input name is user_name so $_POST['user_name'] to global variable $user_name
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		// !is_numeric($user_name) mean not a number of username
		// !empty($user_name) mean not empty of username
		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{
			//save to database
			// insert a data by formula
			// users () is user table in created database in xampp
			//$query = "insert into users () values ()";
			// '$password' need ' ' because it is text		
			
			$user_id = random_num(20);
			$query = "insert into users (user_id,user_name,password) values ('$user_id','$user_name','$password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Signup</title>
</head>
<body>

	<style type="text/css">
	
	#text{

		height: 25px;
		border-radius: 5px;
		padding: 4px;
		border: solid thin #aaa;
		width: 100%;
	}

	#button{

		padding: 10px;
		width: 100px;
		color: white;
		background-color: lightblue;
		border: none;
	}

	#box{

		background-color: grey;
		margin: auto;
		width: 300px;
		padding: 20px;
	}

	</style>

	<div id="box">
		
		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Signup</div>

			<input id="text" type="text" name="user_name"><br><br>
			<input id="text" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Signup"><br><br>

			<a href="login.php">Click to Login</a><br><br>
		</form>
	</div>
</body>
</html>