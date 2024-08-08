<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="author" content="Tran Quoc Dung" />
<title>Add member page</title>
</head>
<body>
<h1>Add New Member Form</h1>
    <form action="member_add.php" method="post">
        <label for="fname">First Name:</label>
        <input type="text" name="fname" id="fname" placeholder = "Enter your first name here..." required></br>

        <label for="lname">Last Name:</label>
        <input type="text" name="lname" id="lname" placeholder = "Enter your last name here..." required></br>
        
        <label for="gender">Gender:</label>
        <input type="text" name="gender" id="gender" placeholder = "Enter your first gender here (M/F)" required></br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email"  placeholder = "Enter your email here..." required></br>
        
        <label for="phone">Phone:</label>
        <input type="text" name="phone" id="phone" placeholder = "Enter your phone number here..." required></br>
        
        <input type="submit" value="Add Member">
</form>
</body>
</html>
