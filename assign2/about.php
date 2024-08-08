<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name = "description" content = "Assignment 2">
        <meta name = "keywords" content = "Web,programming">
        <meta name = "author" content = "Tran Quoc Dung">
        <meta name = "studentid" content = "103803891">
        <title>About Page</title>
        <link rel = "stylesheet" href = "style.css">
    </head>
    <body>
        <div class="about">
            <h1>My Friend System</h1>
            <h2>About Page</h2>
            <!-- Req.1 -->
            <figure>
                <figcaption><p>Requirement 1 (Answering the questions):</p></figcaption>
                <ol>
                    <li><p>I have completed all the requirements based on the standard criterias, including Extra Challenges (task 8 & 9).</p></li>
                    <li>
                        <p>Special features: <br>
                        <ul>
                            <li>After signing up for an account, the number of friends will be automatically set as 0.</li>
                            <li>After logging in an account, the Friendlist page will automatically update the current number of friends in the database based on their actual number of friends.</li>
                            <li>"Home Page" button is also provided to access the Home Page, also in case users do not want to sign out their accounts.</li>
                            <li>Friendlist & Friendadd page display current number of friends for current user.</li>
                            <li>After you add or delete a friend, the other friend's friendlist will also add or delete yourself.</li>
                            <li>Friendadd Page includes pagination for clear and user-friendly interface.</li>
                            <li>Friendadd Page display number of mutual friends to current user.</li>
                        </ul>
                        <br>
                        <img src='images/features.png' alt='Additional_Features Image'></li></p>
                    </li>     
                    <li><p>Honestly, I had some coding trouble with the Friendlist & Friendadd pages at first, since the requirements of these 2 pages are quite unclear.<br>
                    However, after diving the tasks into several simple subtasks, I had managed to write the backend codes in order to implement the requirements.</p></li>
                    <li>
                        <p>For improvements: <br>
                        <ul>
                            <li>Password should also be hashed in the database table, which will prevent many of security problems.</li>
                            <li>PHP code is still quite long and complicated, which might lead to longer execute runtime<br>
                            If there are second chances and more time provided, I would like to simplize my code with some more fast algorithms and implementations.</li>  
                        </ul>
                    </li>  
                </ol>
            </figure>

            <!-- Req.2 -->
            <figure>
                <figcaption><p>Requirement 2 (Discussion Participation):</p></figcaption>
                <img src='images/discussion_board.png' alt='Discussion_Board_image'>
            </figure>

            <p class = 'references'><a href="friendadd.php">Add Friends</a></p>
            <p class = 'references'><a href="index.php">Home Page</a></p>
            <p class = 'references'><a href="logout.php">Log Out</a></p>
        </div>
    </body>
</html>
