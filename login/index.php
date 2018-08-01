<?php
    require_once "config/config.php";
    if($forceHTTPS){
        forceHTTPS();
    }

    session_start();

    if(!isset($_SESSION["username"])){
        header("location: login.php");
        die();
    }
    if(!isset($_SESSION["lastActivity"]) || time() - $_SESSION["lastActivity"] > $timeout){
        session_unset();
        session_destroy();
        header("location: login.php?returnCode=timeout");
        die();
    }
    else{
        $_SESSION["lastActivity"] = time();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <!--
        Simple PHP registration and login system
        https://github.com/ojaha065/simplePHPLoginSystem
        (C) Jani Haiko, 2018
    -->
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <title>Settings | Translatefyer</title>
    </head>
    <body>
        <?php
            echo "<h1>Welcome, ",$_SESSION['username'],"</h1>";
            if($debugMode === "IKnowWhatIAmDoing"){
                echo "<br /><strong>Warning, the debug mode is ON</strong>";
            }
        ?>
        <p>Settings page will be here.</p>
        <a href="account.php">Open account management page</a>
        <br />
        <a href="admin/index.php">Open admin panel (for the login system)</a>
        <br />
        <a href="utils/logout.php">Logout</a>
    </body>

    <!--
        *Notices your source*
        OwO What's this?
    -->
</html>