<?php
session_start();

    include("../login/connection.php");
    include("../login/functions.php");
    include("functions.php");

    $user_data = check_if_login($con);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Teams</title>
    </head>
    <body>
        <a href="../login/logout.php">logout</a>
        <a href="event.php">Events</a>
        <a href="race.php">Races</a>
        <a href="swimmer.php">Swimmer</a>
        <a href="team.php">Team</a>
        <h1>This is the Teams page</h1>
        Hello <?php echo $user_data['user_name'];   ?><br/><br/>

        <form method="post">
            <input type="submit" name="getTeam" value="Display All Teams"/><br/><br/>
            <input type="text" name="remove_id" id="remove_id" value="Remove Team by ID"/>
            <input type="submit" name="delete_id" value="Delete"/><br/><br/>

            <input type="text" name="team_name" id="team_name" value="Team Name"/>
            <input type="submit" name="input_data" value="Add"/><br/><br/>
        </form>
        <div>
            <?php
                if(isset($_POST['getTeam'])){

                    $query1 = "SELECT * FROM team";
                    $query2 = "SELECT * FROM team_swimmer";
                    $result1  = mysqli_query($con, $query1);
                    $result2  = mysqli_query($con, $query2);

                    
                    if (mysqli_num_rows($result1) > 0) 
                    {

                        echo "<table>";
                        echo "<tr>Team Table: </tr><br/>";
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

                    if (mysqli_num_rows($result2) > 0) 
                    {

                        echo "<table>";
                        echo "<tr>Team_Swimmer Table: </tr><br/>";
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
                    unset($_POST['getEvents']);
                }
            ?>
        </div>
    </body>
</html>