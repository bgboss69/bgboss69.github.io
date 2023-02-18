<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>
    <link rel="stylesheet" href="./CSS/bootstrap.min.css">
    <link rel="stylesheet" href="./CSS/cart.css">
    <script src="https://kit.fontawesome.com/a627fa96ad.js" crossorigin="anonymous"></script>

</head>
<style>

</style>
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

    function getData($product_id){
        $dbname = 'webappdb';
        $tablename = 'product';
        $servername = "localhost"; 
        $username = "root"; 
        $password = "";
        $sql = "SELECT * FROM $tablename WHERE product_id = '$product_id'";
        $con = mysqli_connect($servername, $username, $password, $dbname);
        $result = mysqli_query($con, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }
    function searchData(){
        if (isset($_POST['submit-search'])) {
            $dbname = 'webappdb';
            $tablename = 'product';
            $servername = "localhost"; 
            $username = "root"; 
            $password = "";
            $con = mysqli_connect($servername, $username, $password, $dbname);
            $search = mysqli_real_escape_string($con, $_POST['search']);
            $sql = "SELECT * FROM $tablename WHERE product_name LIKE '%$search%' OR product_detail LIKE '%$search%'";
            $result = mysqli_query($con, $sql);
            $queryResults = mysqli_num_rows($result); 
            
            echo "<script> alert('There are $queryResults maching your search') </script>";
            if (mysqli_num_rows($result) > 0) {
                
                return $result;
            }
            else{
                echo "
                <script> alert('There is no results maching your search') </script>
            ";
            }
        }
    }
    
    function component($productname, $productprice, $productimg, $productid, $productdetail){
        $element = "
        
        <div class=\"item\">
            <form method=\"post\">
                <div class=\"top\">
                    <img src=\"$productimg\">
                </div>
                <div class=\"middle\">
                    <h4>$productname</h4>
                    <p>$productdetail</p>
                </div>
                <div class=\"bottom\">
                    <div class=\"left\">
                        <h5>RM$productprice</h5>
                    </div>
                    <div class=\"right\">
                        <input type='hidden' name='product_id' value='$productid'>
                        <input type='hidden' name='product_price' value='$productprice'>
                        <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button> 
                    </div>
                </div>  
            </form>
        </div>
    
        ";
        echo $element;
    }

    function cartElement($product_img, $product_name, $product_price, $subtotal, $quantity, $cart_id){
        $element = "

        <div class=\"product\">
        <form method=\"post\">
        <div class=\"item\">
            <div class=\"left\">
                <img src=\"$product_img\">
            </div>
            <div class=\"right\">
                <p><b>$product_name</b></p>
            </div>

        </div>
        <div class=\"price\">
           <b>RM$product_price</b> 
        </div>
        <div class=\"quantity\">
            <b>X&nbsp;$quantity</b> 
        </div>
        <div class=\"total\">
            <div class=\"left\"><b>RM$subtotal</b></div>
            <div class=\"wrong_box\">
                <input type='hidden' name='cart_id' value='$cart_id'>
                <button type=\"submit\" name=\"remove\"><i class=\"fa-regular fa-circle-xmark\"></i></button>
            </div>
        </div>
        </form>
    </div>
        
        ";
        echo  $element;
    }
    function check_login()
    {
        // $_SESSION['user_id'] 
        // if global variable ($_SESSION['user_id']) is isset which mean exist 
        if(isset($_SESSION['user_id'])) 
        {

            $user_id = $_SESSION['user_id'];

            //read from database
            //query means to select (* = all) from (users = database table which name users) where by (user_id = variable name in users table) = '$id' limit 1 )
            //sql code
            $con = mysqli_connect('localhost','root','','webappdb');
            $query= "SELECT * FROM user_login WHERE user_id = '$user_id' LIMIT 1" ;

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
        else{
        //redirect 转去 to login.php page 
        header("Location: user_login.php");
        die;//code will no continue like return
        }

    }

    function insert_cart($product_id,$product_price){
        $dbname = 'webappdb';
        $tablename = 'cart';
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
                (cart_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                 user_id INT(11) NOT NULL,
                 product_id INT(11) NOT NULL,
                 quantity INT(11),
                 subtotal FLOAT
                );";
    
            if (!mysqli_query($con, $sql)) {
                echo "Error creating table : " . mysqli_error($con);
            }
        }

            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM $tablename WHERE user_id = '$user_id' AND product_id = '$product_id'";
            $result = mysqli_query($con, $sql);
            if($result && mysqli_num_rows($result) > 0)
            {
                $row = mysqli_fetch_assoc($result);
                $cart_id = $row['cart_id'];
                $quantity = $row['quantity'] + 1;
                $subtotal = $row['subtotal'] + $row['subtotal'];         
                $con = mysqli_connect($servername, $username, $password, $dbname);        
                $sql = "UPDATE $tablename SET quantity = '$quantity', subtotal= '$subtotal' WHERE cart_id = '$cart_id'";
                mysqli_query($con, $sql);
                echo "
                    <script> alert('item added') </script>
                ";
            }
            else{
                
                $cart_id = random_num(20);
                $user_id = $_SESSION['user_id'];
                $con = mysqli_connect($servername, $username, $password, $dbname);  
                // $query = "INSERT INTO $tablename (product_id, product_name, product_price, product_image, product_detail) VALUES ('$product_id', '$product_name', '$product_price', '$product_image', '$product_detail')";
                $query = "INSERT INTO $tablename (cart_id, user_id, product_id, quantity, subtotal) VALUES ('$cart_id', '$user_id', '$product_id','1','$product_price')";
                mysqli_query($con, $query);
                echo "
                    <script> alert('new item added') </script>
                ";

            }
    }

    function remove_cart($cart_id){
        $dbname = 'webappdb';
        $tablename = 'cart';
        $servername = "localhost"; 
        $username = "root"; 
        $password = "";
        // Check connection
        if (!mysqli_connect($servername, $username, $password)){
            die("Connection failed : " . mysqli_connect_error());
        }
    
            $con = mysqli_connect($servername, $username, $password, $dbname);
            $sql = "DELETE FROM $tablename WHERE cart_id = '$cart_id';";
            mysqli_query($con, $sql);
            echo "
            <script> alert('item is deleted') </script>
            ";
 
    }

    function remove_all_cart(){
        $dbname = 'webappdb';
        $tablename = 'cart';
        $servername = "localhost"; 
        $username = "root"; 
        $password = "";
        // Check connection
        if (!mysqli_connect($servername, $username, $password)){
            die("Connection failed : " . mysqli_connect_error());
        }
            $user_id = $_SESSION['user_id'];
            $con = mysqli_connect($servername, $username, $password, $dbname);
            $sql = "DELETE FROM $tablename WHERE user_id = '$user_id';";
            mysqli_query($con, $sql);
 
    }
    function get_cart(){
        $dbname = 'webappdb';
        $tablename = 'cart';
        $servername = "localhost"; 
        $username = "root"; 
        $password = "";
        // Check connection
        if (!mysqli_connect($servername, $username, $password)){
            die("Connection failed : " . mysqli_connect_error());
        }
    
            $con = mysqli_connect($servername, $username, $password, $dbname);
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM $tablename WHERE user_id = '$user_id'";
            $result = mysqli_query($con, $sql);
            return $result;
 
    }


    function insert_shipping($shipping_id,$user_id,$cart_id,$product_id, $quantity, $subtotal,$shipping_method,$shipping_status){
        $dbname = 'webappdb';
        $tablename = 'shipping';
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
                (shipping_id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                 user_id INT(11) NOT NULL,
                 cart_id INT(11) NOT NULL,
                 product_id INT(11) NOT NULL,
                 quantity INT(11) NOT NULL,
                 subtotal FLOAT NOT NULL,
                 shipping_method VARCHAR (100) NOT NULL,
                 shipping_status INT(11) NOT NULL
                );";
    
            if (!mysqli_query($con, $sql)) {
                echo "Error creating table : " . mysqli_error($con);
            }
        }

            $con = mysqli_connect($servername, $username, $password, $dbname);
            $query = "INSERT INTO $tablename (shipping_id ,user_id, cart_id, product_id, quantity, subtotal, shipping_method , shipping_status) VALUES ('$shipping_id', '$user_id','$cart_id','$product_id', '$quantity', '$subtotal', '$shipping_method', '$shipping_status')";
            mysqli_query($con, $query);

    }
