<?php

session_start();

require_once ("CreateDb.php");
require_once ("component.php");

$db = new CreateDb("Productdb", "Producttb");

if (isset($_POST['remove'])){
  if ($_GET['action'] == 'remove'){
      foreach ($_SESSION['cart'] as $key => $value){
          if($value["product_id"] == $_GET['id']){
              unset($_SESSION['cart'][$key]);
              echo "<script>alert('Product has been Removed...!')</script>";
              echo "<script>window.location = 'cart.php'</script>";
          }
      }
  }
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>my cart</title>
    <link rel="shortcut icon" href="#" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/checkout.css">
    <script src="https://kit.fontawesome.com/a627fa96ad.js" crossorigin="anonymous"></script>

    <style>
        .box .ct {
          display: flex;
          justify-content: center;
          align-items: center;
          width: 100%;
          overflow: hidden;
          margin-bottom: 20px;
        }
       .box .lt {
          margin: 0;
          padding: 0;
          width: 100px;
          height: 100px;
          overflow: hidden;
          display: flex;
          justify-content: center;
          align-items: center;
        }
        .box .lt img {
          width: 100%;
        }
        .box .rt {
          margin: 0;
          padding: 10px;
          width: 60%;
          height: 100px;
          display: flex;
          justify-content: center;
          align-items: center;
        }
        .box .rt p {
          width: 100%;
          text-align: left;
          color: white;
        }

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
  </head> 
  
  <body>
  <!-- head -->
  <div class="header">
    <div class="left">
      <a href="./index.php"><img src="./IMAGE/logo.png" alt=""></a>
    </div>
    <div class="middle">
      <form class="d-flex" role="search" action="search.php" method ="POST">
        <input class="form-control me-2" type="text" name="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit" name="submit-search">Search</button>
      </form>
    </div>
    <div class="right">
        
        <a href="./login.php"><i class="fa-solid fa-user"></i></a>
        <a href="./cart.php" class="cart"><i class="fa-solid fa-cart-shopping">
        <?php

          if (isset($_SESSION['cart'])){
              $count = count($_SESSION['cart']);
              echo "<span>$count</span>";
          }else{
              
          }

        ?>
        
        </i></a>
    </div>

  </div>
  <!-- head -->  
  
  <div class="main">

    <div class="left">
      <div class="container">
        <h1>CUSTOMER INFORMATION</h1>
        <form>
          <div class="form-control">
            <input type="text" required>
            <label>Email</label>
            <!-- <label>
              <span style="transition-delay: 0ms">E</span>
                <span style="transition-delay: 50ms">m</span>
                <span style="transition-delay: 100ms">a</span>
                <span style="transition-delay: 150ms">i</span>
                <span style="transition-delay: 200ms">l</span>
          </label> -->
          </div>
          <h1>SHIPPING INFORMATION</h1>
          <div class="form-control">
            <input type="text" required placeholder="NAME">
          </div>
          <div class="form-control">
            <input type="text" required placeholder="COMPANY">
          </div>
          <div class="form-control ">
            <input type="text" required placeholder="ADDRESS">
          </div>
          <div class="form-control">
            <input type="text" required placeholder="APARTMENT">
          </div>
          <div class="form-control">
            <input type="text" required placeholder="APARTMENT">
          </div>
          <div class="form-control">
            <input type="text" required placeholder="PHONE NUMBER (OPTIONAL)">
          </div>
    
          <button class="btn">Check Out</button>
    
        </form>
      </div>
    </div>  

    <div class="right">
     
             <?php

            $total = 0;
                if (isset($_SESSION['cart'])){
                    $product_id = array_column($_SESSION['cart'], 'product_id');

                    $result = $db->getData();
                    while ($row = mysqli_fetch_assoc($result)){
                        foreach ($product_id as $id){
                            if ($row['id'] == $id){
                              cartElement($row['product_image'], $row['product_name'],$row['product_price'], $row['id']);
                              $total = $total + (int)$row['product_price'];
                            }
                        }
                    }
                }else{
                    echo "
                    <div class=\"lt\">
                        <h5>Cart is Empty</h5>
                        
                    </div>
                    <div class=\"rt\">
                        <p> Empty <br>
                        RM<span>Empty</span></p>
                    </div>
                 ";
                }

            ?>

<!--         
        <div class="flex1">
            <div class="form-control" >
                <input type="text" required placeholder="APPLY">
            </div>
            <button>APPLY</button>
        </div> -->

        <div class="flex2">
            <div class="left">
                
                <p>SUBTOTAL         :</p>
                <p>SHIPPING FEE     :</p>
            </div>
            <div class="right">
                
                <p>RM<?php echo $total; ?></p>
                <p>RM10</p>
            </div>
        </div>
        <div class="flex3">
            <div class="left">
                <p>TOTAL        :</p>
            </div>
            <div class="right">
                <p>RM<?php echo $total+10; ?></p>
            </div>
        </div>
      </div>
  </div>
  <!-- Form Input Wave -->
  





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
        const labels = document.querySelectorAll('.form-control label')
        
        labels.forEach(label => {
            label.innerHTML = label.innerText
                .split('')
                .map((letter, idx) => `<span style="transition-delay:${idx * 50}ms">${letter}</span>`)
                .join('')
        })
        </script>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
  </html>