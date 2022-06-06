<?php
session_start();

    include("../login/connection.php");
    include("../login/functions.php");
    include("functions.php");

    $user_data = check_if_login($con);

    if(isset($_POST['delete_id']))
    {
        $id = $_POST['remove_id'];
        $query = "DELETE FROM race WHERE race_id = '$id'";

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
        $pool_id = $_POST['pool_id'];
        $event_id = $_POST['event_id'];
        $date = $_POST['date'];
        $distance = $_POST['distance'];
        $stroke_type = $_POST['stroke_type'];
        $query = "INSERT INTO race (Pool_ID, Event_ID, Date, Distance, Stroke_Type) VALUES ('$pool_id', ' $event_id', '$date', '$distance' , '$stroke_type')";

        $result1 = $con->query("SELECT pool_id FROM pool WHERE pool_id = '$pool_id'");
        if($result1->num_rows == 0) 
        {
            // row not found, do stuff...
            echo "Please enter valid pool_ID";
        }
        else 
        { 
            $result2 = $con->query("SELECT event_id FROM event WHERE event_id = '$event_id'");
            if($result2->num_rows == 0) 
            {
                // row not found, do stuff...
                echo "Please enter valid event_ID";
            }
            else 
            { 
                
                if(mysqli_query($con, $query) === true)
                {
                    echo '<script>alert("Data Added successfully")</script>';
                }
                else
                {
                    echo "Error: " . $query . "<br>" . $con->error;
                }
                
            }
        }
    }

    if(isset($_POST['input_swimmer']))
    {
        $race_id = $_POST['race_id'];
        $swimmer_id = $_POST['swimmer_id'];
        $event_id = $_POST['event_id'];
        $query1 = "INSERT INTO race_swimmer (race_id, swimmer_id) VALUES ('$race_id' , '$swimmer_id')";
        $query2 = "INSERT INTO event_swimmer (event_id, swimmer_id) VALUES ('$event_id', '$swimmer_id)'";

        $result1 = $con->query("SELECT swimmer_id FROM swimmer WHERE swimmer_id = '$swimmer_id'");
        if($result1->num_rows == 0) 
        {
            // row not found, do stuff...
            echo "Please enter valid swimmer_ID";
        }
        else 
        { 
            $result2 = $con->query("SELECT race_id FROM race WHERE race_id = '$race_id'");
            if($result2->num_rows == 0) 
            {
                // row not found, do stuff...
                echo "Please enter valid race_ID";
            }
            else 
            { 
                if(mysqli_query($con, $query1) === true && mysqli_query($con, $query2) === true)
                {
                    echo '<script>alert("Data Added successfully")</script>';
                }
                else
                {
                    echo "Error: " . $query1 . $query2 . "<br>" . $con->error;
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Races</title>
    </head>
    <body>
        <a href="../login/logout.php">logout</a>
        <a href="event.php">Events</a>
        <a href="venue.php">Venues</a>
        <a href="race.php">Races</a>
        <a href="swimmer.php">Swimmer</a>
        <a href="team.php">Team</a>
        <a href="tournament.php">Tournament</a>
        <h1>This is the Races page</h1>
        Hello <?php echo $user_data['user_name'];   ?><br/><br/>

        <form method="post">
            <input type="submit" name="getRaces" value="Display All Races"/><br/><br/>
            <input type="text" name="remove_id" id="remove_id" value="Remove Race by ID"/>
            <input type="submit" name="delete_id" value="Delete"/><br/><br/>

            <input type="text" name="pool_id" id="pool_id" value="Pool ID"/>
            <input type="text" name="event_id" id="event_id" value="Event ID"/>
            <input type="date" name="date" id="date" value="Date"/>
            <input type="text" name="distance" id="distance" value="Distance"/>
            <input type="text" name="stroke_type" id="stroke_type" value="Stroke Type"/>
            <input type="submit" name="input_data" value="Add"/><br/><br/>
            
            <input type="text" name="race_id" id="race_id" value="Race ID"/>
            <input type="text" name="swimmer_id" id="swimmer_id" value="Swimmer ID"/>
            <input type="submit" name="input_swimmer" value="Add"/><br/><br/>
        </form>
        <div>
            <?php
                if(isset($_POST['getRaces'])){

                    $query1 = "SELECT * FROM race";
                    $query2 = "SELECT * FROM race_swimmer";
                    $result1  = mysqli_query($con, $query1);
                    $result2  = mysqli_query($con, $query2);

                    
                    if (mysqli_num_rows($result1) > 0) 
                    {

                        echo "<table>";
                        echo "<tr>Race Table: </tr><br/>";
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
                        echo "Race table is empty<br/><br/>";
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

                    unset($_POST['getEvents']);
                }
            ?>
        </div>
    </body>
</html>