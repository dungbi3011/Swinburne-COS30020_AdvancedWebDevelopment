<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Web application development" />
        <meta name="keywords" content="PHP" />
        <meta name="author" content="Tran Quoc Dung" />
        <title>Adding Members</title>
    </head>

    <body>
        <?php
        require_once ("settings.php");
        //check form submitted
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Retrieve the form data
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $gender = $_POST["gender"];
            $email = $_POST["email"];
            $phone = $_POST["phone"];
        
            if (!$conn) {
                echo "<p style = 'color: red;'>Database not available!</p>";
            } else {
                echo "<p style = 'color: green;'>Database connected successfully!</p>";
            }
            //create the vipmembers table
            $sqlCreate = "CREATE TABLE IF NOT EXISTS vipmembers (member_id INT AUTO_INCREMENT PRIMARY KEY, fname VARCHAR(40), lname VARCHAR(40), gender VARCHAR(1), email VARCHAR(40), phone VARCHAR(20))";
            $result = @mysqli_query($conn, $sqlCreate);
            //insert records to table 
            $sqlInsert = "INSERT INTO vipmembers (fname, lname, gender, email, phone) VALUES ('$fname', '$lname', '$gender', '$email', '$phone')";
            $result = mysqli_query($conn, $sqlInsert);
            if (!$result){
                echo "<p style = 'color: red;'>Unable to insert data!</p>";
            }else{
                echo "<p style = 'color: green;'>Data inserted successfully!</p>";
            }
            //clean result and close connection
            mysqli_close($conn);
        }

        ?>
    </body>
</html>