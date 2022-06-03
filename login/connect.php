<html>
   <head>
      <title>Connect to MariaDB Server</title>
   </head>

   <body>
   <?php
        $mysqli = new mysqli("localhost:3305","root","Quintin12","swimmer_db");

        // Check connection
        if ($mysqli -> connect_errno) {
        echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
        exit();
        }
        else
        {
            echo "Attempt successful";
        }

        $result = $mysqli->query("SELECT Event_Name FROM event");
        $row = $result->fetch_assoc();
        echo "\n" . $row['Event_Name'];
        $mysqli->close();
    ?>
   </body>
</html>