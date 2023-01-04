<?php 
session_start(); // call $_SESION; ??
	// $_SESION; ???

	// import php file
	include("connection.php"); 
	include("functions.php");
  include("component.php");

	$user_data = check_login($con);

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
  <body>
  <!-- head -->
  <div class="header">
    <div class="left">
      <a href="./cover page.html"><img src="./IMAGE/logo.png" alt=""></a>
    </div>
    <div class="middle">
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
    <div class="right">
        <a href="./logout.php" style="border:3px solid white; border-radius:20px; padding:0 10px; margin: 5px 0 " ><i class="fa-solid fa-user"></i> &nbsp;<?php echo $user_data['user_name']; ?> &nbsp;<i class="fa-solid fa-right-from-bracket"></i></a>
        <a href="#"><i class="fa-solid fa-cart-shopping"></i></a>
      </div>

  </div>
  <!-- head -->  

  <div class="main">
      <h1>Category</h1>
      <div class="category">
        <div class="category_item" id="x">
          <p>Sandwich</p>
          <img src="./IMAGE/catagory1.png" alt="">
        </div>
        <div class="category_item" id="y">
          <p>Drink</p>
          <img src="./IMAGE/catagory2.jpg" alt="">
        </div>
        <div class="category_item" id="z">
          <p>Dessert</p>
          <img src="./IMAGE/catagory3.png" alt="">
        </div>
      </div>
      <h1>Sandwich</h1>
      <div class="product">
      <?php
                // $result = $database->getData();
                // while ($row = mysqli_fetch_assoc($result)){
                //   component($row['product_name'], $row['product_price'], $row['product_image'], $row['id']);
                //}

                component("Teriyaki Chicken", 100, "./IMAGE/sandwich1.png", 1, "An Asian classic gourmet made with a flavorful blend of tender chicken pieces dressed lightly with teriyaki sauce.");
                component("Teriyaki Chicken", 100, "./IMAGE/sandwich1.png", 1, "An Asian classic gourmet made with a flavorful blend of tender chicken pieces dressed lightly with teriyaki sauce.");
                component("Teriyaki Chicken", 100, "./IMAGE/sandwich1.png", 1, "An Asian classic gourmet made with a flavorful blend of tender chicken pieces dressed lightly with teriyaki sauce.");
                component("sandwich", 100, "./IMAGE/sandwich1.png", 1, "blablabla");
                component("sandwich", 100, "./IMAGE/sandwich1.png", 1, "blablabla");
                component("sandwich", 100, "./IMAGE/sandwich1.png", 1, "blablabla");
                component("sandwich", 100, "./IMAGE/sandwich1.png", 1, "blablabla");

                component("sandwich", 100, "./IMAGE/sandwich1.png", 1, "blablabla");

                component("sandwich", 100, "./IMAGE/sandwich1.png", 1, "blablabla");




      ?>        
      </div>
                  
      <h1>Drink</h1>
      <div class="product">
      <?php
                component("sandwich", 100, "./IMAGE/sandwich1.png", 1, "blablabla");
                component("sandwich", 100, "./IMAGE/sandwich1.png", 1, "blablabla");
                component("sandwich", 100, "./IMAGE/sandwich1.png", 1, "blablabla");
      ?>        
      </div>


      <h1 >Dessert</h1>
      <div class="product">
      <?php
                component("sandwich", 100, "./IMAGE/sandwich1.png", 1, "blablabla");
                component("sandwich", 100, "./IMAGE/sandwich1.png", 1, "blablabla");
                component("sandwich", 100, "./IMAGE/sandwich1.png", 1, "blablabla");
      ?>        
      </div>
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

    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> -->
    <script>
    var x = document.getElementById("x");
    var y = document.getElementById("y");
    var z = document.getElementById("z");
    x.onclick=function () {
        window.scrollTo(0,500); 
        }
    y.onclick=function () {
    window.scrollTo(0,950); 
      }
    z.onclick=function () {
        window.scrollTo(0,1400); 
      }
    // $(window).scroll(function() {
    //         var scrollPos = $(this).scrollTop();
    //         console.log(scrollPos)
    //   });
    </script>
  </body>
</html>
<!-- 
	then can insert the $user_data which mean include all data of that user 
	so can get name of user or something information of user insert to html code 
-->