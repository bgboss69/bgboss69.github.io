<?php

session_start();

if(isset($_SESSION['admin_id']))
        {
            // unset global variable ($_SESSION['user_id'])
            unset($_SESSION['admin_id']);

        }

        header("Location: admin_login.php");
        die;

        // function logout()
        // {
        //     // if global variable ($_SESSION['user_id']) is isset which mean exist 
        //     if(isset($_SESSION['user_id']))
        //     {
        //         // unset global variable ($_SESSION['user_id'])
        //         unset($_SESSION['user_id']);
    
        //     }
    
        //     header("Location: usser_login.php");
        //     die;
    
        // }