<?php
session_start();

    include("../login/connection.php");
    include("../login/functions.php");
    include("functions.php");

    $user_data = check_if_login($con);

    if(isset($_POST['delete_id']))
    {
        $id = $_POST['remove_id'];
        $query = "DELETE FROM event WHERE event_id = '$id'";

        if(mysqli_query($con, $query) === true)
        {
            echo '<script>alert("Delete successful")</script>';
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
        <title>Events</title>
    </head>
    <body>
        <a href="../login/logout.php">logout</a>
        <a href="event.php">Events</a>
        <a href="race.php">Races</a>
        <a href="swimmer.php">Swimmer</a>
        <a href="team.php">Team</a>
        <h1>This is the Event page</h1>
        Hello <?php echo $user_data['user_name'];   ?><br/><br/>

        <form method="post">
            <input type="submit" name="getEvents" value="Display All Events"/><br/><br/>
            <input type="text" name="remove_id" id="remove_id" value="Remove Event by ID"/>
            <input type="submit" name="delete_id" value="Delete"/><br/><br/>

            <input type="text" name="event_name" id="event_name" value="Event Name"/>
            <input type="text" name="num_races" id="num_aces" value="Number of Races"/>
            <input type="submit" name="input_data" value="Add"/><br/><br/>
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
                    unset($_POST['getEvents']);
                }
            ?>
        </div>
    </body>
</html>