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
        <form action = "shoppingsave.php" method = "post">
        <label for="item">Item: </label>
        <input type="text" name="item" id="item" placeholder="Enter the item here...">
        <br>
        <label for="quantity">Quantity: </label>
        <input type="number" name="quantity" id="quantity" placeholder="Enter the quantity here..."><br>
        <button type="submit">Submit</button>
    </body>
</html>