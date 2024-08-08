<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="utf-8" />
    <meta name="description" content="Web application development" />
    <meta name="keywords" content="PHP" />
    <meta name="author" content="Tran Quoc Dung" />
    <title>Lab 04</title>
    </head>
    <body>
        <h1>Web Programming - Lab 4</h1>

        <form action = "standardpalindromeself.php" method = "post" >
        <label for="text">String: </label>
        <input type="text" name="text" id="text" placeholder="Enter the string here..."><br>
        <button type="submit">Check for Standard Palindrome</button>

        <?php 
            if (isset ($_POST["text"])) { 
                $str = $_POST["text"];
                $str_new = strtolower(preg_replace("(   `[^A-Za-z0-9])", "", $str));
                $str_reverse = strtolower(strrev($str_new));
                if (strcmp ($str_new, $str_reverse) == 0) { 
                    echo "<p>The text you entered ", $str, " is a standard palindrome!</p>";
                } else { // string contains invalid characters
                    echo "<p>The text you entered ", $str, " is not a standard palindrome!</p>";
                }
            }
        ?>
    </body>
</html>