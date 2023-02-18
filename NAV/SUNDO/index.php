<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
</head>
<style>
    body{
        background-color: black;
        height: 100vh;
        background-size: cover;
        background-image: url(./IMAGE/index.jpg);
        background-position: 30% 30%;
        background-repeat:no-repeat ;
        overflow: hidden;
        display: flex;
        justify-content: space-evenly;
        align-items: center;

    }
    button{
        width: 20vw;
        height: 20vh;
        background-image: url(./IMAGE/index.jpg);
        background-size: cover;
        background-position: 30% 30%;
        color: gold;
        font-size: 30px;
        transition: all 1s ;
        box-shadow: 0.5rem 0.5rem gold, -0.5rem -0.5rem white;
    }
    button:hover{
        box-shadow: 0.5rem 0.5rem white, -0.5rem -0.5rem gold;
        transform: scale(1.1);
    }
</style>
<body>
    
    <a href="admin_login.php"><button>ADMIN</button></a>
    <a href="user_login.php"><button>USER</button></a>
</body>
</html>