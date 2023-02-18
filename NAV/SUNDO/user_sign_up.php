<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>user sign up page</title>
    <script src="https://kit.fontawesome.com/a627fa96ad.js" crossorigin="anonymous"></script>
</head>
<style>
    *{
        box-sizing: border-box;
    }
    
    a{
        display: block;
        color: white;
        font-size: 30px;
        text-decoration: none;
    }

    body{
        position: relative;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        height: 100vh;
        background-color: black;
        background-size: cover;
        background-image: url(./IMAGE/index.jpg);
        background-position: 30% 30%;
        background-repeat:no-repeat ;
        overflow: hidden;

    }

    .wrong_box{
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 30px;
        height: 30px;
        transition: all 1s;
        color: white;
    }

    .wrong_box:hover{
        transform: scale(1.1);
    }

    form{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 50vw;
        height: 35vw;
        box-shadow: 0.5rem 0.5rem gold, -0.5rem -0.5rem white;
    }

    h1{

        display: inline-block;
        padding: 30px;
        color: white;
        font-size:40px ;
        box-shadow: 0.25rem 0.25rem white, -0.25rem -0.25rem gold;

    }

    label{

        color: white;
        font-size: 30px;

    }
  

    input{
        height: 50px;
        display: inline-block;
        font-size: 30px;
        background-color: black;
        color: white;
        border-bottom: solid 3px lightgoldenrodyellow ;
        transition: all 0.7s;
    }

    
    .box{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .submit{

        margin-top: 30px;
        margin-left: 30px;
        padding: 10px;
        font-size: 30px;
        color: white;
        background-color: transparent;
        border:none;
        transition: all 0.7s;
        
    }

    .submit:hover{
        transform: scale(1.1);
        box-shadow: 0.25rem 0.25rem white , -0.25rem -0.25rem gold;

    }

</style>
<body>
<?php
    session_start();
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


        $dbname = 'webappdb';
        $tablename = 'user_login';
        $servername = "localhost"; 
        $username = "root"; 
        $password = "";
        // Check connection
        if (!mysqli_connect($servername, $username, $password)){
            die("Connection failed : " . mysqli_connect_error());
        }

        // query
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
        $con = mysqli_connect($servername, $username, $password);
        // execute query
        if(mysqli_query($con , $sql)){
        $con = mysqli_connect($servername, $username, $password, $dbname);

        // sql to create new table

        $sql = " CREATE TABLE IF NOT EXISTS $tablename
                (user_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                 user_acc VARCHAR (100) NOT NULL,
                 user_pass VARCHAR (100) NOT NULL,
                 user_PIN VARCHAR (100) NOT NULL
                );";

            if (!mysqli_query($con, $sql)) {
                echo "Error creating table : " . mysqli_error($con);
            }
        }
        
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
    
        $user_acc = $_POST['user_acc'];
        $user_pass = $_POST['user_pass'];
        $user_PIN = $_POST['user_PIN'];
        if (!empty($user_acc) && !empty($user_pass) && !is_numeric($user_acc)&& strlen($user_pass) > 10) 
        {

            $dbname = 'webappdb';
            $tablename = 'user_login';
            $servername = "localhost"; 
            $username = "root"; 
            $password = "";

            $user_id = random_num(20);
            $con = mysqli_connect($servername, $username, $password, $dbname);  
            $query = "INSERT INTO $tablename (user_id,user_acc,user_pass,user_PIN) VALUES('$user_id','$user_acc','$user_pass','$user_PIN')";

            mysqli_query($con, $query);

            header("Location: user_login.php");
            die;
        }else
        {   
            echo "<script> alert('Please enter some valid information! or need to key in stronger password') </script>";
        }
    }

?>
    <!-- html -->
    <div class="wrong_box">
        <a href="./index.php"><i class="fa-regular fa-circle-xmark"></i></a>
    </div>
    <form method="POST">
        <h1>USER SIGN UP PAGE</h1>
        <label for="user_acc">USER</label>
        <input type="text" name="user_acc">
        <label for="user_pass">PASSWORD</label>
        <input type="password" name="user_pass">
        <label for="user_PIN">PIN</label>
        <input maxlength="6" type="password" name="user_PIN">
        <div class="box">
            <input class="submit" type="submit" value="SIGN UP">
            <a href="./user_login.php"><div class="submit">LOGIN</div></a>
        </div>
        <a href="./password_generator.php" style="width:90%; display: block; text-align: right;font-size: 16px;">need help?</a>
    </form>

</body>
</html>