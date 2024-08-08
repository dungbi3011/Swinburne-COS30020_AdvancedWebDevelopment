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
        <h1>Web Programming Form - Lab 5</h1>
        <form action = "guestbooksave.php" method = "post">
            <hr/>
            <fieldset>
                <legend><strong>Enter your details to sign our guest book</strong></legend>
                <label for="fname">First Name: </label>
                <input type="text" name="fname" id="fname" placeholder="Enter your first name here..."><br>
                <label for="lname">Last Name: </label>
                <input type="text" name="lname" id="lname" placeholder="Enter the last name here..."><br>
                <button type="submit">Submit</button>
            </fieldset>

            <a href = "guestbookshow.php">Show Guest Book</a>
        </form>
    </body>
</html>