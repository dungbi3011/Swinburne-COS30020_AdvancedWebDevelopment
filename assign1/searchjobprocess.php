<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Assignment 1">
        <meta name="keywords" content="Web, programming">
        <meta name="author" content="Tran Quoc Dung">
        <title>Search Job Vacancy</title>
        <link rel="stylesheet" href="styles/searchjobprocess.css">
    </head>

    <body>
        <?php
        // Checking validation of Job_Title search string
        if (!isset($_GET['title']) || empty($_GET['title'])) {
            echo "<h1 style = 'color: red; text-align: center'>Error <span>&#128531;</span></h1>";
            echo "
            <p>Job title is required!</p>
            <p>Return to our <a href='searchjobform.php'>Searching Job Vacancy</a> Page</p>
            <p>Return to <a href='index.php'>Home Page</a></p>
            ";
            exit;
        }

        // Checking validation of jobs.txt file
        $file = "../../data/jobposts/jobs.txt";
        if (!file_exists($file)) {
            echo "<h1 style = 'color: red; text-align: center'>Error <span>&#128531;</span></h1>";
            echo "
            <p>Job data-file not found!</p>
            <p>Return to our <a href='searchjobform.php'>Searching Job Vacancy</a> Page</p>
            <p>Return to <a href='index.php'>Home Page</a></p>
            ";
            exit;
        }

        // Reading content from jobs data-file
        $jobs = file($file, FILE_IGNORE_NEW_LINES);

        // Inputs of search form
        $searchTitle = $_GET["title"];
        $searchPosition = isset($_GET["position"]) ? $_GET["position"] : "";
        $searchContract = isset($_GET["contract"]) ? $_GET["contract"] : "";
        $searchAcceptPost = isset($_GET["application"]) && in_array("Post", $_GET["application"]) ? "Yes" : "No";
        $searchAcceptEmail = isset($_GET["application"]) && in_array("Email", $_GET["application"]) ? "Yes" : "No";
        $searchLocation = $_GET["location"];
        $results = array();

    // Reading appropriate field of each jobs to compare
        foreach ($jobs as $job) {
            $fields = explode("\t", $job);
            $title = $fields[1];
            $position = $fields[4];
            $contract = $fields[5];
            $acceptPost = $fields[6];
            $acceptEmail = $fields[7];
            $location = $fields[8];

            //Checking for matching job vacancies
            if (stripos($title, $searchTitle) !== false) {
                // Implement these statements only once, using do...while(false) statement  
                do {
                // If these inputs are empty, we ignore & any value can be applied - Task 7
                    if (!empty($searchPosition)) {
                        if (strcmp($position, $searchPosition) !== 0) {
                            break;
                        }
                    }

                    if (!empty($searchContract)) {
                        if (strcmp($contract, $searchContract) !== 0) {
                            break;
                        }
                    }

                    if (!empty($_GET["application"])) {
                        if (strcmp($acceptPost, $searchAcceptPost) !== 0 || strcmp($acceptEmail, $searchAcceptEmail) !== 0) {
                            break;
                        }
                    }

                    if (!empty($searchLocation)) {
                        if (strcmp($location, $searchLocation) !== 0) {
                            break;
                        }
                    }

                    $results[] = $fields;
                } while (false);
                // Have this idea while figuring how to break out of if-else statement
            }
        }
    //

    //checking whether each Closing Date has passed today's date - Task 8
        for ($i = 0; $i < count($results); $i++) { //$results[$i][3] is ClosingDate of a job vacancy
            $closeDate = date_format(DateTime::createFromFormat('d/m/y', $results[$i][3]), 'm/d/y'); 
            $closeDate = strtotime($closeDate); //change format of date to use strtotime() 
            $todayDate = strtotime("now");

            if (($todayDate - $closeDate) > 0) { 
                unset($results[$i]);
            }
        }
        $results = array_values($results);
    //

    //checking which Job Vacancy has the closingDate nearst to today's date - Task 8
        if (count($results) > 1) {
            //creating an array of all Closing Dates
            $closeDateArray = array();
            for ($i = 0; $i < count($results); $i++) { //$result[3] is ClosingDate of a job vacancy
                $closeDate = date_format(DateTime::createFromFormat('d/m/y', $results[$i][3]), 'm/d/y');
                $closeDate = strtotime($closeDate); //change format of date to use strtotime()
                $closeDateArray[] = $closeDate;
            }
            //find the smallest element in array - nearest Closing Date
            $nearestDate = min($closeDateArray);
            //keeping only job vacancies with the nearest ClosingDate
            for ($i = 0; $i < count($results); $i++) {
                $closeDate = date_format(DateTime::createFromFormat('d/m/y', $results[$i][3]), 'm/d/y'); 
                $closeDate = strtotime($closeDate); //change format of date to use strtotime()
                if ($closeDate !== $nearestDate) {
                    unset($results[$i]);
                }
            }
            //re-indexing the values in $results
            $results = array_values($results);
        }
    //

    // Displaying search results
        echo "<h1>Job Vacancy Information</h1>";
        echo "<p style = 'color: #555555;'><strong>Your search:</strong> " . $searchTitle . "</p>";
        if (empty($results)) {
            echo "<p>No matching job vacancies found! <span>&#128531;</span></p>";
        } else { 
            if (count($results) == 1) {
                echo "<p>There is <strong>" . count($results) . "</strong> job vacancy found!</p><br><br>";
            } else {
                echo "<p>There are <strong>" . count($results) . "</strong> job vacancies found!</p><br><br>";
            }
            foreach ($results as $result) {
                //Initializing Application-type (since numerous checkboxes can be picked)
                $application = "";
                if ($result[6] == "Yes" && $result[7] == "Yes") {
                    $application = "Post & Email";
                } elseif ($result[6] == "Yes") {
                    $application = "Post";
                } elseif ($result[7] == "Yes") {
                    $application = "Email";
                }

                echo "
                    <table>
                        <tr>
                            <th>Job Title</th>
                            <th>Description</th>
                            <th>Closing Date</th>
                            <th>Position</th>
                            <th>Contract</th>
                            <th>Application</th>
                            <th>Location</th>
                        </tr>
                        <tr>
                            <td> " . $result[1] . "</td>
                            <td> " . $result[2] . "</td>
                            <td> " . $result[3] . "</td>
                            <td> " . $result[4] . "</td>
                            <td> " . $result[5] . "</td>
                            <td> " . $application . "</td>
                            <td> " . $result[8] . "</td>
                        </tr>
                    </table>
                    <br><br>
                ";
            }
        }
    //

    // Display links to return to Home page and Search Job Vacancy page
        echo "<p>Return to our <a href='searchjobform.php'>Search Job Vacancy</a> Page</p>";
        echo "<p>Return to <a href='index.php'>Home Page</a></p>";
    //
        ?>
    </body>
</html>