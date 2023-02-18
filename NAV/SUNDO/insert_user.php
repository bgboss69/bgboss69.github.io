<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="[time in seconds]"> -->
    <title>admin_control_page</title>
    <link rel="stylesheet" href="./CSS/bootstrap.min.css">
    <link rel="stylesheet" href="./CSS/insert_product.css">
    <script src="https://kit.fontawesome.com/a627fa96ad.js" crossorigin="anonymous"></script>

</head>
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
    function check_login()
    {
        // $_SESSION['user_id'] 
        // if global variable ($_SESSION['user_id']) is isset which mean exist 
        if(isset($_SESSION['admin_id'])) 
        {

            $admin_id = $_SESSION['admin_id'];

            //read from database
            //query means to select (* = all) from (users = database table which name users) where by (user_id = variable name in users table) = '$id' limit 1 )
            //sql code
            $con = mysqli_connect('localhost','root','','webappdb');
            $query= "SELECT * FROM admin_login WHERE admin_id = '$admin_id' LIMIT 1" ;

            //  mysqli_query($con,$query)
            //  get row information depend on id from database table asset to $result
            $result = mysqli_query($con,$query);
            // if got result and the result is more than 0
            if($result && mysqli_num_rows($result) > 0)
            {
                //fetch mean take 
                //assoc = associative array 关联数组 
                $admin_data = mysqli_fetch_assoc($result);
                return $admin_data;
            }
        }
        else{
        //redirect 转去 to login.php page 
        header("Location: admin_login.php");
        die;//code will no continue like return
        }

    }

?>
<body>
    <?php

        $admin_data = check_login();
        // insert_product('aaaa', '1234', './IMAGE/sandwich1.png', 'aaaa','food');
        // insert_product($product_id, $product_name, $product_price, $product_image, $product_detail);
    ?>
<div class="header">
    <div class="left">
      <a href="./cover_page.php"><img src="./IMAGE/logo.png" alt=""></a>
    </div>
    <div class="middle">
    </div>
    <div class="right">
        <a href="./admin_logout.php" class="logo_user" ><i class="fa-solid fa-user"></i> &nbsp;<?php echo $admin_data['admin_acc']; ?> &nbsp;<i class="fa-solid fa-right-from-bracket"></i></a>
    </div>

  </div>    

  <!-- head -->  
<?php
    function insert_user($user_id,$user_acc,$user_pass,$user_PIN){
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


        $sql = "SELECT * FROM $tablename WHERE user_id = '$user_id'";
        $result = mysqli_query($con, $sql);
        if($result && mysqli_num_rows($result) > 0)
        {  
            $con = mysqli_connect($servername, $username, $password, $dbname);        
            $sql = "UPDATE $tablename SET  user_acc = '$user_acc' , user_pass = '$user_pass' , user_PIN = '$user_PIN' WHERE user_id = '$user_id'";
            mysqli_query($con, $sql);
            echo "
                <script> alert('item updated') </script>
            ";
        } else {
                // $product_id = random_num(20);
                $con = mysqli_connect($servername, $username, $password, $dbname);
                $query = "INSERT INTO $tablename (user_id,user_acc,user_pass,user_PIN) VALUES('$user_id','$user_acc','$user_pass','$user_PIN')";
                mysqli_query($con, $query);
                echo "
                        <script> alert ('user inserted') </script>
                    ";
                // header("Location: user_login.php");
            }
    }
            
    ?>


<?php                 
// post action from admin_control_page 
if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    if (isset($_POST['insert_user'])) {
        $user_id = random_num(11);
        echo "
        <div class=\"main\">  
            <div class=\"box\">
                <h1 class=\"top_title\">INSERT USER</h1> 
                <form method=\"post\">
                    <h5 class=\"top_title\">ID</h5> 
                    <input type=\"text\" required value=\"$user_id \" name=\"user_id\" readonly>
                    <h5 class=\"top_title\">User Account</h5> 
                    <input type=\"text\" required placeholder=\"User Account\" name=\"user_acc\">
                    <h5 class=\"top_title\">User Password</h5> 
                    <input type=\"text\" required placeholder=\"User Password\" name=\"user_pass\">
                    <h5 class=\"top_title\">User PIN No</h5> 
                    <input type=\"text\" maxlength=\"6\" required placeholder=\"User PIN No\" name=\"user_PIN\">
                    <button class=\"btn\" type=\"submit\" name=\"add\">Continue</button>
                </form>
            </div>
        </div>  
    
        ";
    }
}

