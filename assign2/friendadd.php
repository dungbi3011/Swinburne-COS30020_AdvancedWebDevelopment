<?php
// If a user has logged in, start the session
session_start();
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    header("Location: login.php");
    exit;
}

// Database connection
require_once("setting.php");
$conn = mysqli_connect($host, $user, $pswd, $dbnm);
if (!$conn) {
    echo "<p class = 'friendadd_database'>Cannot connect to database.</p>";
}

// create function to add a friend & update number of friends
function addfriend ($friend_id, $conn, $email)
{
    // Check if friends has been added
    $sql = "SELECT friend_id2 FROM myfriends 
           WHERE friend_id1 = (SELECT friend_id FROM friends WHERE friend_email = '$email')
           AND friend_id2 = '$friend_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        // Add a friend from the user's friend list (2 INSERT lines for friendship between 2 users)
        $addfriendSQL1 = "INSERT INTO myfriends (friend_id1, friend_id2) 
                        VALUES ('$friend_id', (SELECT friend_id FROM friends WHERE friend_email = '$email'))";
        $addfriendResult = mysqli_query($conn, $addfriendSQL1);
        $addfriendSQL2 = "INSERT INTO myfriends (friend_id1, friend_id2) 
                        VALUES ((SELECT friend_id FROM friends WHERE friend_email = '$email'), '$friend_id')";
        $addfriendResult = mysqli_query($conn, $addfriendSQL2);

        //Count friends of a user
        $countFriendSQL = "SELECT COUNT(*) AS num_of_friends
                        FROM myfriends 
                        WHERE friend_id1 = (SELECT friend_id FROM friends WHERE friend_email = '$email')";
        $resultCountFriend = mysqli_query($conn, $countFriendSQL);
        $row = mysqli_fetch_assoc($resultCountFriend);
        $numOfFriends = (int)$row["num_of_friends"];

        if ($addfriendResult) {
            // Update number of friends for the current user
            $updateNumOfFriendsSQL = "UPDATE friends SET num_of_friends = $numOfFriends 
                                    WHERE friend_email = '$email'";
            $resultUpdateNumOfFriends = mysqli_query($conn, $updateNumOfFriendsSQL);
            echo "<p style = 'color: green;'>Adding friend successfully!</p>";
            if (!$resultUpdateNumOfFriends) {
                echo "<p class = 'friendadd_database'>Cannot update the number of friends now.</p>";
            }
        } else {
            echo "<p class = 'friendadd_database'>Cannot add friend now.</p>";
        }
    }
}

function mutualFriend ($friend_id, $conn, $email) {
    //SQL statement 
    $sql = "SELECT COUNT(*) AS num_of_mutual_friends
        FROM myfriends AS mf1
        JOIN myfriends AS mf2 ON mf1.friend_id2 = mf2.friend_id1
        WHERE mf1.friend_id1 = (SELECT friend_id FROM friends WHERE friend_email = '$email')
        AND mf2.friend_id2 = '$friend_id'";
    $resultMutualFriends = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($resultMutualFriends);
    $numOfMutualFriends = (int)$row["num_of_mutual_friends"];
    if ($numOfMutualFriends !== 1) {
        echo "$numOfMutualFriends mutual friends";
    } else {
        echo "$numOfMutualFriends mutual friend";
    }
}

// Implementations when "Add as friend" button is pressed
if (isset($_POST["addfriend"])) {
    $friend_id_to_add = $_POST["friend_id"];
    addfriend($friend_id_to_add, $conn, $_SESSION["friend_email"]);
}

$email = $_SESSION["friend_email"];

// Count & update current number of friends of a user
$countFriendSQL = "SELECT COUNT(*) AS num_of_friends
                FROM myfriends 
                WHERE friend_id1 = (SELECT friend_id FROM friends WHERE friend_email = '$email')";
$resultCountFriend = mysqli_query($conn, $countFriendSQL);
$row = mysqli_fetch_assoc($resultCountFriend);
$numOfFriends = (int)$row["num_of_friends"];

