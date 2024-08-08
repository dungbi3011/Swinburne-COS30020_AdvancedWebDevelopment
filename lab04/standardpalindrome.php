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
                $punc = array(".", "'", ",", " "); //punctuations that need to be removed
                $str_new = strtolower(str_replace($punc, "", $str));
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
