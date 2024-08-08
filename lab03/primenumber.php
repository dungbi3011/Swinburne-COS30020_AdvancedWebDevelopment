<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" >
    <meta name="description" content="Web Programming :: Lab 3" >
    <meta name="keywords" content="Web,programming" >
    <title>Math Functions</title>
</head>

<body>
    <?php
        if (isset ($_GET["number"])) {
            $number = intval($_GET["number"]);
        }

        function is_prime($num) {
            if ($num == 0) {
                return false; //not prime number
            } else if ($num == 1) {
                return true; //prime number
            } else {
                for ($i = 2; $i <= $num/2; $i++) {
                    if ($num % $i == 0) {
                        return false; //not prime number
                    }
                }
                return true; //prime number
            }
        }
        
        if (is_prime($number)) {
            echo "<p>The number you entered ", $number, " is a prime number.</p>";
        } else {
            echo "<p>The number you entered ", $number, " is not a prime number.</p>";
        }
    ?>
</body>
</html>