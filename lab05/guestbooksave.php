<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Web application development" />
        <meta name="keywords" content="PHP" />
        <meta name="author" content="Tran Quoc Dung" />
        <title>Lab 05</title>
    </head>
    
    <body>
        <?php 
            if (isset($_POST["fname"]) && isset($_POST["lname"]) && !empty($_POST["fname"]) && !empty($_POST["lname"])) {
                $firstName = $_POST["fname"];
                $lastName = $_POST["lname"];
                $filename = "../../data/guestbook.txt";
                umask(0007);
                $dir = "../../data";

                if(!file_exists($dir)){ 
                    mkdir($dir, 02770);
                }
                $handle = fopen($filename,"a");
                if(is_writable($filename)) {
                    $firstName = addslashes($firstName);
                    $lastName = addslashes($lastName);
                    $data = $firstName . "," . $lastName . "\n";

                    if(fwrite($handle, $data) > 0){
                        echo "<p style = 'color: green'>Thank you for signing our guest book!</p>";
                    }
                    else{
                        echo "<p>Cannot add your name to the guest book!";
                    }
                    fclose($handle);

                }
            } else {
                echo "<p style = 'color: red'>You must enter your first and last name!</p>";
                echo "<p style = 'color: red'>Use the Browser's 'Go Back' button to return to the Guestbook form.</p>";
                echo "<a href = 'guestbookform.php'>Go Back</a>";
            }
        ?>
    </body>
</html>
