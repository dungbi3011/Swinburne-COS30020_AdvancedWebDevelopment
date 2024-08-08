<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Web application development" />
        <meta name="keywords" content="PHP" />
        <meta name="author" content="Tran Quoc Dung" />
        <title>Guess the number</title>
    </head>

    <body>
        <p><a href="startover.php">Start Over</a></p>
    <?php

    // Check if the session variable for the generated number exists
    if (isset($_SESSION['randNum'])) {
        echo "<p>Giving up huh? The random number was: " . $_SESSION['randNum'] . "</p>";
    } else {
        echo "<p>No game in progress!</p>"; //no session
    }
    ?>
    </body>
</html>