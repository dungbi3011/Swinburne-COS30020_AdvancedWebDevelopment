<?php
    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $host = "feenix-mariadb.swin.edu.au";
        $user = $_POST['username'];
        $pswd = $_POST['password'];
        $dbnm = $_POST['database'];

        // Create a directory and file to store connection details
        umask(0007);
        $dir = "../../data/lab10";
        if (!file_exists($dir)) {
            mkdir($dir, 02770);
        }
        $filename = "../../data/lab10/mykeys.inc.php";
        if (file_exists($filename)) {
            $handle = fopen($filename, 'a');
            $details = "<?php\n";
            $details .= "\t\$host = \"$host\";\n";
            $details .= "\t\$username = \"$user\";\n";
            $details .= "\t\$password = \"$pswd\";\n";
            $details .= "\t\$dbname = \"$dbnm\";\n";
            $details .= "?>";
            file_put_contents($filename, $details);
            fclose($handle);
        }
        
        // Database connection
        $conn = mysqli_connect($host, $user, $pswd, $dbnm);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Create table if not exists
        $sql = "CREATE TABLE IF NOT EXISTS hitcounter (id SMALLINT NOT NULL PRIMARY KEY, hits SMALLINT NOT NULL);";
        if ($conn->query($sql) === TRUE) {
            echo "<p style = 'color: green;'>Table hitcounter created successfully!</p>";
        } else {
            echo "<p>Error creating table: " . $conn->error . "</p>";
        }

        //Check if data exists, else insert data
        $sqlDemo = "SELECT * FROM hitcounter WHERE id = 1";
        $result = $conn->query($sqlDemo);
        if (mysqli_num_rows($result) == 0) {
            $sql = "INSERT INTO hitcounter VALUES (1,0)";
            if ($conn->query($sql) === TRUE) {
                echo "<p style = 'color: green;'>Initial value inserted into hitcounter!</p>";
            } else {
                echo "<p>Error inserting initial value: " . $conn->error . "</p>";
            }
        } else {
            echo "<p style = 'color: green;'>Initial value already inserted into hitcounter.</p>";
        }
        mysqli_free_result($result);
        // Close connection
        $conn->close();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Web application development" />
        <meta name="keywords" content="PHP" />
        <meta name="author" content="Tran Quoc Dung" />
        <title>Lab 10</title>
    </head>

    <body>
        <h1>Web Programming - Lab 10</h1>
        <form action="setup.php" method = "post">
            <label for = "username">Username: </label><input type="text" name="username" required><br>
            <label for = "password">Password: </label><input type="password" name="password"><br>
            <label for = "database">Database: </label><input type="text" name="database" required><br>
            <input type="submit" name="submit" value="Set Up">
        </form>
    </body>
</html>

