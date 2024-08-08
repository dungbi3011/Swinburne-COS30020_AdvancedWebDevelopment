<!DOCTYPE html>
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<meta name="description" content="Web Application Development :: Lab 3" />
<meta name="keywords" content="Web,programming" />
<title>Leap Year Check</title>
</head>
<body>
    <h1>Lab03 Task 2 - Leap Year</h1>

    <form action = "leapyear_selfcall.php" method = "get">
        <label for="number">Year: </label>
        <input type="number" name="number" id="number" placeholder="Enter the number here..."><br>
        <button type="submit">Check for Leap Year</button>
    </form>
    
    <?php
        if (isset ($_GET["number"])) {
            $number = $_GET["number"];
        
            function is_leapyear($num) {
                if ($num > 0) { 
                    if ($num == round ($num)) {
                        if ($num % 4 == 0 && ($num % 100 != 0 || $num % 400 == 0)) {
                            return true;
                        } else {
                            return false;
                        }
                    } 
                } 
            }

            if (is_numeric($number)) {
                if (is_leapyear($number)) {
                    echo "<p>The year you entered ", $number, " is a leap year.</p>";
                } else {
                    echo "<p>The year you entered ", $number, " is not a leap year.</p>";
                }
            } else {
                echo "<p style = 'color: red;'>Please enter an input number!</p>";
            }
        }
    ?>
</body>
</html>