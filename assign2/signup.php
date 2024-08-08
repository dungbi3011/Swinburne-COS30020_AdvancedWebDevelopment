<?php
    require_once('setting.php');
    session_start();
    $errors = []; // Initialize the errors array

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Get form data
        $email = $_POST["email"];
        $name = $_POST["name"];
        $password = $_POST["password"];
        $confirmPassword = $_POST["confirm_password"];

        // Validate email (format & existence)
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email: Invalid format.";
        } else {
            // Check if email already exists in the friends table
            $conn = mysqli_connect($host, $user, $pswd, $dbnm);
            if (!$conn) {
                echo "<p class = 'signup_database'>Cannot connect to database.</p>";
            }
            $checkDuplicatedEmail = "SELECT friend_email FROM friends WHERE friend_email = '$email'";
            $result = mysqli_query($conn, $checkDuplicatedEmail);
            if (mysqli_num_rows($result) > 0) {
                $errors[] = "Email: Already exists.";
            }
            mysqli_close($conn);
        }

        // Validate name
        if (empty($name) || (!preg_match('/^[A-Za-z]*$/', $name))) {
            $errors[] = "Profile Name: Must contain only letters, no spaces.";
        }

        // Validate password & confirm password
        if (empty($password) || empty($confirmPassword)) {
            $errors[] = "Password & Confirm Password cannot be blank."; 
        } elseif (!preg_match('/^[A-Za-z0-9]+$/', $password)) {
            $errors[] = "Password must contain only letters & numbers."; 
        } elseif ($password !== $confirmPassword) {
            $errors[] = "Password & Confirm Password do not match.";  
        }

        // Successful Signup
        if (empty($errors)) {
            // Insert the data into the 'friends' table
            $conn = mysqli_connect($host, $user, $pswd, $dbnm);
            if (!$conn) {
                echo "<p class = 'signup_database'>Cannot connect to database.</p>";
            }
            //set the date to current and init num of friend to '0' at default
            $dateStarted = date("Y-m-d");
            $numOfFriends = 0;

            $insertDataSQL = "INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends)
                    VALUES ('$email', '$password', '$name', '$dateStarted', $numOfFriends)";
            $result = @mysqli_query($conn, $insertDataSQL);
            if (!$result) {
                // Registration failed
                $errors[] = "Unable to register. Please try again.";
            } else {
                // Registration successful
                $_SESSION["login"] = true;
                $_SESSION["friend_email"] = $email;
                $_SESSION["profile_name"] = $name;
                header("Location: friendadd.php");
                exit;
            }

            mysqli_close($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name = "description" content = "Assignment 2">
        <meta name = "keywords" content = "Web,programming">
        <meta name = "author" content = "Tran Quoc Dung">
        <meta name = "studentid" content = "103803891">
        <title>Sign Up</title>
        <link rel = "stylesheet" href = "style.css">
    </head>
    <body>
        <div class="signup">
            <h1>My Friend System</h1>
            <h2>Registration Page</h2>
            
            <!-- Displaying Errors -->
            <?php
            if (!empty($errors)) {
                echo "<ul>";
                foreach ($errors as $error) {
                    echo "<li>$error</li>";
                }
                echo "</ul>";
            }
            ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <label for="email">Email*:</label>
                <input type="email" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" required><br><br>

                <label for="profile">Profile Name*:</label>
                <input type="text" name="name" id="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>" required><br><br>

                <label for="password">Password*:</label>
                <input type="password" name="password" id="password" required><br><br>

                <label for="confirm_password">Confirm Password*:</label>
                <input type="password" name="confirm_password" id="confirm_password" required><br>
                
                <p>* : Required</p>

                <input type="submit" value="Register">
                <input type="reset" value = "Clear">
            </form>
            
            <p class = 'references'>Return to <a href="index.php">Home Page</a></p>
        </div>
    </body>
</html>
