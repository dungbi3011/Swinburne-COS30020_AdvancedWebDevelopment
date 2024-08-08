<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <meta name="description" content="Web Programming :: Lab 2" >
    <meta name="keywords" content="Web,programming" >
    <title>Checking Numbers</title> 
</head>

<body>
    <?php
        if (isset($_GET["variable"])) {
            $variable = floatval($_GET["variable"]);
        
            if (is_numeric($variable)) {
                if (is_float($variable)) {
                    $number = round($variable);
                    if ($number % 2 == 0 ) {
                        echo "<p>The variable round($variable) contains an even number.</p>";
                    } else {
                        echo "<p>The variable round($variable) contains an odd number.</p>";
                    }
                } else {
                    if ($variable % 2 == 0 ) {
                        echo "<p>The variable round($variable) contains an even number.</p>";
                    } else {
                        echo "<p>The variable round($variable) contains an odd number.</p>";
                    }
                }
            } else {
                echo "<p>The variable is not a number.</p>";
            }
        }
    ?>
</body>
</html>