<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Web application development" />
        <meta name="keywords" content="PHP" />
        <meta name="author" content="Tran Quoc Dung" />
        <title>Searching Members</title>
    </head>
    
    <body>
        <h1>Search Member Form</h1>
        <form action="member_search.php" method="post">       
            <label for="lname">Last Name:</label>
            <input type="text" name="lname" id="lname" placeholder = "Enter your last name here..." required></br><br>      
            <input type="submit" value="Search Member">
        </form>
        <?php   
        require_once ("settings.php");
        //retrieve data from form
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $lname = $_POST["lname"];
        
            if (!$conn) {
                echo "<p style = 'color: red;'>Database not available!</p>";
            } else {
                // select id, firstname, lastname and email where lname 
                $sqlSearch = "SELECT member_id, fname, lname, email FROM vipmembers WHERE lname LIKE '%$lname%' ";
                $result = mysqli_query($conn, $sqlSearch);
                //print the result
                echo "<br><table width='50%' border='1'>";
                echo "<tr><th>Member ID</th><th>First Name</th><th>Last Name</th><th>Email</th></tr>";
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr><td>".$row['member_id']."</td>";
                    echo "<td>".$row['fname']."</td>";
                    echo "<td>".$row['lname']."</td>";
                    echo "<td>".$row['email']."</td></tr>";
                }
                echo "</table>";
            }
            //close the connection
            mysqli_close($conn);
        }
        ?>
    </body>
</html>
