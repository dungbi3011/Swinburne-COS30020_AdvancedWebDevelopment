<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Assignment 1">
        <meta name="keywords" content="Web, programming">
        <meta name="author" content="Tran Quoc Dung">
        <title>About Page</title>
        <link rel="stylesheet" href="styles/about.css">
    </head>

    <body>
        <h1>About this assignment</h1>      
        <?php
            $phpVersion = phpversion();
            //Req.1
            echo "<figure>";
            echo "<figcaption><p>Req.1 (Answering the questions):</p></figcaption>";
            echo "<ol>";
            echo "<li><p>PHP version: $phpVersion</p></li>";
            echo "<li><p>Based on the marking scheme, my website's looks quite simple & monotonic. <br>However, I have completed all the requirements including advanced requirements (task 7 & 8).</p></li>";
            echo "<li>
                    <p>Special features: (sample shown below)<br>
                        <ul>
                            <li>Searching form includes other (optional) criterias for searching.</li><br>
                            <li>Job vacancies with bygone Closing Dates are not showned, webpage displays jobs with nearest Closing Dates only.</li><br>
                            <li>Searching Form also displays searching keywords & number of matching job vacancies found.<br><br>
                            <img src='style/advanced.png' alt='Additional_Features_image'></li>
                        </ul>
                    </p>
                </li>";           
            echo "</ol>";
            echo "</figure>";

            //Req.2
            echo "<figure>";
            echo "<figcaption><p>Req.2 (Discussion board Participation):</p></figcaption>";
            echo "<img src='style/discussion_board.png' alt='Discussion_Board_image'>";
            echo "</figure>";
        ?>
        <p>Return to <a href="index.php">Home Page</a></p>
    </body>
</html>
