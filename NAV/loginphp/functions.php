<?php

function check_login($con)
{
	// $_SESSION['user_id'] 
	// if global variable ($_SESSION['user_id']) is isset which mean exist 
	if(isset($_SESSION['user_id'])) 
	{

		$id = $_SESSION['user_id'];

		//read from database
		//query means to select (* = all) from (users = database table which name users) where by (user_id = variable name in users table) = '$id' limit 1 )
		//sql code
		$query = "select * from users where user_id = '$id' limit 1";

		//  mysqli_query($con,$query)
		//  get row information depend on id from database table asset to $result
		$result = mysqli_query($con,$query);
		// if got result and the result is more than 0
		if($result && mysqli_num_rows($result) > 0)
		{
			//fetch mean take 
			//assoc = associative array 关联数组 
			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect 转去 to login.php page 
	header("Location: login.php");

	die;//code will no continue like return


}

function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	//random num 4-20 
	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...
		//random num 0-9	
		$text .= rand(0,9);
	}

	return $text;
}