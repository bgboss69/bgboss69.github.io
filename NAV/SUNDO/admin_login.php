<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin login page</title>
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
            $admin_acc = $_POST['admin_acc'];
            $admin_pass = $_POST['admin_pass'];
            $admin_PIN = $_POST['admin_PIN'];
            if(!empty($admin_acc) && !empty($admin_pass) && !is_numeric($admin_acc)&& strlen($admin_pass) > 10) {
                $sql = "SELECT * FROM admin_login WHERE admin_acc = '$admin_acc'";
                $result = mysqli_query($con, $sql);

                if ($result) {
                    if ($result && mysqli_num_rows($result) > 0) {

                        $admin_data = mysqli_fetch_assoc($result);

                        if ($admin_data['admin_pass'] === $admin_pass) {
                            if ($admin_data['admin_PIN'] === $admin_PIN) {
                                // $_SESSION['admin_id'] is global variable
                                // so in index page can call it 
                                $_SESSION['admin_id'] = $admin_data['admin_id'];
                                header("Location: admin_control_page.php");
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
        <form method="POST">
            <h1>ADMIN LOGIN PAGE</h1>
            <label for="admin_acc">ADMIN</label>
            <input type="text" name="admin_acc">
            <label for="admin_pass">PASSWORD</label>
            <input type="password" name="admin_pass">
            <label for="admin_PIN">PIN</label>
            <input maxlength="6" type="password" name="admin_PIN">
            <div class="box">
                <input class="submit" type="submit" value="LOGIN">
                <a href="./admin_sign_up.php"><div class="submit">SIGN UP</div></a>
            </div>
        </form>
</body>
</html>
		 
