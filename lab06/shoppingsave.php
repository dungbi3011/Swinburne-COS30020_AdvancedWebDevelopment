<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="description" content="Web application development"/>
        <meta name="keywords" content="PHP"/>
        <meta name="author" content="Tran Quoc Dung"/>
        <title>Lab 06</title>
    </head>
    
    <body>
        <?php // read the comments for hints on how to answer each item
            if (isset ($_POST["item"]) && isset ($_POST["quantity"]) && !empty($_POST["item"]) && !empty($_POST["quantity"])) { // check if both form data exists
                $item = $_POST["item"]; // obtain the form item data
                $qty = $_POST["quantity"]; // obtain the form quantity data
                $filename = "../../data/lab06/shop.txt"; // assumes php file is inside lab06
                $alldata = array(); // create an empty array
                if (is_writable($filename)) { // check if file exists for reading
                    $itemdata = array(); // create an empty array
                    $handle = fopen($filename, "r"); // open the file in read mode
                    while (! feof ($handle)) { // loop while not end of file
                        $onedata = fgets($handle); // read a line from the text file
                        if ($onedata != "") { // ignore blank lines
                            $data = explode("," , $onedata); // explode string to array
                            $alldata [] = $data; // create an array element
                            $itemdata[] = $data[0]; // create a string element
                        }
                    }
                    fclose ($handle); // close the text file
                    $newdata = !(in_array($item, $itemdata)); // check if item exists in array
                } else {
                    $newdata = true; // file does not exists, thus it must be a new data
                }

                if ($newdata) {
                    $handle = fopen($filename, "a"); // open the file in append mode
                    $data = $item . "," . $qty . "\n"; // concatenate item and qty delimited
                    // by comma
                    fputs($handle, $data); // write string to text file
                    fclose ($handle); // close the text file
                    $alldata [] = array($item, $qty); // add data to array
                    echo "<p style = 'color: green;'>Shopping item added!</p><hr>";
                } else {
                    echo "<p style = 'color: red;'>Shopping item already exists!</p><hr>";
                } 
                sort($alldata); // sort array elements
                echo "<p>Shopping List</p>";
                foreach ($alldata as $data) { // loop using for each
                    echo "<p>", $data [0], ", ", $data[1], "</p>";
                }
            } else { // no input
                echo "<p style = 'color: red;'>Please enter item and quantity in the input form.</p>";
            }
        ?>
    </body>
</html>