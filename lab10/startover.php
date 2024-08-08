<?php
    require_once("hitcounter.php");  
    require_once("../../data/lab10/mykeys.inc.php");

    $Counter = new HitCounter($host, $user, $pswd, $dbnm, 'hitcounter');
    $Counter->startOver(); 
    $Counter->closeConnection();
    header("Location: countvisits.php");
?>

