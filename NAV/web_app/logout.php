<?php

session_start();

// if global variable ($_SESSION['user_id']) is isset which mean exist 
if(isset($_SESSION['user_id']))
{
	// unset global variable ($_SESSION['user_id'])
	unset($_SESSION['user_id']);

}

header("Location: login.php");
die;