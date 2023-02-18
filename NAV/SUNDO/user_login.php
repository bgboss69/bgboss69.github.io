<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User login page</title>
    <script src="https://kit.fontawesome.com/a627fa96ad.js" crossorigin="anonymous"></script>
</head>
<style>
    *{
        box-sizing: border-box;
    }
    
    a{
        display: block;
        color: white;
        font-size: 30px;
        text-decoration: none;
    }

    body{
        position: relative;
        display: flex;
        justify-content: space-evenly;
        align-items: center;
        height: 100vh;
        background-color: black;
        background-size: cover;
        background-image: url(./IMAGE/index.jpg);
        background-position: 30% 30%;
        background-repeat:no-repeat ;
        overflow: hidden;

    }

    .wrong_box{
        position: absolute;
        top: 10px;
        right: 10px;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 30px;
        height: 30px;
        transition: all 1s;
        color: white;
    }

    .wrong_box:hover{
        transform: scale(1.1);
    }

    form{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 50vw;
        height: 35vw;
        box-shadow: 0.5rem 0.5rem gold, -0.5rem -0.5rem white;
    }

    h1{
        display: inline-block;
        padding: 30px;
        color: white;
        font-size:40px ;
        box-shadow: 0.25rem 0.25rem white, -0.25rem -0.25rem gold;

    }

    label{
        color: white;
        font-size: 30px;

    }
  

    input{
        display: inline-block;
        font-size: 30px;
        background-color: black;
        color: white;
        border-bottom: solid 3px lightgoldenrodyellow ;
        transition: all 0.7s;
    }

    
    .box{
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .submit{
        margin-top: 30px;
        margin-left: 30px;
        padding: 10px;
        font-size: 30px;
        color: white;
        background-color: transparent;
        border:none;
        transition: all 0.7s;
        
    }

    .submit:hover{
        transform: scale(1.1);
        box-shadow: 0.25rem 0.25rem white , -0.25rem -0.25rem gold;

    }



</style>
<body>
    <?php
        session_start();

        $con = mysqli_connect('localhost','root','','webappdb');

        if (($_SERVER['REQUEST_METHOD'] == 'POST')) {
            $user_acc = $_POST['user_acc'];
            $user_pass = $_POST['user_pass'];
            $user_PIN = $_POST['user_PIN'];
            if (!empty($user_acc) && !empty($user_pass) && !is_numeric($user_acc)&& strlen($user_pass) > 10) {
                $sql = "SELECT * FROM user_login WHERE user_acc = '$user_acc'";
                $result = mysqli_query($con, $sql);

                if ($result) {
                    if ($result && mysqli_num_rows($result) > 0) {

                        $user_data = mysqli_fetch_assoc($result);

                        if ($user_data['user_pass'] === $user_pass) {
                            // $_SESSION['user_id'] is global variable
                            // so in index page can call it 
                            if ($user_data['user_PIN'] === $user_PIN) {
                                // $_SESSION['user_id'] is global variable
                                // so in index page can call it 
                                $_SESSION['user_id'] = $user_data['user_id'];
                                header("Location: cover_page.php");
                                die;
                            }

                        }
                    }
                }
                echo "<script> alert('wrong username or password!') </script>";
            } else {
                echo "<script> alert('wrong username or password!') </script>";
            }
        }


   
    ?>

    <!-- html -->
    <div class="wrong_box">
        <a href="./index.php"><i class="fa-regular fa-circle-xmark"></i></a>
    </div>
    <form method="POST" >
        <h1>USER LOGIN PAGE</h1>
        <label for="user_acc">USER</label>
        <input type="text" name="user_acc">
        <label for="user_pass">PASSWORD</label>
        <input type="password" name="user_pass">
        <label for="user_PIN">PIN</label>
        <input maxlength="6" type="password" name="user_PIN">
        <div class="box">
            <input class="submit" type="submit" value="LOGIN">
            <a href="./user_sign_up.php"><div class="submit">SIGN UP</div></a>
        </div>
    </form>

</body>
</html>