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

        $file = "../../data/guestbook.txt"; 

        if (is_readable($file)) {
            $data = stripslashes(file_get_contents($file));
            echo "<pre>" . $data . "</pre>";
        } else {
            echo "Unable to read the guest book file.";
        }
        ?>

    </body>
</html>