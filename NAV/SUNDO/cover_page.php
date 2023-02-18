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


        
        $user_data = check_login();
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cover page</title>
    <link rel="stylesheet" href="./CSS/cover.css">
</head>
<body>
    <div class="page1">
        <div class="title">
            <img src="./IMAGE/logo.png" alt="">
        </div>
        <div class="btn"><a href="./home.php">Learn more</a></div>
        <div class="left"></div>
        <div class="right">
            <div class="item3">
                
                <div class="mySlides fade">
                    <img src="./IMAGE/slide1.jpeg">
                </div>
            
                <div class="mySlides fade">
                    <img src="./IMAGE/slide2.jpeg">
                </div>
                
                <div class="mySlides fade">
                    <img src="./IMAGE/slide3.jpeg">
                </div>
    
            </div>
        </div>

    </div>

    <script>
        let slideIndex = 0;
        showSlides();
        
        function showSlides() {
        let i;
        let slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
        }
        slideIndex++;
        if (slideIndex > slides.length) {slideIndex = 1}    

        slides[slideIndex-1].style.display = "block";  
        setTimeout(showSlides, 4000); // Change image every 2 seconds

        }

        function plusDivs(n) {
          let slides = document.getElementsByClassName("mySlides");
          slideIndex += n;
          for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";  
          }
          if (slideIndex > slides.length) {slideIndex = 1}    
          slides[slideIndex-1].style.display = "block";  
        }
    </script>
</body>
</html>