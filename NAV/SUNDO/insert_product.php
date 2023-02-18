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
    function insert_product($product_id ,$product_name, $product_price, $product_image, $product_detail, $product_category){
        $dbname = 'webappdb';
        $tablename = 'product';
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
                (product_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    product_name VARCHAR (25) NOT NULL,
                    product_price FLOAT NOT NULL,
                    product_image VARCHAR (100) NOT NULL,   
                    product_detail TEXT NOT NULL,
                    product_category VARCHAR (25) NOT NULL 
                );";
    
            if (!mysqli_query($con, $sql)) {
                echo "Error creating table : " . mysqli_error($con);
            }
        }

        $sql = "SELECT * FROM $tablename WHERE product_id = '$product_id'";
        $result = mysqli_query($con, $sql);
        if($result && mysqli_num_rows($result) > 0)
        {  
            $con = mysqli_connect($servername, $username, $password, $dbname);        
            $sql = "UPDATE $tablename SET  product_name = '$product_name' , product_price = '$product_price' , product_image = '$product_image', product_detail = '$product_detail', product_category = '$product_category ' WHERE product_id = '$product_id'";
            mysqli_query($con, $sql);
            echo "
                <script> alert('item updated') </script>
            ";
        } else {
                // $product_id = random_num(20);
                $con = mysqli_connect($servername, $username, $password, $dbname);
                $query = "INSERT INTO $tablename (product_id, product_name, product_price, product_image, product_detail, product_category) VALUES ('$product_id', '$product_name', '$product_price', '$product_image', '$product_detail','$product_category')";
                mysqli_query($con, $query);
                echo "
                        <script> alert ('item inserted') </script>
                    ";
                // header("Location: user_login.php");
            }
    }
            
    ?>
<!-- <div class="main">  
    <div class="box">
        <h1 class="top_title">INSERT PRODUCT</h1> 
        <form method="post">
            <h5 class="top_title">ID</h5> 
            <input type="text" required placeholder="ID" name="product_id">
            <h5 class="top_title">NAME</h5> 
            <input type="text" required placeholder="NAME" name="product_name">
            <h5 class="top_title">Price</h5> 
            <input type="text" required placeholder="Price" name="product_price">
            <h5 class="top_title">Image Address</h5> 
            <input type="text" required placeholder="Image Address" name="product_image">
            <h5 class="top_title">Product Detail</h5> 
            <input type="text" required placeholder="Product Detail" name="product_detail">
            <h5 class="top_title">Category</h5> 
            <input type="text" required placeholder="Category" name="product_category" value="food">
            <button class="btn" type="submit" name="add">Continue</button>
        </form>
    </div>
</div>   -->

<?php
// post action from admin_control_page 
if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    if (isset($_POST['insert_product'])) {
        $dbname = 'webappdb';
        $tablename = 'product';
        $servername = "localhost"; 
        $username = "root"; 
        $password = "";
        // Check connection
        if (!mysqli_connect($servername, $username, $password)){
            die("Connection failed : " . mysqli_connect_error());
        }
        $con = mysqli_connect($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM $tablename";
        $result = mysqli_query($con, $sql);
        $product_id = mysqli_num_rows($result)+1;
        echo "
        <div class=\"main\">  
            <div class=\"box\">
                <h1 class=\"top_title\">INSERT PRODUCT</h1> 
                <form method=\"post\">
                    <h5 class=\"top_title\">ID</h5> 
                    <input type=\"text\" required value=\"$product_id\" name=\"product_id\" readonly>
                    <h5 class=\"top_title\">NAME</h5> 
                    <input type=\"text\" required placeholder=\"NAME\" name=\"product_name\">
                    <h5 class=\"top_title\">Price</h5> 
                    <input type=\"text\" required placeholder=\"Price\" name=\"product_price\">
                    <h5 class=\"top_title\">Image Address</h5> 
                    <input type=\"text\" required placeholder=\"Image Address\" name=\"product_image\">
                    <h5 class=\"top_title\">Product Detail</h5> 
                    <input type=\"text\" required placeholder=\"Product Detail\" name=\"product_detail\">
                    <h5 class=\"top_title\">Category</h5> 
                    <input type=\"text\" required placeholder=\"Category\" name=\"product_category\">
                    <button class=\"btn\" type=\"submit\" name=\"add\">Continue</button>
                </form>
            </div>
        </div>  
    
        ";
    }
}

if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    if (isset($_POST['edit_product'])) {
        $dbname = 'webappdb';
        $tablename = 'product';
        $servername = "localhost";
        $username = "root";
        $password = "";

        $product_id = $_POST['product_id'];
        $con = mysqli_connect($servername, $username, $password, $dbname);
        $sql = "SELECT * FROM $tablename WHERE product_id = '$product_id'";
        $result = mysqli_query($con, $sql);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $product_name = $row['product_name'];
            $product_price = $row['product_price'];
            $product_image = $row['product_image'];
            $product_detail = $row['product_detail'];
            $product_category = $row['product_category'];
            echo "
        <div class=\"main\">  
            <div class=\"box\">
                <h1 class=\"top_title\">EDIT PRODUCT</h1> 
                <form method=\"post\">
                    <h5 class=\"top_title\">ID</h5> 
                    <input type=\"text\" required value=\"$product_id \" name=\"product_id\">
                    <h5 class=\"top_title\">NAME</h5> 
                    <input type=\"text\" required value=\"$product_name\" name=\"product_name\">
                    <h5 class=\"top_title\">Price</h5> 
                    <input type=\"text\" required value=\"$product_price\" name=\"product_price\">
                    <h5 class=\"top_title\">Image Address</h5> 
                    <input type=\"text\" required value=\"$product_image\" name=\"product_image\">
                    <h5 class=\"top_title\">Product Detail</h5> 
                    <input type=\"text\" required value=\"$product_detail\" name=\"product_detail\">
                    <h5 class=\"top_title\">Category</h5> 
                    <input type=\"text\" required value=\" $product_category\" name=\"product_category\">
                    <button class=\"btn\" type=\"submit\" name=\"add\">Continue</button>
                </form>
            </div>
        </div>  
        ";
        }
    }
}

