<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Web application development" />
        <meta name="keywords" content="PHP" />
        <meta name="author" content="Tran Quoc Dung" />
        <title>Displaying Members</title>
    </head>

    <body>
        <h1>Vip Members</h1>
        <?php
        require_once ("settings.php");

        if (!$conn) {
            echo "<p style = 'color: red;'>Database not available!</p>";
        } else {
            echo "<p style = 'color: green;'>Database connected successfully!</p>";
        }
        //select all records from vip member table
        $sqlSelect = "SELECT member_id, fname, lname FROM vipmembers";
        $result = mysqli_query($conn, $sqlSelect);


        //print vip members table
        echo "<table width='50%' border='1'>";
        echo "<tr><th>Member ID</th><th>First Name</th><th>last Name</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) { //converting to associative array
            echo "<tr><td>".$row['member_id']."</td>";
            echo "<td>".$row['fname']."</td>";
            echo "<td>".$row['lname']."</td></tr>";
        }
        echo "</table>";

        //close the connecion
        mysqli_close($conn);
        ?>
    </body>
</html>