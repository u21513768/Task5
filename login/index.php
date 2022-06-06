<?php
session_start();
    
    include("connection.php");
    include("functions.php");

    $user_data = check_login($con);
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Website</title>
    </head>
    <body>
        <a href="logout.php">logout</a>
        <a href="../queries/event.php">Events</a>
        <a href="../queries/venue.php">Venues</a>
        <a href="../queries/race.php">Races</a>
        <a href="../queries/swimmer.php">Swimmer</a>
        <a href="../queries/team.php">Team</a>
        <a href="../queries/tournament.php">Tournament</a>
        <h1>This is the index page</h1>
        Hello <?php echo $user_data['user_name'];   ?>
    </body>
</html>