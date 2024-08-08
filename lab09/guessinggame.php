
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Tran Quoc Dung" />
    <title>Lab 09</title>
</head>
<body>
    <h1>Guessing Game</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label for="guess">Guess a number between 1 and 100:</label></br>
            <input type="number" name="guess" id="guess" required>
            <input type="submit" value="Guess">
        </form>
        
    <?php
    session_start();

    // Check if the session variable for the generated number exists
    if (!isset($_SESSION['randNum'])) {
        // Generate a random number between 1 and 100
        $_SESSION['randNum'] = rand(0, 100);
        $_SESSION['guessCount'] = 0;
    }

    // Check if the user has submitted a guess
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $guess = $_POST["guess"];

        // Check if the guess is within the valid range and numeric
        if ($guess >= 1 && $guess <= 100) {
            $_SESSION['guessCount']++;

            // Compare the guess with the generated number
            if ($guess == $_SESSION['randNum']) {
                // Guessed correctly
                echo "<p style = 'color: green;'>Congratulations! You guessed the correct number: " . $_SESSION['randNum'] . "</p>";
                echo "<p>Number of guesses: " . $_SESSION['guessCount'] . "</p>";
                echo "<p><a href='giveup.php'>Give Up</a></p>";
                echo "<p><a href='startover.php'>Start Over</a></p>";
                session_destroy();
            } elseif ($guess < $_SESSION['randNum']) {
                // Guessed lower
                echo "<p>Try higher!</p>";
                echo "<p>Number of guesses: " . $_SESSION['guessCount'] . "</p>";
                echo "<p><a href='giveup.php'>Give Up</a></p>";
                echo "<p><a href='startover.php'>Start Over</a></p>";
            } else {
                // Guessed higher
                echo "<p>Try lower!</p>";
                echo "<p>Number of guesses: " . $_SESSION['guessCount'] . "</p>";
                echo "<p><a href='giveup.php'>Give Up</a></p>";
                echo "<p><a href='startover.php'>Start Over</a></p>";
            }
        } else {
            // Invalid guess
            echo "<p>Please enter a number between 1 and 100.</p>";
            echo "<p><a href='giveup.php'>Give Up</a></p>";
            echo "<p><a href='startover.php'>Start Over</a></p>";
        }
    }
    ?>


</body>
</html>