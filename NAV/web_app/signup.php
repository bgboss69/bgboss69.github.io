<?php 
session_start();

	include("connection.php");
	include("functions.php");


	//if server erm may be like in this page got post request 
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		// eg: 
		//	<input id="text" type="text" name="user_name"><br><br>
		//  input name is user_name so $_POST['user_name'] to global variable $user_name
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];
		// !is_numeric($user_name) mean not a number of username
		// !empty($user_name) mean not empty of username
		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{
			//save to database
			// insert a data by formula
			// users () is user table in created database in xampp
			//$query = "insert into users () values ()";
			// '$password' need ' ' because it is text		
			
			$user_id = random_num(20);
			$query = "insert into users (user_id,user_name,user_password) values ('$user_id','$user_name','$password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Please enter some valid information!";
		}
	}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign up</title>
    <link rel="shortcut icon" href="#" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/login.css">
    <script src="https://kit.fontawesome.com/a627fa96ad.js" crossorigin="anonymous"></script>

  </head> 
  <body>
  <!-- head -->
  <div class="header">
    <div class="left">
      <a href="./cover page.html"><img src="./IMAGE/logo.png" alt=""></a>
    </div>
    <div class="middle">

    </div>
    <div class="right">
        <!-- <a href="./login.html"><i class="fa-solid fa-cart-shopping"></i></a> -->
        <a href="login.php"><i class="fa-solid fa-user"></i> </a>

    </div>

  </div>
  <!-- head -->  
  
  <div class="main">

    <div class="left">
      <div class="container">
        <h1>Please Sign Up</h1>

        <form method="post">
          <div class="form-control">
            <input type="text" name="user_name"required>
            <label>UserName</label>
          </div>
    
          <div class="form-control">
            <input type="password" name="password" required>
            <label>Password</label>
          </div>  
            <input class="btn" id="button" type="submit" value="Sign up">
            <p class="text">Already have an account? <a href="login.php">Login</a> </p>
        </form>
      </div>
    </div>

    <div class="right">
      <h1 style="text-align: center;">IF YOU HAVE <br> AN ACCOUNT</h1>
      <p>LOGIN IN AN ACCOUNT TO <br>ACCESS YOUR EXCLUSIVE<br>MEMBERSHIP DISCOUNT. 
      </p>


      <button><a href="login.php">LOGIN</a></button>
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
    </body>
  </html>





<!-- <form method="post">
	<div style="font-size: 20px;margin: 10px;color: white;">Signup</div>

	<input id="text" type="text" name="user_name"><br><br>
	<input id="text" type="password" name="password"><br><br>

	<input id="button" type="submit" value="Signup"><br><br>

	<a href="login.php">Click to Login</a><br><br>
</form> -->