if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    if (isset($_POST['remove_product'])) {
        function remove_product($product_id){
            $dbname = 'webappdb';
            $tablename = 'product';
            $servername = "localhost"; 
            $username = "root"; 
            $password = "";
            // Check connection
            if (!mysqli_connect($servername, $username, $password)){
                die("Connection failed : " . mysqli_connect_error());
            }
        
                $con = mysqli_connect($servername, $username, $password, $dbname);
                $sql = "DELETE FROM $tablename WHERE product_id = '$product_id';";
                mysqli_query($con, $sql);
                echo "
                <script> alert('item is deleted') </script>
                ";
        }

        $product_id = $_POST['product_id'];
        remove_product($product_id);
        echo "<script>window.location.href = \"./admin_control_page.php\";</script>";
    }
}
?>

<?php

if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
    if (isset($_POST['add'])){
        $product_id = $_POST['product_id'];
        $product_name= $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image= $_POST['product_image'];
        $product_detail = $_POST['product_detail'];
        $product_category = $_POST['product_category'];
        insert_product($product_id, $product_name, $product_price, $product_image, $product_detail, $product_category);
        echo "<script>window.location.href = \"./admin_control_page.php\";</script>";
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
    <!-- insert_product('1','Chicken Slice','12.50','./IMAGE/sandwich1.png','With succulent slices of Chicken ham, you cannot beat this favorite. Especially as its got under 6 grams of fat.','food');
    insert_product('2','Chicken Teriyaki','13.50','./IMAGE/sandwich2.png','An Asian classic, is made with tender chicken pieces dressed lightly with teriyaki sauce, served hot and topped with your choice of fresh vegetables and condiments on freshly baked bread.','food');
    insert_product('3','Italian B.M.T.','12.50','./IMAGE/sandwich3.png','An old world favourite sandwich that is made up of beef salami, beef pepperoni and chicken ham. Some say B.M.T.™ stands for biggest, meatiest, tastiest.','food');
    insert_product('4','Mala Chicken','12.50','./IMAGE/sandwich4.png','It is usually made with marinated chicken breast, vegetables, and a mala sauce. The sandwich can be customized to include other ingredients, such as cheese or avocado, and can be served on a variety of breads.','food');
    insert_product('5','Meatball Marinara Melt','16.50','./IMAGE/sandwich5.png','The Italian meatball sandwich at Subway comes with meatballs in tangy tomato marinara sauce, fresh vegetables, and condiments on freshly baked bread.','food');
    insert_product('6','Roast Beef','15.50','./IMAGE/sandwich6.png','A classic favorite, comprises of lean and tender sliced roast beef with your choice of fresh vegetables and condiments served on freshly baked bread.','food');
    insert_product('7','Roasted Chicken Breast','13.50','./IMAGE/sandwich7.png','Oven Roasted Chicken Breast sandwich at Subway includes a tender chicken breast patty, fresh vegetables, condiments on freshly baked bread.','food');
    insert_product('8','Veggie Delite™','11.50','./IMAGE/sandwich8.png','The Veggie Delite sandwich at Subway includes fresh lettuce, tomatoes, green peppers, onions, olives and pickles, with your choice of condiments on freshly baked bread.','food');
    insert_product('9','Coca-Cola','5.50','./IMAGE/drink1.png','Coca-Cola is a carbonated soft drink made from a recipe of sugar, water, caffeine, and a proprietary blend of natural flavors.','drink');
    insert_product('10','Sprite','5.50','./IMAGE/drink2.png','Sprite is a clear, lemon-lime flavored, caffeine-free soft drink created by The Coca-Cola Company. ','drink');
    insert_product('11','Heaven and Earth Passion Fruit','5.50','./IMAGE/drink3.png','Heaven and Earth Fruity Teas fuse tea with fruit flavors and other natural ingredients to deliver a fresh, contemporary expression of tea. ','drink');
    insert_product('12','Double Chocolate Chip Cookie','7.50','./IMAGE/dessert1.png','Double chocolate chip cookie is a type of cookie that contains chocolate chips and cocoa powder, giving it a double dose of chocolate flavor. ','dessert');
    insert_product('13','White Chip Macadamia Nut Cookie','6.50','./IMAGE/dessert2.png','White Chip Macadamia Nut Cookie is a type of cookie that contains white chocolate chips and macadamia nuts, providing a sweet and nutty flavor. ','dessert');
    insert_product('14','Heaven and Earth Passion Fruit','5.50','./IMAGE/dessert3.png','Oatmeal & Raisin Cookie is a type of cookie that contains oats, raisins, and spices.','dessert'); -->
