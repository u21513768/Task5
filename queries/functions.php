<?php

function check_if_login($con)
    {
       if (isset($_SESSION['user_id']))
       {
           $id = $_SESSION['user_id'];
           $query = "SELECT * FROM users WHERE user_id = '$id' limit 1";

           $result = mysqli_query($con, $query);

           if ($result && mysqli_num_rows($result) > 0)
           {
               $user_data = mysqli_fetch_assoc($result);
               return $user_data;
           }
       }

       //redirect to Login
       header("Location: ../login/login.php");
       die;
    }