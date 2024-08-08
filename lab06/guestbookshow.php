<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Web application development" />
        <meta name="keywords" content="PHP" />
        <meta name="author" content="Tran Quoc Dung" />
        <title>Lab 06</title>
    </head>
    <style>
        table, th, td {
            border: 1px solid black;
            text-align: center;
        }
    </style>

    <body>
        <h1>Lab06 Task 2 - Guestbook</h1>
        <h2>View Guestbook</h2>
        <hr>

        <?php 
            $filename = "../../data/lab06/guestbook.txt"; 
        
            if (is_readable($filename)) {
                $handle = fopen($filename, "r"); // open the file in read mode
                $alldata = array();
                while (! feof ($handle)) { // loop while not end of file
                    $onedata = fgets($handle); // read a line from the text file
                    if ($onedata != "") { // ignore blank lines
                        $data = explode("," , $onedata); // explode string to array
                        $alldata[] = $data; // create an array element
                    }
                }
                sort($alldata);
                echo "<table><tr><th>Number</th><th>Name</th><th>Email</th></tr>";
                for ($i = 0; $i < count($alldata); $i++) {
                    if (isset($alldata[$i][0]) && isset($alldata[$i][1])) {  
                        echo "<tr>
                                <td>", $i + 1, "</td>
                                <td>", $alldata[$i][0], "</td>
                                <td>", $alldata[$i][1], "</td>
                            </tr>
                        ";
                    }
                }
                echo "</table>";
            } else {
                echo "Unable to read the guest book file.";
            }
        ?>
        <hr>
        <a href = 'guestbookform.php'>Add Another Visitor</a>
    </body>
</html>