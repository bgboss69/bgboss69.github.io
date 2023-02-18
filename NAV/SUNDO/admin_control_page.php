<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <meta http-equiv="refresh" content="[time in seconds]"> -->
    <title>admin_control_page</title>
    <link rel="stylesheet" href="./CSS/bootstrap.min.css">
    <link rel="stylesheet" href="./CSS/admin_control_page.css">
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
<div class="main">
    <?php
        function getproduct(){
            $dbname = 'webappdb';
            $tablename = 'product';
            $servername = "localhost"; 
            $username = "root"; 
            $password = "";
            $sql = "SELECT * FROM $tablename";
            $con = mysqli_connect($servername, $username, $password, $dbname);
            $result = mysqli_query($con, $sql);
    
            if(mysqli_num_rows($result) > 0){
                return $result;
            }
        }
        function printproduct($product_id,$product_name,$product_price,$product_image,$product_detail,$product_category){
            $element = "
            
            <div class=\"product_box\">
                <div class=\"product_id\">$product_id </div>
                <div class=\"product_name\">$product_name</div>
                <div class=\"product_price\">$product_price</div>
                <div class=\"product_image\">$product_image</div>
                <div class=\"product_detail\">$product_detail</div>
                <div class=\"product_category\">$product_category</div>
                <div class=\"form\">
                    <form method=\"post\" action=\"insert_product.php\" >
                        <input type=\"hidden\" name=\"product_id\" value=\"$product_id\">
                        <button type=\"submit\" name=\"edit_product\">Edit</button>
                        <button type=\"submit\" name=\"remove_product\">Remove</button>
                    </form>
                </div>
            </div>
    
        
            ";
            echo $element;
        }
        
    ?>
    <h1 class="top_title"> <---- Product ----></h1>
    <div class="product_box" style = "text-decoration: underline;">
        <div class="product_id">ID</div>
        <div class="product_name">Name</div>
        <div class="product_price">Price</div>
        <div class="product_image">Address</div>
        <div class="product_detail">Product Detail</div>
        <div class="product_category">Category</div>
        <div class="form">
            <form method="post" action="insert_product.php">
                <button name="insert_product">Insert</button>
            </form>
        </div>
    </div>

    <?php
        $result = getproduct();
        while ($row = mysqli_fetch_assoc($result)){
            printproduct($row['product_id'] ,$row['product_name'] ,$row['product_price'] ,$row['product_image'] ,$row['product_detail'] ,$row['product_category']);
        }
    ?>

<!-- Order Detail ---->
<?php
    function get_shipping(){
        $dbname = 'webappdb';
        $tablename = 'shipping';
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
            return $result;
 
    }
    
    function printOrder($shipping_id,$user_id,$shipping_method,$shipping_status){
        $element = "

        <div class=\"order_box\">
            <div class=\"user_id\">$user_id</div>
            <div class=\"order_id\">$shipping_id</div>
            <div class=\"method\">$shipping_method</div>
            <div class=\"status\">$shipping_status  </div>
            <div class=\"form\">
                <form method=\"post\" action=\"insert_shipping.php\">
                    <input type=\"hidden\" name=\"shipping_id\" value=\"$shipping_id\">
                    <button type=\"submit\" name=\"edit_order\">Edit</button>
                    <button type=\"submit\" name=\"remove_order\">Remove</button>
                </form>
            </div>
        </div>

    
        ";
        echo $element;
    }
    // function insert_shipping($shipping_id,$user_id,$cart_id,$product_id, $quantity, $subtotal,$shipping_method,$shipping_status){
    //     $dbname = 'webappdb';
    //     $tablename = 'shipping';
    //     $servername = "localhost"; 
    //     $username = "root"; 
    //     $password = "";
    //     // Check connection
    //     if (!mysqli_connect($servername, $username, $password)){
    //         die("Connection failed : " . mysqli_connect_error());
    //     }
    
    //     // query
    //     $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
    //     $con = mysqli_connect($servername, $username, $password);
    //     // execute query
    //     if(mysqli_query($con , $sql)){
    //     $con = mysqli_connect($servername, $username, $password, $dbname);
    
    //     // sql to create new table
    
    //     $sql = " CREATE TABLE IF NOT EXISTS $tablename
    //             (shipping_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    //              user_id INT(11) NOT NULL,
    //              cart_id INT(11) NOT NULL,
    //              product_id INT(11) NOT NULL,
    //              quantity INT(11) NOT NULL,
    //              subtotal FLOAT NOT NULL,
    //              shipping_method VARCHAR (100) NOT NULL,
    //              shipping_status INT(11) NOT NULL
    //             );";
    
    //         if (!mysqli_query($con, $sql)) {
    //             echo "Error creating table : " . mysqli_error($con);
    //         }
    //     }

    //         $con = mysqli_connect($servername, $username, $password, $dbname);
    //         $query = "INSERT INTO $tablename (shipping_id ,user_id, cart_id, product_id, quantity, subtotal, shipping_method , shipping_status) VALUES ('$shipping_id', '$user_id','$cart_id','$product_id', '$quantity', '$subtotal', '$shipping_method', '$shipping_status')";
    //         mysqli_query($con, $query);

    // }

        
    ?>
    <h1 class="top_title"> <---- Order Detail ----></h1>
    <div class="order_box" style = "text-decoration: underline;">
        <div class="user_id">User ID</div>
        <div class="order_id">Order ID</div>
        <div class="method">Method</div>
        <div class="status">Status</div>
        <div class="form">
            <form method="post" action="insert_shipping.php">
                <!-- <button name="insert_order">Insert</button> -->
                Function
            </form>
        </div>
    </div>

    <?php
        $result = get_shipping();
        while ($row = mysqli_fetch_assoc($result)){
            if($row['shipping_status'] == 0){
                $shipping_status = 'New Order';   
            }
            if($row['shipping_status'] == 1){
                $shipping_status = 'Preparing the food';   
            }
            if($row['shipping_status'] == 2){
                $shipping_status = 'Food is shipping or pickup at restaurants';   
            }
            if($row['shipping_status'] == 3){
                $shipping_status = 'Order is completed';   
            }
            printOrder($row['shipping_id'] ,$row['user_id'] ,$row['shipping_method'] ,$shipping_status );
        }
    ?>

