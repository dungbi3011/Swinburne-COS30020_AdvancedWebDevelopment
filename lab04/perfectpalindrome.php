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
        <?php 
            if (isset ($_POST["text"])) { 
                $str = $_POST["text"];
                $str_new = strtolower($str);
                $str_reverse = strtolower(strrev($str_new));
                if (strcmp ($str_new, $str_reverse) == 0) { 
                    echo "<p>The text you entered ", $str, " is a perfect palindrome!</p>";
                } else { // string contains invalid characters
                    echo "<p>The text you entered ", $str, " is not a perfect palindrome!</p>";
                }
            }
        ?>
    </body>
</html>
