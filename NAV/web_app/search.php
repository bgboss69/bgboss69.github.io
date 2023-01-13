<?php 
session_start(); // call $_SESION; ??
	// $_SESION; ???

	// import php file
	include("connection.php"); 
	include("functions.php");
  // require_once ('./php/CreateDb.php');
  // include ('component.php');
  require_once ('component.php');
  require_once ('CreateDb.php');
$user_data = check_login($con);


// create instance of Createdb class
$database = new CreateDb("Productdb", "Producttb");

if (isset($_POST['add'])){
    /// print_r($_POST['product_id']);
    //output: Array([0]=> Array{[product_id]}=>2) 
    if(isset($_SESSION['cart'])){

        $item_array_id = array_column($_SESSION['cart'], "product_id");
        if(in_array($_POST['product_id'], $item_array_id)){
            echo "<script>alert('Product is already added in the cart..!')</script>";
            echo "<script>window.location = 'index.php'</script>";
        }else{

            $count = count($_SESSION['cart']);
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
        }

    }else{

        $item_array = array(
                'product_id' => $_POST['product_id']
        );

        // Create new session variable
        $_SESSION['cart'][0] = $item_array;
        print_r($_SESSION['cart']);
    }
}


?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>homepage</title>
    <link rel="shortcut icon" href="#" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/item.css">
    <script src="https://kit.fontawesome.com/a627fa96ad.js" crossorigin="anonymous"></script>

  </head> 

  <style>
    .cart{
      position: relative;
    }
    .header .right .cart span {
      position: absolute;
      top: 0;
      right: -10px;
      display: block;
      width: 20px;
      height: 20px;
      background-color: red;
      color: white;
      font-size: 10px;
      text-align: center;
      line-height: 20px;
      border-radius: 50%;
    }
  </style>
  <body>
  <!-- head -->
  <div class="header">
    <div class="left">
      <a href="./cover page.html"><img src="./IMAGE/logo.png" alt=""></a>
    </div>
    <div class="middle">
      <form class="d-flex" role="search" action="search.php" method = "POST">
        <input class="form-control me-2" type="text" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit" name="submit-search">Search</button>
      </form>
    </div>
    <div class="right">
        <a href="./logout.php" style="border:3px solid white; border-radius:20px; padding:0 10px; margin: 5px 0 " ><i class="fa-solid fa-user"></i> &nbsp;<?php echo $user_data['user_name']; ?> &nbsp;<i class="fa-solid fa-right-from-bracket"></i></a>
        <a href="./cart.php" class="cart"><i class="fa-solid fa-cart-shopping"></i>
        
        <?php

          if (isset($_SESSION['cart'])){
              $count = count($_SESSION['cart']);
              echo "<span>$count</span>";
          }else{
              
          }

        ?>





        </a>
      </div>

  </div>
  <!-- head -->  

  <div class="main">
      <h1>Result</h1>
      <div class="product">
      <?php
            // <form class="d-flex" role="search" action="seacrh.php" method = "POST ">
            //   <input class="form-control me-2" type="text" name="search" placeholder="Search" aria-label="Search">
            //   <button class="btn btn-outline-success" type="submit" name="submit-search">Search</button>
            // </form>

            // in seacrh.php
            $result = $database->searchData();
            while ($row = mysqli_fetch_assoc($result)){
              component($row['product_name'], $row['product_price'], $row['product_image'], $row['id'], $row['product_detail']);
            }

        ?>      

  </div>
  <span></span>

      <!---footer------------------------------>
    <div class="footer-container">
      <div class="footer-social">
          <a href=" "><i class="fab fa-facebook-f"></i></a>
          <a href=" "><i class="fab fa-instagram"></i></a>
          <a href=" "><i class="fab fa-twitter"></i></a>
      </div>

      <div class="footer-middle">
          <h4>Copyright © 2022. All rights reserved.</h4>
      </div>

      <div class="footer-contact-us">
          <a href=""><i class="fa-solid fa-phone-rotary"></i>Contact us</a>
      </div>
      
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  </body>
</html>
<!-- 
	then can insert the $user_data which mean include all data of that user 
	so can get name of user or something information of user insert to html code 
-->


