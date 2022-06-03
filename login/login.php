<?php
session_start();
    
    include("connection.php");
    include("functions.php");

    if($_SERVER['REQUEST_METHOD'] == "POST")
    {
        //SOMETHING WAS POSTED
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        if (!empty($user_name) && !empty($password))
        {
            //read from database
            
            $query = "SELECT * FROM users WHERE user_name = '$user_name' limit 1";
            //$query2 = "SELECT * FROM users;";

            $result = mysqli_query($con, $query);
            
            if ($result)
            {
                if ($result && mysqli_num_rows($result) > 0)
                {
                    $user_data = mysqli_fetch_assoc($result);
                    
                    if($user_data['password'] === $password)
                    {
                        $_SESSION['user_id'] = $user_data['user_id'];
                        header("Location: index.php");
                        die;
                    }
                }
            }
            echo "Username or password incorrect!";
        }
        else
        {
            echo "Please enter the valid information!";
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>
        <style type="text/css">

        </style>

        <div id="box">
            <form method="post">
                <div>Login</div>
                <input id="text" type="text" name="user_name"><br><br>
                <input id="text" type="password" name="password"><br><br>

                <!--<input id="text" type="password" name="server_password"><br><br>-->

                <input id="button" type="submit" value="Login"><br><br>
                <p>Don't have an account?</p>
                <a href="signup.php">Click to Signup</a><br><br>
            </form>
        </div>
    </body>
</html>