if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    if (isset($_POST['edit_user'])) {
        $dbname = 'webappdb';
        $tablename = 'user_login';
        $servername = "localhost"; 
        $username = "root"; 
        $password = "";

        $user_id = $_POST['user_id'];
        $con = mysqli_connect($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM $tablename WHERE user_id = '$user_id'";
        $result = mysqli_query($con, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $user_id = $row['user_id'];
            $user_acc = $row['user_acc'];
            $user_pass = $row['user_pass'];
            $user_PIN = $row['user_PIN'];
            echo "
            <div class=\"main\">  
            <div class=\"box\">
                <h1 class=\"top_title\">INSERT USER</h1> 
                <form method=\"post\">
                    <h5 class=\"top_title\">ID</h5> 
                    <input type=\"text\" required value=\"$user_id\" name=\"user_id\">
                    <h5 class=\"top_title\">User Account</h5> 
                    <input type=\"text\" required value=\"$user_acc\" name=\"user_acc\">
                    <h5 class=\"top_title\">User Password</h5> 
                    <input type=\"text\" required value=\"$user_pass\" name=\"user_pass\">
                    <h5 class=\"top_title\">User PIN No</h5> 
                    <input type=\"text\" maxlength=\"6\" required value=\"$user_PIN\" name=\"user_PIN\">
                    <button class=\"btn\" type=\"submit\" name=\"add\">Continue</button>
                </form>
            </div>
        </div>  
        ";
        }
    }
}

if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    if (isset($_POST['remove_user'])) {
        function remove_user($user_id){
            $dbname = 'webappdb';
            $tablename = 'user_login';
            $servername = "localhost"; 
            $username = "root"; 
            $password = "";
            // Check connection
            if (!mysqli_connect($servername, $username, $password)){
                die("Connection failed : " . mysqli_connect_error());
            }
        
                $con = mysqli_connect($servername, $username, $password, $dbname);
                $sql = "DELETE FROM $tablename WHERE user_id = '$user_id';";
                mysqli_query($con, $sql);
                echo "
                <script> alert('user is deleted') </script>
                ";
        }

        $user_id = $_POST['user_id'];
        remove_user($user_id);
        echo "<script>window.location.href = \"./admin_control_page.php\";</script>";
    }
}
?>

<?php

if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    if (isset($_POST['add'])) {
        $user_id = $_POST['user_id'];
        $user_acc = $_POST['user_acc'];
        $user_pass = $_POST['user_pass'];
        $user_PIN = $_POST['user_PIN'];

        if (!empty($user_acc) && !empty($user_pass) && !is_numeric($user_acc) && strlen($user_pass) > 10 && strlen($user_PIN) == 6) {
            insert_user($user_id, $user_acc, $user_pass, $user_PIN);
            echo "<script>window.location.href = \"./admin_control_page.php\";</script>";

        } else {
            echo "<script> alert('Please enter some valid information! or need to key in stronger password') </script>";
            echo "<script>window.location.href = \"./admin_control_page.php\";</script>";
        }
    }
}
?>

<div class="footer-container">
      <div class="footer-social">
          <a href=" "><i class="fab fa-facebook-f"></i></a>
          <a href=" "><i class="fab fa-instagram"></i></a>
          <a href=" "><i class="fab fa-twitter"></i></a>
      </div>

      <div class="footer-middle">
            <h4>Copyright © 2023 BIW10203: APLIKASI WEB Group 9. All rights reserved.</h4>
      </div>

      <div class="footer-contact-us">
          <a href=""><i class="fa-solid fa-phone-rotary"></i>Contact us</a>
      </div>
      
    </div>
</body>
</html>
