<?php
// variable of databasse
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "login_db";//in name of the database you create

// database connection
// $con = mysqli_connect('localhost','root','','login_sample_db') 

if(!$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname)) // if fail connect to database
{

	die("failed to connect!");
}

?>