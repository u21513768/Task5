<?php
session_start();

    include("../login/connection.php");
    include("../login/functions.php");
    include("functions.php");

    $user_data = check_if_login($con);

    if(isset($_POST['input_data']))
    {
        $race_id = $_POST['inputRace_id'];
        $swimmer_id = $_POST['inputSwimmer_id'];
        $swimmer_time = $_POST['swimmer_time'];
        $swimmer_position = $_POST['position'];
        $query = "UPDATE race_swimmer SET swimmer_time = '$swimmer_time', swimmer_position = '$swimmer_position' WHERE race_id = '$race_id' AND swimmer_id = '$swimmer_id'";
        $query2 = "UPDATE event_swimmer SET swimmer_points = (SELECT SUM(swimmer_position) FROM race_swimmer WHERE swimmer_id = '$swimmer_id') WHERE swimmer_id = '$swimmer_id'";

        if(mysqli_query($con, $query) === true)
        {
            if (mysqli_affected_rows($con) > 0) {
                if(mysqli_query($con, $query) === true)
                {
                    if (mysqli_affected_rows($con) > 0) {
                        echo '<script>alert("Data added successfully")</script>';
                    }
                    else {
                        echo "The data you submitted did not match the 
                        current data so nothing was changed.<br><br>";
                    } 
                }
                else
                {
                    echo "Error: " . $query . "<br>" . $con->error;
                }
            }
            else {
                echo "The data you submitted did not match the 
                current data so nothing was changed.<br><br>";
            }
            
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

            <input type="text" name="inputRace_id" id="inputRace_id" value="Race ID"/>
            <input type="text" name="inputSwimmer_id" id="inputSwimmer_id" value="Swimmer ID"/>
            <input type="time" name="swimmer_time" id="swimmer_time" value="Swimmer Time"/>
            <input type="text" name="position" id="position" value="Swimmer Position"/>
            <input type="submit" name="input_data" id="input_data" value="Add"/><br/><br/>
            
            <input type="text" name="event_id" id="event_id" value="Event ID"/><br/><br/>
            <input type="submit" name="getEvent" value="Event Info"/>
            <br/><br/>

            <input type="text" name="team_id" id="team_id" value="Team ID"/><br/><br/>
            <input type="submit" name="getTeam" value="Team Info"/>
            <br/><br/>

            <input type="text" name="race_id" id="race_id" value="Race ID"/><br/><br/>
            <input type="submit" name="getRace" value="Race Info"/>
            <br/><br/>

            <input type="text" name="swimmer_id" id="swimmer_id" value="Swimmer ID"/><br/><br/>
            <input type="submit" name="getSwimmer" value="Swimmer Info"/>
            <br/><br/>
        </form>
        <div>
            <?php

                //================================================
                //              Event ID
                //================================================
                if(isset($_POST['getEvent'])){

                    $event_id = $_POST['event_id'];
                    $query1 = "SELECT * FROM race WHERE event_id = '$event_id'";
                    $query2 = "SELECT event_swimmer.Event_ID, swimmer.Swimmer_ID, swimmer.Fname, swimmer.Lname, swimmer.sex
                    FROM event_swimmer INNER JOIN swimmer ON event_swimmer.Swimmer_ID = swimmer.SwimmerID
                        WHERE event_swimmer.Event_ID = '$event_id'";
                    $query3 = "SELECT venue_event.Event_ID, venue.Venue_ID, venue.Name, venue.Opening_hours, venue.Street_name, venue.Area_Code, venue.Street_Number
                    FROM venue_event INNER JOIN venue ON venue_event.Venue_ID = venue.Venue_ID
                        WHERE venue_event.Event_ID = '$event_id'";

                    $result1  = mysqli_query($con, $query1);
                    $result2  = mysqli_query($con, $query2);
                    $result3  = mysqli_query($con, $query3);

                    
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
                        echo "No races for that event<br/><br/>";
                    }

                    if (mysqli_num_rows($result2) > 0) 
                    {

                        echo "<table>";
                        echo "<tr>Swimmer Table: </tr><br/>";
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
                        echo "No Swimmers in that event<br/><br/>";
                    }

                    if (mysqli_num_rows($result3) > 0) 
                    {

                        echo "<table>";
                        echo "<tr>Venue Table: </tr><br/>";
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
                        echo "No Venues for that event<br/><br/>";
                    }

                    unset($_POST['getEvents']);
                }


                //================================================
                //              Team ID
                //================================================
                if(isset($_POST['getTeam'])){

                    $team_id = $_POST['team_id'];
                    $query1 = "SELECT team_swimmer.Team_ID, swimmer.Swimmer_ID, swimmer.Fname, swimmer.Lname, swimmer.sex
                    FROM team_swimmer INNER JOIN swimmer ON team_swimmer.Swimmer_ID = swimmer.Swimmer_ID
                        WHERE team_swimmer.Team_ID = '$team_id'";
                    $result1  = mysqli_query($con, $query1);
                    
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
                    else
                    {
                        echo "No swimmers in that team<br/><br/>";
                    }

                    unset($_POST['getTeam']);
                }

                //================================================
                //              Race ID
                //================================================
                if(isset($_POST['getRace'])){

                    $race_id = $_POST['race_id'];
                    $query1 = "SELECT race_swimmer.Race_ID, swimmer.Swimmer_ID, swimmer.Fname, swimmer.Lname, swimmer.sex, race_swimmer.Swimmer_Time, race_swimmer.Swimmer_Position
                    FROM race_swimmer INNER JOIN swimmer ON race_swimmer.Swimmer_ID = swimmer.Swimmer_ID
                        WHERE race_swimmer.Race_ID = '$race_id'";
                    $result1  = mysqli_query($con, $query1);
                    
                    if (mysqli_num_rows($result1) > 0) 
                    {

                        echo "<table>";
                        echo "<tr>Swimmer results for race: </tr><br/>";
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
                        echo "No results for this race<br/><br/>";
                    }

                    unset($_POST['getRace']);
                }

                //================================================
                //             Swimmer ID
                //================================================
                if(isset($_POST['getSwimmer'])){

                    $swimmer_id = $_POST['swimmer_id'];
                    $query1 = "SELECT race.Event_ID, race_swimmer.Swimmer_ID, race.Race_ID, race.Pool_ID, race.Distance, race.Stroke_Type, race.date, race.Start_Time
                    FROM race_swimmer INNER JOIN swimmer ON race_swimmer.Swimmer_ID = race.Swimmer_ID
                        WHERE race_swimmer.Swimmer_ID = '$swimmer_id'";
                    $result1  = mysqli_query($con, $query1);
                    
                    if (mysqli_num_rows($result1) > 0) 
                    {

                        echo "<table>";
                        echo "<tr>Races by swimmer: </tr><br/>";
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
                        echo "No races for the selected swimmer<br/><br/>";
                    }

                    unset($_POST['getSwimmer']);
                }
            ?>
        </div>
    </body>
</html>