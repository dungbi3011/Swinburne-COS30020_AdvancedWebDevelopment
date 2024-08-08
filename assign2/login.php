<?php
    // Start the session and check if the user is already logged in
    session_start();
    if (isset($_SESSION["login"]) && $_SESSION["login"] === true) {
        header("Location: friendlist.php");
        exit;
    }

    require_once("setting.php");

    // Initialize variables to store user input
    $email = $password = "";
    $error = "";

    // Process form data when the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Get email and password from the form 
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);

        // Connect to database
        $conn = mysqli_connect($host, $user, $pswd, $dbnm);
        if (!$conn) {
            echo "<p class = 'login_database'>Cannot connect to database.</p>";
        }

        // Check if the email and password exist in the 'friends' table
        $loginSQL = "SELECT * FROM friends WHERE friend_email = '$email' AND password = '$password'";
        $result = mysqli_query($conn, $loginSQL);

        if (!$result) {
            die("Invalid query: " . mysqli_error($conn));
        }

        if (mysqli_num_rows($result) === 1) {
            // Login successful
            $row = mysqli_fetch_assoc($result);
            $name = $row["profile_name"];

            session_start();
            $_SESSION["login"] = true;
            $_SESSION["friend_email"] = $email;
            $_SESSION["profile_name"] = $name;
            header("Location: friendlist.php");
            exit;
        } else {
            // Login failed
            $error = "Invalid email or password.";
        }

        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name = "description" conten t= "Assignment 2">
        <meta name = "keywords" content = "Web,programming">
        <meta name = "author" content = "Tran Quoc Dung">
        <meta name = "studentid" content = "103803891">
        <title>Log In</title>
        <link rel = "stylesheet" href = "style.css">
    </head>
    <body>
        <div class="login">
            <h1>My Friend System</h1>
            <h2>Log in Page</h2>

            <?php
            if (isset($error)) {
                echo "<p class='error'>$error</p>";
            }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required><br><br>

                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required><br><br>

                <input type="submit" value="Log in">
                <input type="reset" value = "Clear">
            </form>
            
            <p class = 'references'>Return to <a href="index.php">Home Page</a></p>
        </div>
    </body>
</html>

