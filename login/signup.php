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
            //save to database
            $user_id = random_num(3);
            $id = random_num(3);
            
            $query = "INSERT INTO users (id, user_id, user_name, password) VALUES ('$id', '$user_id', '$user_name', '$password')";
            $query2 = "SELECT * FROM users;";

            if (mysqli_query($con, $query) === true)
            {
                echo "added successfully";
            }
            else
            {
                echo "Error: " . $query . "<br>" . $con->error;
            }
            
            header("Location: login.php");
            die;
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
        <title>Signup</title>
    </head>
    <body>
        <style type="text/css">

        </style>

        <div id="box">
            <form method="post">
                <div>Signup</div>
                <input id="text" type="text" name="user_name"><br><br>
                <input id="text" type="password" name="password"><br><br>

                <!--<input id="text" type="password" name="server_password"><br><br>-->

                <input id="button" type="submit" value="Signup"><br><br>
                <p>Already have an account?</p>
                <a href="login.php">Click to Login</a><br><br>
            </form>
        </div>
    </body>
</html>