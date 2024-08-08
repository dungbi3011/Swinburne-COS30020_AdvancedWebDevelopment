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
        <h1>Web Programming Form - Lab 6</h1>
        <form action = "guestbooksave.php" method = "post">
            <hr/>
            <fieldset>
                <legend><strong>Enter your details to sign our guest book</strong></legend>
                <label for="name">Name: </label>
                <input type="text" name="name" id="name" placeholder="Enter your name here..."><br>
                <label for="email">E-mail: </label>
                <input type="text" name="email" id="email" placeholder="Enter the email here..."><br>
                <button type="submit">Submit</button>
            </fieldset>

            <a href = "guestbookshow.php">Show Guest Book</a>
        </form>
    </body>
</html>