<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Assignment 1">
        <meta name="keywords" content="Web, programming">
        <meta name="author" content="Tran Quoc Dung">
        <title>Post Job Form</title>
        <link rel="stylesheet" href="styles/postjobform.css"> 
        <style>
            body {
    font-family: cursive;
    background-color: #fdf2e9;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

body h1 {
    color: #45260A;
    text-align: center;
}

form {
    background-color: #fff;
    padding: 1rem;
    border-radius: 5px;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.15);
    width: 58rem;
}

form label {
    display: inline-block;
    width: 15rem;
    font-weight: bold;
}

form input {
    font-weight: normal;
    padding: 1rem;

}

form input[type="text"], form select, form textarea {
    width: 40rem;
    padding: 0.8rem;
    border-radius: 0.5rem;
    border: 1px solid #ccc;
}

form input[type="date"] {
    border-radius: 0.5rem;
}

form input[type="submit"], form input[type="reset"] {
    background-color: #E67E22;
    color: #45260A;
    border-radius: 0.5rem;
    border: none;
    padding: 10px 20px;
    margin-top: 10px;
    font-size: 1.3rem;
    font-weight: bold;
}

form input[type="submit"]:hover,
form input[type="reset"]:hover {
    background-color: #683c16;
    color: #cf711f;
}

p {
    font-size: 1.3rem;
    text-decoration: none;
}

p a {
    color: #E67E22;
    font-weight: bold;
}

p a:hover {
    color: #cf711f;
}
        </style>
    </head>

    
    <body>
        <h1>Posting Job Vacancy</h1><br><br>
        <form action="postjobprocess.php" method="POST">
            <p>
                <label>Position ID:</label>
                <input type="text" name="posId" maxlength = "7" placeholder = "e.g. PID0001">
            </p>

            <p>
                <label>Title:</label>
                <input type="text" name="title" placeholder = "Enter the Title here...">
            </p>

            <p>
                <label>Description:</label>
                <textarea name = "desc" maxlength = "250" rows = "3" placeholder = "Enter the Description here..." style = "font-family: cursive;"></textarea>
            </p>

            <p>
                <label>Closing Date:</label>
                <input type="text" name="closeDate" maxlength = "8" placeholder = "DD/MM/YY">
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

            <input type="reset" name="reset" value="Reset">
            <input type="submit" name="submit" value="Post">

        </form>
        <br>
        <p>All fields are required.</p> 
        <p>Return to <a href="index.php">Home Page</a></p>
    </body>

</html>
