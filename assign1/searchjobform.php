<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Assignment 1">
        <meta name="keywords" content="Web, programming">
        <meta name="author" content="Tran Quoc Dung">
        <title>Search Job Form</title>
        <link rel="stylesheet" href="styles/searchjobform.css">
    </head>

    <body>
        <h1>Job Vacancy Posting System</h1>
        <form action="searchjobprocess.php" method="GET">
            <p>
                <label>Job Title*:</label>
                <input type="text" name="title" placeholder = "Enter the Title here..." required> 
            </p>

            <p>
                <label>Position:</label>
                <input type="radio" id="fullTime" name="position" value="Full Time">
                <label for="fullTime">Full Time</label>
                <input type="radio" id="partTime" name="position" value="Part Time">
                <label for="partTime">Part Time</label>
            </p>

            <p>
                <label>Contract:</label>
                <input type="radio" id="ongoing" name="contract" value="On-going">
                <label for="ongoing">On-going</label>
                <input type="radio" id="fixedterm" name="contract" value="Fixed Term">
                <label for="fixedterm">Fixed Term</label>
            </p>

            <p>
                <label>Application by:</label>
                <label><input type="checkbox" name="application[]" value="Post">Post</label>  
                <label><input type="checkbox" name="application[]" value="Email">Email</label>
            </p>

            <p>
                <label>Location:</label>
                <select name="location">
                    <option value="">---</option>
                    <option value="ACT">ACT</option>
                    <option value="NSW">NSW</option>
                    <option value="NT">NT</option>
                    <option value="QLD">QLD</option>
                    <option value="SA">SA</option>
                    <option value="TAS">TAS</option>
                    <option value="VIC">VIC</option>
                    <option value="WA">WA</option>
                </select>
            </p>

            <input type="submit" name="searchform" value="Search">
        </form>
        <p>Return to <a href="index.php">Home Page</a></p>
    </body>

</html>
