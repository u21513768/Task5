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

        <input type="submit" name="getEvents" value="Display All Events"/><br/><br/>
        <input type="text" name="query_ID" id="query_ID" value="Query event by ID"/>
        <input type="submit" name="search_ID" value="Search"/><br/><br/>

        <input type="text" name="event_name" id="event_name" value="Event Name"/>
        <input type="text" name="num_races" id="num_aces" value="Number of Races"/>
        <input type="submit" name="input_data" value="Add"/><br/><br/>
    </body>
</html>