//Update current number of friends
$updateNumOfFriendsSQL = "UPDATE friends SET num_of_friends = $numOfFriends 
                            WHERE friend_email = '$email'";
$resultUpdateNumOfFriends = mysqli_query($conn, $updateNumOfFriendsSQL);
if (!$resultUpdateNumOfFriends) {
    echo "<p class = 'friendlist_database'>Cannot update the number of friends now.</p>";
}

// Enable Pagination
// for counting number of selected rows
$sql = "SELECT DISTINCT * FROM friends as f
        WHERE f.friend_email <> '$email'
        AND NOT EXISTS (
            SELECT 1 FROM myfriends as mf
            WHERE mf.friend_id1 = (SELECT friend_id FROM friends WHERE friend_email = '$email')
            AND mf.friend_id2 = f.friend_id)
        ORDER BY f.profile_name ASC";
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "<p class = 'friendadd_database'>Cannot display friends now.</p>";
}
$numberOfResults = mysqli_num_rows($result);
$numberOfResultsPerPage = 5; //limit 5 names per page
$numberOfPages = ceil ($numberOfResults / $numberOfResultsPerPage);
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}
// Calculate the SQL LIMIT starting number for the results on the displaying page
$firstResultOfPage = ($page - 1) * $numberOfResultsPerPage;

// Display friends who have not been added
$sql = "SELECT DISTINCT * FROM friends as f
        WHERE f.friend_email <> '$email'
        AND NOT EXISTS (
            SELECT 1 FROM myfriends as mf
            WHERE mf.friend_id1 = (SELECT friend_id FROM friends WHERE friend_email = '$email')
            AND mf.friend_id2 = f.friend_id)
        ORDER BY f.profile_name ASC
        LIMIT " . $firstResultOfPage . "," . $numberOfResultsPerPage;
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "<p class = 'friendadd_database'>Cannot display friends now.</p>";
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name = "description" content  ="Assignment 2">
        <meta name = "keywords" content = "Web, programming">
        <meta name = "author" content = "Tran Quoc Dung">
        <meta name = "studentid" content = "103808391">
        <title>Add Friend List</title>
        <link rel = "stylesheet" href = "style.css">
    </head>

    <body>
        <div class = "friendadd">
            <h1>My Friend System</h1>
            <h2><?php echo $_SESSION["profile_name"];?>'s Add Friend Page</h2>
            <h3>Total number of friends is <?php echo $numOfFriends; ?></h3>
            <table>
                <thead>
                    <?php if (mysqli_num_rows($result) !== 0) {
                        echo "
                            <tr>
                                <th>Profile Name</th>
                                <th>Mutual Friends</th>
                                <th>Action</th>
                            </tr>";
                        }
                    ?>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr>
                        <td><?php echo $row["profile_name"]; ?></td>
                        <td>
                            <?php mutualFriend($row["friend_id"], $conn, $_SESSION["friend_email"]); ?>
                        </td>
                        <td>
                            <form action="friendadd.php" method="post">
                                <input type="hidden" name="friend_id" value="<?php echo $row["friend_id"]; ?>">
                                <input type="submit" name = "addfriend" value="Add as Friend">
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
                <br>
                <!-- Pagination Display -->
                <?php
                    if ($page > 1) {
                        echo "<a style = 'float: left;' href='friendadd.php?page=" . ($page - 1) . "'>Previous</a> ";
                    }
                    
                    if ($page < $numberOfPages) {
                        echo "<a style = 'float: right;' href='friendadd.php?page=" . ($page + 1) . "'>Next</a>";
                    }
                ?>
            </table>
            
            <p class = "references"><a href="friendlist.php">Friend List</a></p>
            <p class = 'references'><a href="index.php">Home Page</a></p>
            <p class = "references"><a href="logout.php">Log Out</a></p>
        </div>
    </body>
</html>

