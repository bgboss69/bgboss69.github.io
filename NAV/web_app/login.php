<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		//something was posted
		$user_name = $_POST['user_name'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !is_numeric($user_name))
		{

			//read from database
			$query = "select * from users where user_name = '$user_name' limit 1";
			// get the data from database same as $query
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{	
						// $_SESSION['user_id'] is global variable
						// so in index page can call it 
						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "wrong username or password!";
		}else
		{
			echo "wrong username or password!";
		}
	}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
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
        <!-- <a href="#"><i class="fa-solid fa-cart-shopping"></i></a> -->
        <a href="./login.php"><i class="fa-solid fa-user"></i></a>
    </div>

  </div>
  <!-- head -->  
  
  <div class="main">

    <div class="left">
      <div class="container">
        <h1>Please Login</h1>

        <form method="post">
          <div class="form-control">
            <input type="text" name="user_name"required>
            <label>UserName</label>
              <!-- <label>
                <span style="transition-delay: 0ms">E</span>
                  <span style="transition-delay: 50ms">m</span>
                  <span style="transition-delay: 100ms">a</span>
                  <span style="transition-delay: 150ms">i</span>
                  <span style="transition-delay: 200ms">l</span>
                </label> 
              -->
          </div>
    
          <div class="form-control">
            <input type="password" name="password" required>
            <label>Password</label>
          </div>
		  
		   <input class="btn" id="button" type="submit" value="Login">

          <p class="text">Don't have an account? <a href="signup.php">Register</a> </p>
        </form>
      </div>
    </div>

    <div class="right">
      <h1>NEW HERE ?</h1>
      <p>SIGN UP AND DISCOVER <br>
         GREAT AMOUNT OF NEW <br>
         OPPURTUNITY
      </p>
      <button><a href="signup.php">SIGN UP</a></button>
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

