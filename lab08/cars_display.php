<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Web application development" />
        <meta name="keywords" content="PHP" />
        <meta name="author" content="Tran Quoc Dung" />
        <title>Lab 08</title>
    </head>
    <body>
        <h1>Web Programming - Lab08</h1>
        <?php
        require_once ("settings.php");

        // Use database
        if (!$conn) {
            echo "<p style = 'color: red;'>Database not available!</p>";
        } else {
            echo "<p style = 'color: green;'>Database connected successfully!</p>";
        }
        
        // execute sql statements
        $query = "SELECT car_id, make, model, price FROM cars";
        $results = mysqli_query($conn, $query) or die("<p>Unable to execute the query.</p>" 
        . "<p style = 'color: red;'>Error code " . mysqli_errno($conn) . ": " . mysqli_error($conn) . "</p>");
        if (mysqli_affected_rows($conn) > 1 ) { //number of rows selected
            echo "<p style = 'color: green;'>Successfully selected " . mysqli_affected_rows($conn) . " records.</p>";
        } else {
            echo "<p style = 'color: green;'>Successfully selected " . mysqli_affected_rows($conn) . " record.</p>";
        }

        // displaying results
        echo "<table width='50%' border='1'>";
        echo "<tr><th>Car ID</th><th>Make</th><th>Model</th><th>Price</th></tr>";
        $row = mysqli_fetch_row($results); //converting to enumerated array
        while ($row) {
            echo "<tr><td>{$row[0]}</td>";
            echo "<td>{$row[1]}</td>";
            echo "<td>{$row[2]}</td>";
            echo "<td>{$row[3]}</td></tr>";
            $row = mysqli_fetch_row($results);
        }
        echo "</table>";

        // close the connection
        mysqli_free_result($results); //refresh the memory of $result
        mysqli_close($conn);
        ?>
    </body>
</html>
