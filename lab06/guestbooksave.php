<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Web application development" />
        <meta name="keywords" content="PHP" />
        <meta name="author" content="Tran Quoc Dung" />
        <title>Lab 06</title>
    </head>
    
    <body>
        <h1>Lab06 Task 2 - Guestbook</h1>
        <h2>Sign Guestbook</h2>
        <hr>
        <?php 
            if (isset($_POST["name"]) && isset($_POST["email"]) && !empty($_POST["name"]) && !empty($_POST["email"])) {
                $name = $_POST["name"];
                $email = $_POST["email"];
                $filename = "../../data/lab06/guestbook.txt";
                umask(0007);
                $dir = "../../data/lab06";

                if (!file_exists($dir)) { 
                    mkdir($dir, 02770);
                }

                $regexp = "/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/";
                if (preg_match($regexp, $email)) {
                    $alldata = array();
                    $newdata = false; //initialising $newdata
                    if (file_exists($filename)) {
                        $alldata = file($filename, FILE_IGNORE_NEW_LINES);
                        $newdata = true; //if no matching results found
                        foreach ($alldata as $data) { 
                            $info = explode("," , $data);
                            if ($info[0] == $name || $info[1] == $email) { 
                                $newdata = false; //matching results found
                                break;
                            }
                        }
                    }

                    if ($newdata) { //no existed name & email
                        $handle = fopen($filename, "a"); 
                        $data = $name . "," . $email . "\n";
                        fputs($handle, $data);
                        fclose ($handle); 
                        $alldata[] = array($name, $email); 
                        echo "<p style = 'color: green;'>Thank you for signing our guest book!</p>";
                        $i = count($alldata) - 1; //index of last element (recently added element)
                        echo "<p><strong>Name: </strong>", $alldata[$i][0], "<br><strong>E-mail: </strong>", $alldata[$i][1], "</p><hr>";    

                    } else { //existed name & email
                        echo "<p style = 'color: red;'>You have already signed the guest book!</p><hr>";
                    }
                } else {
                    echo "<p style = 'color: red;'>Email address is not valid.</p><hr>";
                }
            } else {
                echo "<p style = 'color: red;'>You must enter your name and email address!</p><hr>";
            }
            echo "<a href = 'guestbookform.php'>Add Another Visitor</a><br>";   
            echo "<a href = 'guestbookshow.php'>View Guest Book</a>";
        ?>
    </body>
</html>
