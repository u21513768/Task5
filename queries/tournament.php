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
        <title>Tournament</title>
    </head>
    <body>
        <a href="../login/logout.php">logout</a>
        <a href="event.php">Events</a>
        <a href="venue.php">Venues</a>
        <a href="race.php">Races</a>
        <a href="swimmer.php">Swimmer</a>
        <a href="team.php">Team</a>
        <a href="tournament.php">Tournament</a>
        <h1>This is the Tournament page</h1>
        Hello <?php echo $user_data['user_name'];   ?><br/><br/>

        <form method="post">
            
            <input type="text" name="remove_id" id="remove_id" value="Event ID"/><br/><br/>
            <input type="submit" name="getEvent" value="Event Info"/>
            <br/><br/>

            <input type="text" name="remove_id" id="remove_id" value="Team ID"/><br/><br/>
            <input type="submit" name="getTeam" value="Team Info"/>
            <br/><br/>

            <input type="text" name="remove_id" id="remove_id" value="Race ID"/><br/><br/>
            <input type="submit" name="getRace" value="Race Info"/>
            <br/><br/>

            <input type="text" name="remove_id" id="remove_id" value="Swimmer ID"/><br/><br/>
            <input type="submit" name="getSwimmer" value="Swimmer Info"/>
            <br/><br/>
        </form>
        <div>
            <?php
                if(isset($_POST['getEvents'])){

                    $query1 = "SELECT * FROM event";
                    $query2 = "SELECT * FROM venue_event";
                    $result1  = mysqli_query($con, $query1);
                    $result2  = mysqli_query($con, $query2);

                    
                    if (mysqli_num_rows($result1) > 0) 
                    {

                        echo "<table>";
                        echo "<tr>Event Table: </tr><br/>";
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
                        echo "Event table is empty<br/><br/>";
                    }

                    if (mysqli_num_rows($result2) > 0) 
                    {

                        echo "<table>";
                        echo "<tr>Venue_Event Table: </tr><br/>";
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
                        echo "Venue_Event table is empty<br/><br/>";
                    }
                    unset($_POST['getEvents']);
                }
            ?>
        </div>
    </body>
</html>