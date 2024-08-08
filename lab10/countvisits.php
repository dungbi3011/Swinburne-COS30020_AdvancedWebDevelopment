<?php
    require_once("hitcounter.php");
    require_once("../../data/lab10/mykeys.inc.php");

    $hitcounter = new HitCounter($host, $user, $pswd, $dbnm , "hitcounter");

    $hits = $hitcounter->getHits();
    $newHits = $hits + 1; 
    $hitcounter->setHits($newHits);
    $hitcounter->closeConnection();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="description" content="Web application development" />
        <meta name="keywords" content="PHP" />
        <meta name="author" content="Tran Quoc Dung" />
        <title>Lab 10</title>
    </head>

    <body>
        <h1>Hit Counter</h1>
        <p>This page has received <strong><?php echo $hits; ?></strong> hits.</p>
        <form action="startover.php" method="post">
            <input type="submit" value="Start over"> 
        </form>
    </body>
</html>

