<?php

function check_login($con)
{
	// $_SESSION['user_id'] 

	if(isset($_SESSION['user_id'])) //if user_id exist
	{

		$id = $_SESSION['user_id'];

		//ask database
		//query means to search and select database by user_id ??
		//sql code
		$query = "select * from users where user_id = '$id' limit 1";

		//  mysqli_query($con,$query)
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

	die;//code will no continue


}

function random_num($length)
{

	$text = "";
	if($length < 5)
	{
		$length = 5;
	}

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		# code...

		$text .= rand(0,9);
	}

	return $text;
}