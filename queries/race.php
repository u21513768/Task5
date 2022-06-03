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
        <title>Races</title>
    </head>
    <body>
        <a href="../login/logout.php">logout</a>
        <a href="event.php">Events</a>
        <a href="race.php">Races</a>
        <a href="swimmer.php">Swimmer</a>
        <a href="team.php">Team</a>
        <h1>This is the Races page</h1>
        Hello <?php echo $user_data['user_name'];   ?><br/><br/>

        <input type="submit" name="getEvents" value="Display All Races"/><br/><br/>
        <input type="text" name="query_ID" id="query_ID" value="Query Race by ID"/>
        <input type="submit" name="search_ID" value="Search"/><br/><br/>

        <input type="text" name="pool_id" id="pool_id" value="Pool ID"/>
        <input type="text" name="event_id" id="event_id" value="Event ID"/>
        <input type="text" name="date" id="date" value="Date"/>
        <input type="text" name="distance" id="distance" value="Distance"/>
        <input type="text" name="stroke_type" id="stroke_type" value="Stroke Type"/>
        <input type="submit" name="input_data" value="Add"/><br/><br/>
    </body>
</html>