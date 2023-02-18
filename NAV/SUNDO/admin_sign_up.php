<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin sign up page</title>
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
        $tablename = 'admin_login';
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
                (admin_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                admin_acc VARCHAR (100) NOT NULL,
                admin_pass VARCHAR (100) NOT NULL,
                admin_PIN VARCHAR (100) NOT NULL
                );";

        if (!mysqli_query($con, $sql)) {
            echo "Error creating table : " . mysqli_error($con);
        }
    }
        
    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        $admin_acc = $_POST['admin_acc'];
        $admin_pass = $_POST['admin_pass'];
        $admin_PIN = $_POST['admin_PIN'];
        // !is_numeric($user_name) mean not a number of username
        // !empty($user_name) mean not empty of username
        if(!empty($admin_acc) && !empty($admin_pass) && !is_numeric($admin_acc)&& strlen($admin_pass) > 10)
        {
            //save to database
            // insert a data by formula
            // users () is user table in created database in xampp
            //$query = "insert into users () values ()";
            // '$password' need ' ' because it is text		
            $dbname = 'webappdb';
            $tablename = 'admin_login';
            $servername = "localhost"; 
            $username = "root"; 
            $password = "";

            $admin_id = random_num(20);
            $con = mysqli_connect($servername, $username, $password, $dbname);  
            $query = "insert into $tablename (admin_id,admin_acc,admin_pass,admin_PIN) values ('$admin_id','$admin_acc','$admin_pass','$admin_PIN')";

            mysqli_query($con, $query);

            header("Location: admin_login.php");
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
            <h1>ADMIN SIGN UP PAGE</h1>
            <label for="admin_acc">ADMIN</label>
            <input type="text" name="admin_acc">
            <label for="admin_pass">PASSWORD</label>
            <input type="password" name="admin_pass">
            <label for="admin_PIN">PIN</label>
            <input maxlength="6" type="password" name="admin_PIN">
            <div class="box">
                <input class="submit" type="submit" value="SIGN UP">
                <a href="./admin_login.php"><div class="submit">LOGIN</div></a>
            </div>

            <a href="./password_generator.php" style="width:90%; display: block; text-align: right; font-size: 16px; ">need help?</a>
        </form>
</body>
</html>