<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Assignment 1">
        <meta name="keywords" content="Web, programming">
        <meta name="author" content="Tran Quoc Dung">
        <title>Post Job Vacancy</title>
        <link rel="stylesheet" href="styles/postjobprocess.css">
    </head>

    <body>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Initializing each input
            $posID = $_POST["posId"];
            $title = $_POST["title"];
            $desc = $_POST["desc"];
            $date = $_POST["closeDate"];
            $position = isset($_POST["position"]) ? $_POST["position"] : "";
            $contract = isset($_POST["contract"]) ? $_POST["contract"] : "";
            //$acceptPost & $acceptEmail are created
            $acceptPost = isset($_POST["application"]) && in_array("Post", $_POST["application"]) ? "Yes" : "No";
            $acceptEmail = isset($_POST["application"]) && in_array("Email", $_POST["application"]) ? "Yes" : "No";
            //since two checkboxes can be selected at once for Application
            $location = $_POST["location"];

            // Validating each input 
            $errors = array();
            if (empty($posID)) {
                $errors[] = "Position ID is required!";
            } elseif (!preg_match("/^PID\d{4}$/", $posID)) { //checking valid format of PositionID
                $errors[] = "Invalid Position ID format! Use 'PID' followed by 4 digits (e.g. PID0001)!";
            } elseif (!checkID($posID)) { //checking duplicated PositionID
                $errors[] = "Position ID already exists! Please choose another Position ID!";
            }
            if (empty($title)) {
                $errors[] = "Job Title is required!";
            } elseif (!preg_match("/^[a-zA-Z0-9\s,.!]{1,20}$/", $title)) { //checking valid format of Title
                $errors[] = "Invalid Job Title format! (Maximum of 20 alphanumeric characters including spaces, comma, period (full stop) & exclamation point)";
            }
            if (empty($desc)) {
                $errors[] = "Job Description is required!";
            } elseif (!preg_match("/^.{1,250}$/", $desc)) { //checking valid format of Description
                $errors[] = "Invalid Description! (Maximum of 250 characters)";
            }
            if (empty($date)) {
                $errors[] = "Closing Date is required!";
            } elseif (!preg_match("/^\d{1,2}\/\d{1,2}\/\d{2}$/", $date)) {
                $errors[] = "Invalid Date format! Use the format dd/mm/yy (e.g. 30/11/23)!";
            }
            if (empty($position)) {
                $errors[] = "Position is required!";
            }
            if (empty($contract)) {
                $errors[] = "Contract is required!";
            }
            if (empty($_POST["application"])) {
                $errors[] = "Application is required!";
            }
            if (empty($location)) {
                $errors[] = "Location is required!";
            }

            // Displaying error messages 
            if (!empty($errors)) {
                echo '<h1 style = "color: red; text-align: center">Error <span>&#128531;</span></h1>';
                echo '<ul>';
                foreach ($errors as $error) {
                    echo '<li>' . $error . '</li>';
                }
                echo '</ul>';
                echo '<p>Go back to our <a href="postjobform.php">Post Job Vacancy</a> Page and complete all required inputs.</p>';
                echo '<p>Return to <a href="index.php">Home Page</a></p>';
            } else {
                // Creating the file and directory if they don't exist
                $filename = "../../data/jobposts/jobs.txt";
                umask(0007);
                $dir = "../../data/jobposts";
                if (!file_exists($dir)) {
                    mkdir($dir, 02770);
                }
                // Saving data to the text file
                $handle = fopen($filename, "a");
                if (is_writable($filename)) {
                    $posID = addslashes($posID);
                    $title = addslashes($title);
                    $desc = addslashes($desc);
                    $date = addslashes($date);
                    $position = addslashes($position);
                    $contract = addslashes($contract);
                    $acceptPost = addslashes($acceptPost);
                    $acceptEmail = addslashes($acceptEmail);
                    $location = addslashes($location);
                    $data = $posID . "\t" . $title . "\t" . $desc . "\t" . $date . "\t" . $position . "\t" . $contract . "\t" . $acceptPost . "\t" . $acceptEmail . "\t" . $location . "\n";
                    if (fwrite($handle, $data) > 0) {
                        echo '<h1 style = "color: green; text-align: center;">Success <span>&#128519;</span></h1>';
                        echo '<p>Job Vacancy has been saved!</p>';
                        echo '<p>Go back to our <a href="postjobform.php">Post Job Vacancy</a> Page</p>';
                        echo '<p>Return to <a href="index.php">Home Page</a></p>';
                    } else {
                        echo '<h1 style = "color: #45260A; text-align: center">Error <span>&#128531;</span></h1>';
                        echo '<p>The data file can not be written!</p>';
                        echo '<p>Go back to our <a href="postjobform.php">Post Job Vacancy</a> Page and complete all required inputs.</p>';
                        echo '<p>Return to <a href="index.php">Home Page</a></p>';
                    }
                }
                fclose($handle);
            }
        } else {
            echo '<h1 style = "color: #45260A; text-align: center">Error <span>&#128531;</span></h1>';
            echo '<p>One of the inputs is invalid!</p>';
            echo '<p>Go back to our <a href="postjobform.php">Post Job Vacancy</a> Page and complete all required inputs.</p>';
            echo '<p>Return to <a href="index.php">Home Page</a></p>';
        }

        // Function that check duplicated PositionID 
        function checkID($posID)
        {
            $file = "../../data/jobposts/jobs.txt";
            if (file_exists($file)) {
                $data = stripslashes(file_get_contents($file));
                $jobs = explode("\n", $data);
                foreach ($jobs as $job) {
                    $fields = explode("\t", $job);
                    if ($fields[0] == $posID) {
                        return false; // Duplicate ID found
                    }
                }
            } 
            return true; // No duplicate ID found
        }
        ?>
    </body>

</html>