?>
<body>
    <?php

        $user_data = check_login();
        // insert_product('aaaa', '1234', './IMAGE/sandwich1.png', 'aaaa','food');
        // insert_product($product_id, $product_name, $product_price, $product_image, $product_detail);
    ?>
<div class="header">
    <div class="left">
      <a href="./cover_page.php"><img src="./IMAGE/logo.png" alt=""></a>
    </div>
    <div class="middle">
      <form class="d-flex" role="search" action="search.php" method = "POST">
        <input class="form-control me-2" type="text" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit" name="submit-search">Search</button>
      </form>
    </div>
    <div class="right">
        <a href="./user_logout.php" class="logo_user" onclick=""><i class="fa-solid fa-user"></i> &nbsp;<?php echo $user_data['user_acc']; ?> &nbsp;<i class="fa-solid fa-right-from-bracket"></i></a>
        <a href="./user_cart.php" class="cart"><i class="fa-solid fa-cart-shopping"></i>
        
        <?php
            $result = get_cart();
            
            $x =0;
            while ($row = mysqli_fetch_assoc($result)){
                $x = $x + $row['quantity'];
            }
  
            echo "<span>$x</span>";
        ?>


        </a>
      </div>

  </div>

    <ul class="nav_link">
        <li><a href="./home.php">Home</a></li>
        <li><a href="./category_food.php">Food</a></li>
        <li><a href="./category_drink.php">Drink</a></li>
        <li><a href="./category_dessert.php">Dessert</a></li>
        <li><a href="./shipping.php">Shipping</a></li>
    </ul>
  <!-- head -->  
