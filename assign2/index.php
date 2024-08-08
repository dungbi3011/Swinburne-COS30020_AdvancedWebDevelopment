<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name = "description" content = "Assignment 2">
        <meta name = "keywords" content = "Web,programming">
        <meta name = "author" content = "Tran Quoc Dung">
        <meta name = "studentid" content = "103803891">
        <title>Home Page</title>
        <link rel = "stylesheet" href = "style.css">
    </head>

    <body>
        <!-- Home Page -->
        <div class="index_info">
            <h1>My Friend System</h1>
            <h2>Assignment Home Page</h2><br>
            <p>Name: Tran Quoc Dung</p>
            <p>Student ID: 103803891</p>
            <p>Email: 103803891@student.swin.edu.au</p>
            <p>I declare that this assignment is my individual work. I have not worked collaboratively nor have I copied from any other student’s work or from any other source.</p>
        </div>
        <div class="index_nav">
            <a href="signup.php">Sign Up</a>
            <a href="login.php">Log In</a>
            <a href="about.php">About</a>
        </div>
        <br>
    </body>
</html>


<?php
    require_once('setting.php');
 
    $conn = mysqli_connect($host, $user, $pswd, $dbnm);
    //Connect to database
    if (!$conn) {
        echo "<p class = 'index_database' style = 'color: red;'>Cannot connect to database.</p>";
    } else {
        echo "<p class = 'index_database' style = 'color: green;'>Database connected successfully!</p>";
    }

    //Create table `friends` if not exists
    $createTableSQL = "CREATE TABLE IF NOT EXISTS friends (
        friend_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        friend_email VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(20) NOT NULL,
        profile_name VARCHAR(30) NOT NULL,
        date_started DATE NOT NULL,
        num_of_friends INT UNSIGNED)";
    $createResult1 = mysqli_query($conn, $createTableSQL);
    if (!$createResult1) {
        echo "<p class = 'index_database' style = 'color: red;'>Cannot create table `friends`.</p>";
    } 

    //Create table `myfriends` if not exists
    $createTableSQL = "CREATE TABLE IF NOT EXISTS myfriends (
        friend_id1 INT NOT NULL,
        friend_id2 INT NOT NULL,
        FOREIGN KEY (friend_id1) REFERENCES friends(friend_id),
        FOREIGN KEY (friend_id2) REFERENCES friends(friend_id),
        CHECK (friend_id1 != friend_id2))
        ";
    $createResult2 = mysqli_query($conn, $createTableSQL);
    if (!$createResult2) {
        echo "<p class = 'index_database' style = 'color: red;'>Cannot create table `friends`.</p>";
    }
    
    
    //Insert data into table `friends`
    $friendsRow = mysqli_query ($conn, "SELECT * FROM friends"); 
    $insertResult1 = false;
    if ($friendsRow->num_rows == 0) {
        $insertDataSQL = "INSERT INTO friends (friend_email, password, profile_name, date_started, num_of_friends)
        VALUES
            ('phungkimhung@gmail.com', 'password', 'PhungKimHung', '2015-11-5', 17),
            ('nguyenquanghuy@gmail.com', 'password', 'TheWantedX', '2015-02-28', 14),
            ('nguyenthanhquan@gmail.com', 'password', 'QuanBox', '2013-03-02', 22),
            ('luuquangtung@gmail.com', 'password', 'WangTung', '2014-07-07', 15),
            ('maivuhoanglam@gmail.com', 'password', 'LamSamSet', '2017-09-02', 13),
            ('phamhoangduong@gmail.com', 'password', 'HoangDuong', '2018-04-26', 8),
            ('phamtrunghieu@gmail.com', 'password', 'HieuPC', '2020-10-24', 5),
            ('nguyenquangminh@gmail.com', 'password', 'MinhMit', '2017-08-16', 10),
            ('nguyenminhtuan@gmail.com', 'password', 'TuanTienTy', '2013-04-04', 19),
            ('trantunglam@gmail.com', 'password', 'TungLam', '2018-12-24', 5)
        ";
        $insertResult1 = @mysqli_query($conn, $insertDataSQL);
        if (!$insertResult1) {
            echo "<p class = 'index_database' style = 'color: red;'>Unable to insert data into `friends`.</p>". mysqli_error($conn);
        } 
    } else {
        $insertResult1 = true;
    }

    //Insert data into table `myfriends`
    $myfriendsRow = mysqli_query ($conn, "SELECT * FROM myfriends"); 
    $insertResult2 = false;
    if ($myfriendsRow->num_rows == 0) {
        $insertDataSQL = "INSERT INTO myfriends (friend_id1, friend_id2) 
        VALUES
            (1, 2),
            (1, 3),
            (1, 4),
            (1, 5),
            (2, 1),
            (3, 1),
            (4, 1),
            (5, 1),
            (2, 3),
            (3, 2),
            (2, 4),
            (4, 2),
            (2, 5),
            (5, 2),
            (3, 4),
            (4, 3),
            (3, 5),
            (5, 3),
            (4, 5),
            (5, 4),
            (7, 5),
            (5, 7),
            (1, 7),
            (7, 1),
            (9, 8),
            (8, 9),
            (5, 9),
            (9, 5),
            (5, 8),
            (8, 5),
            (2, 10),
            (10, 2),
            (6, 9),
            (9, 6),
            (10, 7),
            (7, 10),
            (4, 7),
            (7, 4),
            (3, 7),
            (7, 3)
        ";
        $insertResult2 = @mysqli_query($conn, $insertDataSQL);
        if (!$insertResult2) {
            echo "<p class = 'index_database' style = 'color: red;'>Unable to insert data into `myfriends`.</p>". mysqli_error($conn);
        } 
    } else {
        $insertResult2 = true;
    }

    //Display the success or failure in creating two tables and records insertion
    if ($createResult1 && $createResult2 && $insertResult1 && $insertResult2) {
        echo "<p class = 'index_database' style = 'color: green;'>Tables successfully created and populated!</p>";
    }
?>

