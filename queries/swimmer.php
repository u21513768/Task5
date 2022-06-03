<?php
session_start();

    include("../login/connection.php");
    include("../login/functions.php");
    include("functions.php");

    $user_data = check_if_login($con);

    if(isset($_POST['delete_id']))
    {
        $id = $_POST['remove_id'];
        $query = "DELETE FROM swimmer WHERE swimmer_id = '$id'";

        if(mysqli_query($con, $query) === true)
        {
            if (mysqli_affected_rows($con) > 0) {
                echo '<script>alert("Delete successful")</script>';
            }
            else {
                echo "The data you submitted did not match the 
                current data so nothing was changed.<br><br>";
            }
            
        }
        else
        {
            echo "Error: " . $query . "<br>" . $con->error;
            echo '<script>alert("Delete unsuccessful")</script>';
        }
    }

    if(isset($_POST['input_data']))
    {
        $Fname = $_POST['Fname'];
        $Lname = $_POST['Lname'];
        $sex = $_POST['sex'];
        $query = "INSERT INTO swimmer (Fname, Lname, sex) VALUES ('$Fname', '$Lname', '$sex')";

        if(mysqli_query($con, $query) === true)
        {
            echo '<script>alert("Data Added successfully")</script>';
        }
        else
        {
            echo "Error: " . $query . "<br>" . $con->error;
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Swimmers</title>
    </head>
    <body>
        <a href="../login/logout.php">logout</a>
        <a href="event.php">Events</a>
        <a href="race.php">Races</a>
        <a href="swimmer.php">Swimmer</a>
        <a href="team.php">Team</a>
        <h1>This is the Swimmers page</h1>
        Hello <?php echo $user_data['user_name'];   ?><br/><br/>

        <form method="post">
            <input type="submit" name="getSwimmers" value="Display All Swimmers"/><br/><br/>
            <input type="text" name="remove_id" id="remove_id" value="Remove Swimmer by ID"/>
            <input type="submit" name="delete_id" value="Delete"/><br/><br/>

            <input type="text" name="Fname" id="Fname" value="First Name"/>
            <input type="text" name="Lname" id="Lname" value="Last Name"/>
            <input type="text" name="sex" id="sex" value="Sex"/><br/>

            Swimmer forms part of a team?
            <input type="checkbox" name="is_team_swimmer" value="Team"></br>
            <input type="submit" name="input_data" value="Add"/><br/><br/>
        </form>
        <div>
            <?php
                if(isset($_POST['getSwimmers'])){

                    $query1 = "SELECT * FROM swimmer";
                    $query2 = "SELECT * FROM race_swimmer";
                    $query3 = "SELECT * FROM solo_swimmer";
                    $query4 = "SELECT * FROM team_swimmer";
                    $result1  = mysqli_query($con, $query1);
                    $result2  = mysqli_query($con, $query2);
                    $result3  = mysqli_query($con, $query3);
                    $result4  = mysqli_query($con, $query4);
                    
                    if (mysqli_num_rows($result1) > 0) 
                    {

                        echo "<table>";
                        echo "<tr>Swimmer Table: </tr><br/>";
                        while($row = mysqli_fetch_assoc($result1))
                        {
                            echo "<tr>";
                            foreach ($row as $k=>$v) 
                            {
                                //echo "<td>";
                                echo "$k: $v";
                                echo "\t";
                                //echo "</td>";
                            }
                            echo "<br/>";
                            echo "</tr>";
                        }
                        echo "</table><br/><br/>";
                    
                    }
                    else
                    {
                        echo "Swimmer table is empty<br/><br/>";
                    }

                    if (mysqli_num_rows($result2) > 0) 
                    {

                        echo "<table>";
                        echo "<tr>Race_Swimmer Table: </tr><br/>";
                        while($row = mysqli_fetch_assoc($result2))
                        {
                            echo "<tr>";
                            foreach ($row as $k=>$v) 
                            {
                                //echo "<td>";
                                echo "$k: $v";
                                echo "\t";
                                //echo "</td>";
                            }
                            echo "<br/>";
                            echo "</tr>";
                        }
                        echo "</table><br/><br/>";
                    
                    }
                    else
                    {
                        echo "Race_Swimmer table is empty<br/><br/>";
                    }

                    if (mysqli_num_rows($result3) > 0) 
                    {

                        echo "<table>";
                        echo "<tr>Solo_Swimmer Table: </tr><br/>";
                        while($row = mysqli_fetch_assoc($result3))
                        {
                            echo "<tr>";
                            foreach ($row as $k=>$v) 
                            {
                                //echo "<td>";
                                echo "$k: $v";
                                echo "\t";
                                //echo "</td>";
                            }
                            echo "<br/>";
                            echo "</tr>";
                        }
                        echo "</table><br/><br/>";
                    
                    }
                    else
                    {
                        echo "Solo_Swimmer table is empty<br/><br/>";
                    }

                    if (mysqli_num_rows($result4) > 0) 
                    {

                        echo "<table>";
                        echo "<tr>Team_Swimmer Table: </tr><br/>";
                        while($row = mysqli_fetch_assoc($result4))
                        {
                            echo "<tr>";
                            foreach ($row as $k=>$v) 
                            {
                                //echo "<td>";
                                echo "$k: $v";
                                echo "\t";
                                //echo "</td>";
                            }
                            echo "<br/>";
                            echo "</tr>";
                        }
                        echo "</table><br/><br/>";
                    
                    }
                    else
                    {
                        echo "Team_Swimmer table is empty<br/><br/>";
                    }

                    //unset($_POST['getEvents']);
                }
            ?>
        </div>
    </body>
</html>