<?php
session_start();

    include("../login/connection.php");
    include("../login/functions.php");
    include("functions.php");

    $user_data = check_if_login($con);

    if(isset($_POST['delete_id']))
    {
        $id = $_POST['remove_id'];
        $query = "DELETE FROM venue WHERE venue_id = '$id'";

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
        $venue_name = $_POST['venue_name'];
        $opening_hours = $_POST['opening_hours'];
        $street_name = $_POST['street_name'];
        $area_code = $_POST['area_code'];
        $street_number = $_POST['street_number'];
        $query = "INSERT INTO venue (name, opening_hours, street_name, area_code, street_number) VALUES ('$venue_name', '$opening_hours', '$street_name', '$area_code', '$street_number')";

        if(mysqli_query($con, $query) === true)
        {
            echo '<script>alert("Data Added successfully")</script>';
        }
        else
        {
            echo "Error: " . $query . "<br>" . $con->error;
        }
    }

    if(isset($_POST['input_pool']))
    {
        $venue_id = $_POST['venue_id'];
        $pool_name = $_POST['pool_name'];
        $num_lanes = $_POST['num_lanes'];
        $query = "INSERT INTO pool (venue_id, pool_name, num_lanes) VALUES ('$venue_id', '$pool_name', '$num_lanes')";

        $result = $con->query("SELECT venue_id FROM venue WHERE venue_id = '$venue_id'");
        if($result->num_rows == 0) 
        {
            // row not found, do stuff...
            echo "Please enter valid venue_ID";
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
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Venues</title>
    </head>
    <body>
        <a href="../login/logout.php">logout</a>
        <a href="event.php">Events</a>
        <a href="venue.php">Venues</a>
        <a href="race.php">Races</a>
        <a href="swimmer.php">Swimmer</a>
        <a href="team.php">Team</a>
        <a href="tournament.php">Tournament</a>
        <h1>This is the Venue page</h1>
        Hello <?php echo $user_data['user_name'];   ?><br/><br/>

        <form method="post">
            <input type="submit" name="getVenue" value="Display All Venues"/><br/><br/>
            <input type="text" name="remove_id" id="remove_id" value="Remove Venue by ID"/>
            <input type="submit" name="delete_id" value="Delete"/><br/><br/>

            <input type="text" name="venue_name" id="venue_name" value="Venue Name"/>
            <input type="time" name="opening_hours" id="opening_hours" value="Opening Hours"/>
            <input type="text" name="street_name" id="street_name" value="Street Name"/>
            <input type="text" name="area_code" id="area_code" value="Area Code"/>
            <input type="text" name="street_number" id="street_number" value="Street Number"/>
            <input type="submit" name="input_data" value="Add"/><br/><br/>

            <input type="text" name="venue_id" id="venue_id" value="Venue ID"/>
            <input type="text" name="pool_name" id="pool_name" value="Pool Name"/>
            <input type="text" name="num_lanes" id="num_lanes" value="Number of Lanes"/>
            <input type="submit" name="input_pool" value="Add"/><br/><br/>
        </form>
        <div>
            <?php
                if(isset($_POST['getVenue'])){

                    $query1 = "SELECT * FROM venue";
                    $query2 = "SELECT * FROM venue_event";
                    $query3 = "SELECT * FROM pool";
                    $result1  = mysqli_query($con, $query1);
                    $result2  = mysqli_query($con, $query2);
                    $result3  = mysqli_query($con, $query3);

                    
                    if (mysqli_num_rows($result1) > 0) 
                    {

                        echo "<table>";
                        echo "<tr>Venue Table: </tr><br/>";
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
                        echo "Venue table is empty<br/><br/>";
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

                    if (mysqli_num_rows($result3) > 0) 
                    {

                        echo "<table>";
                        echo "<tr>Pool Table: </tr><br/>";
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
                        echo "Pool table is empty<br/><br/>";
                    }
                    unset($_POST['getEvents']);
                }
            ?>
        </div>
    </body>
</html>