<div class="main">
    
    <h1 class="top_title">XXXX Your Cart (
    <?php
            $result = get_cart();
            
            $x =0;
            while ($row = mysqli_fetch_assoc($result)){
                $x = $x + $row['quantity'];
            }
  
            echo "$x";
        ?>    
    
        items) XXXX</h1>
        <div class="title">
                <div class="item">Items</div>
                <div class="price">Price</div>
                <div class="quantity">Quantity</div>
                <div class="total">Total</div>
        </div>


        <?php
            $_SESSION['total'] = 0;
            $cart_data = get_cart();
            while ($row = mysqli_fetch_assoc($cart_data)) {
                $product_id = $row['product_id'];
                $product_data = getData($product_id);
                while ($row1 = mysqli_fetch_assoc($product_data)) {
                    cartElement($row1['product_image'], $row1['product_name'], $row1['product_price'], $row['subtotal'], $row['quantity'],  $row['cart_id']);
                    $_SESSION['total'] = $_SESSION['total'] + $row['subtotal'];
                }
            }
            
                // $result = searchData(); 
                // while ($row = mysqli_fetch_assoc($result)){
                //     component($row['product_name'], $row['product_price'], $row['product_image'], $row['product_id'], $row['product_detail']);
                // }
            if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
                if (isset($_POST['remove'])){
                    $cart_id = $_POST['cart_id'];
                    remove_cart($cart_id);
                    echo "<script>window.location.href = \"./home.php\";</script>";
                }
            }
        ?>

<form method="post">
            <div class="box">
                <div class="shipping">
                    <div class="left">
                        Shipping Method :
                    </div>
                    <div class="right">
                        <div class="left_raido">
                            <input type="radio" name="shipping" value="Delivery" checked>Delivery
                        </div>
                        <div class="right_radio">
                            <input type="radio" name="shipping" value="Pick up">Pick up
                        </div> 
                    </div>
                </div>
                <div class="alltotal">
                    <div class="top">   
                        <div class="left"></div>
                        <div class="right">
                            <div class="sub">Delivery Fee:</div>
                            <div class="sum">RM 0</div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="left"></div>
                        <div class="right">
                            <div class="sub">Total:</div>
                            <div class="sum">RM<?php
                            $total = $_SESSION['total'];
                            echo " $total "; ?></div>
                        </div>
                    </div>
                </div>
                <div class="check">
                    <div class="left"></div>
                    <div class="right">
                        <button type="submit" name="check_out">Check Out</button>
                    </div>
                </div>
            </div>
        </form>

        <?php

            
                // $result = searchData(); 
                // while ($row = mysqli_fetch_assoc($result)){
                //     component($row['product_name'], $row['product_price'], $row['product_image'], $row['product_id'], $row['product_detail']);
                // }
            if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
                if (isset($_POST['check_out'])){
                    $shipping_method = $_POST['shipping'];
                    $shipping_status = 0;
                    $cart_data = get_cart();
                    while ($row = mysqli_fetch_assoc($cart_data)) {
                        $shipping_id = random_num(11);
                        insert_shipping($shipping_id,$row['user_id'],$row['cart_id'],$row['product_id'],$row['quantity'],$row['subtotal'],$shipping_method,$shipping_status);
                    }
                echo "
                    <script> alert ('check out') </script>
                ";
                remove_all_cart();
                echo "<script>window.location.href = \"./user_information.php\";</script>";
                die;    
                }
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
</body>
</html>