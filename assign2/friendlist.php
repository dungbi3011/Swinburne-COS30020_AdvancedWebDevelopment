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
    echo "<p class = 'friendlist_database'>Cannot connect to database.</p>";
}

// create function to remove a friend and update number of friends 
function unfriend ($friend_id, $conn, $email)
{
    // Check if friends has been delete
    $sql = "SELECT friend_id2 FROM myfriends 
           WHERE friend_id1 = (SELECT friend_id FROM friends WHERE friend_email = '$email')
           AND friend_id2 = '$friend_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 1) {
        // Remove the friend from the user's friend list
        $unfriendSQL1 = "DELETE FROM myfriends 
                        WHERE friend_id1 = '$friend_id' AND friend_id2 = (SELECT friend_id FROM friends WHERE friend_email = '$email')";
        $unfriendResult = mysqli_query($conn, $unfriendSQL1);
        $unfriendSQL2 = "DELETE FROM myfriends 
                        WHERE friend_id1 = (SELECT friend_id FROM friends WHERE friend_email = '$email') AND friend_id2 = '$friend_id'";
        $unfriendResult = mysqli_query($conn, $unfriendSQL2);

        //Count friends of a user
        $countFriendSQL = "SELECT COUNT(*) AS num_of_friends
                        FROM myfriends 
                        WHERE friend_id1 = (SELECT friend_id FROM friends WHERE friend_email = '$email')";
        $resultCountFriend = mysqli_query($conn, $countFriendSQL);
        $row = mysqli_fetch_assoc($resultCountFriend);
        $numOfFriends = (int)$row["num_of_friends"];

        if ($unfriendResult) {
            // Update number of friends for the current user
            $updateNumOfFriendsSQL = "UPDATE friends SET num_of_friends = $numOfFriends 
                                    WHERE friend_email = '$email'";
            $resultUpdateNumOfFriends = mysqli_query($conn, $updateNumOfFriendsSQL);
            echo "<p style = 'color: green;'>Deleting friend successfully!</p>";
            if (!$resultUpdateNumOfFriends) {
                echo "<p class = 'friendlist_database'>Cannot update the number of friends now.</p>";
            }
        } else {
            echo "<p class = 'friendlist_database'>Cannot unfriend now.</p>";
        }
    }
}

// Implementations when "Unfriend" button is pressed
if (isset($_POST["unfriend"])) {
    $friend_id_to_remove = $_POST["friend_id"];
    unfriend($friend_id_to_remove, $conn, $_SESSION["friend_email"]);
}

$email = $_SESSION["friend_email"];

// Count current number of friends of a user
$countFriendSQL = "SELECT COUNT(*) AS num_of_friends FROM myfriends 
                WHERE friend_id1 = (SELECT friend_id FROM friends WHERE friend_email = '$email')";
$resultCountFriend = mysqli_query($conn, $countFriendSQL);
$row = mysqli_fetch_assoc($resultCountFriend);
$numOfFriends = (int)$row["num_of_friends"]; //current number of friends

//Update current number of friends
$updateNumOfFriendsSQL = "UPDATE friends SET num_of_friends = $numOfFriends 
                            WHERE friend_email = '$email'";
$resultUpdateNumOfFriends = mysqli_query($conn, $updateNumOfFriendsSQL);
if (!$resultUpdateNumOfFriends) {
    echo "<p class = 'friendlist_database'>Cannot update the number of friends now.</p>";
}

// Display friendlist for user
$sql = "SELECT DISTINCT * FROM friends AS f
        INNER JOIN myfriends AS mf ON f.friend_id = mf.friend_id2
        WHERE mf.friend_id1 = (SELECT friend_id FROM friends WHERE friend_email = '$email')
        ORDER BY f.profile_name ASC";
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo "<p class = 'friendlist_database'>Cannot update friendlist now.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name = "description" content  ="Assignment 2">
        <meta name = "keywords" content = "Web,programming">
        <meta name = "author" content = "Tran Quoc Dung">
        <meta name = "studentid" content = "103808391">
        <title>Friend List</title>
        <link rel = "stylesheet" href = "style.css">
    </head>

    <body>
        <div class = "friendlist">
            <h1>My Friend System</h1>
            <h2><?php echo $_SESSION["profile_name"];?>'s Friend List Page</h2>
            <h3>Total number of friends is <?php echo $numOfFriends; ?></h3>
            <table>
                <thead>
                    <?php if (mysqli_num_rows($result) !== 0) {
                        echo "
                            <tr>
                                <th>Profile Name</th>
                                <th>Action</th>
                            </tr>";}
                    ?>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?php echo $row["profile_name"]; ?></td>
                            <td>
                                <form action="friendlist.php" method="post">
                                    <!-- illustrating friend_id of a friend in friendlist -->
                                    <input type = "hidden" name = "friend_id" value = "<?php echo $row["friend_id"];?>"> 
                                    <input type = "submit" name = "unfriend" value = "Unfriend"> 
                                </form>  
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <p class = 'references'><a href="friendadd.php">Add Friends</a></p>
            <p class = 'references'><a href="index.php">Home Page</a></p>
            <p class = 'references'><a href="logout.php">Log Out</a></p>
        </div>
    </body>
</html>

