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

        <input type="submit" name="getEvents" value="Display All Teams"/><br/><br/>
        <input type="text" name="query_ID" id="query_ID" value="Query Team by ID"/>
        <input type="submit" name="search_ID" value="Search"/><br/><br/>

        <input type="text" name="team_name" id="team_name" value="Team Name"/>
        <input type="submit" name="input_data" value="Add"/><br/><br/>
    </body>
</html>