<!-- rating ---->
<?php
    function getrate(){
        $dbname = 'webappdb';
        $tablename = 'feedback';
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
            return $result;
 
    }
    function printFeedback ($feedback_id,$user_id,$product_id,$rating,$review){
        $element = "
        <div class=\"rate_box\">
            <div class=\"user_id\">$user_id</div>
            <div class=\"product_id\">$product_id</div>
            <div class=\"rating\">$rating</div>
            <div class=\"comment\">$review</div>
            <div class=\"form\">
                <form method=\"post\" action=\"insert_rate.php\">
                    <input type=\"hidden\" name=\"feedback_id\" value=\"$feedback_id\">
                    <button type=\"submit\" name=\"remove_rate\">Remove</button>
                </form>
            </div>
        </div>
    
        ";
        echo $element;
    }

        
    ?>
    <h1 class="top_title"> <---- Rating and Review ----></h1>
    <div class="rate_box" style = "text-decoration: underline;">
        <div class="user_id">User ID</div>
        <div class="product_id">Product ID</div>
        <div class="rating">Rating</div>
        <div class="comment">Comment</div>
        <div class="form">
            <form method="post" action="insert_rate.php">
                <!-- <button name="insert_rate">Insert</button> -->
                Function
            </form>
        </div>
    </div>

    <?php
        $result = getrate();
        while ($row = mysqli_fetch_assoc($result)){
            printFeedback($row['feedback_id'] , $row['user_id'] , $row['product_id'] , $row['rating'] , $row['review'] );
        }
    ?>
    

    <?php
        function getuser(){
            $dbname = 'webappdb';
            $tablename = 'user_login';
            $servername = "localhost"; 
            $username = "root"; 
            $password = "";

            // Check connection
            if (!mysqli_connect($servername, $username, $password)){
                die("Connection failed : " . mysqli_connect_error());
            }  
            $sql = "SELECT * FROM $tablename";
            $con = mysqli_connect($servername, $username, $password, $dbname);
            $result = mysqli_query($con, $sql);
            return $result;
        }
        //no complete zz

        function printuser($user_id,$user_name,$user_password,$user_PIN){
            $element = "
            
            <div class=\"user_box\">
            <div class=\"user_id\">$user_id</div>
            <div class=\"user_name\">$user_name</div>
            <div class=\"user_password\">$user_password</div>
            <div class=\"user_PIN\">$user_PIN</div>
            <div class=\"form\">
                <form method=\"post\" action=\"insert_user.php\">
                    <input type=\"hidden\" name=\"user_id\" value=\"$user_id\">
                    <button type=\"submit\" name=\"edit_user\">Edit</button>
                    <button type=\"submit\" name=\"remove_user\">Remove</button>
                </form>
            </div>
        </div>
    
        
            ";
            echo $element;
        }
        
    ?>
    <h1 class="top_title"> <---- User Detail ----></h1>
    <div class="user_box" style = "text-decoration: underline;" >
        <div class="user_id">User ID</div>
        <div class="user_name">User Name</div>
        <div class="user_password">Password</div>
        <div class="user_PIN">PIN</div>
        <div class="form">
            <form method="post" action="insert_user.php">
                <button name="insert_user">Insert</button>
            </form>
        </div>
    </div>
    
    <?php
        $result = getuser();
        while ($row = mysqli_fetch_assoc($result)){
            printuser($row['user_id'] ,$row['user_acc'] ,$row['user_pass'] ,$row['user_PIN'] );
        }
    ?>
</div>
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

</body>
</html>
