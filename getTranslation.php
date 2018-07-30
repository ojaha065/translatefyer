<?php
    /*
        (C) Jani Haiko, 2018
    */

    if(!isset($_SERVER["HTTP_X_REQUESTED_WITH"]) || strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) != "xmlhttprequest"){
        echo "Error occured: Access Denied";
        die("Access Denied");
    }
    if(!isset($_POST["iterations"]) || !isset($_POST["sourceText"])){
        echo "Error occured: valuesNotSet";
        die("valuesNotSet");
    }

    session_start();
    if(isset($_SESSION["lastRequest"])){
        if(time() - $_SESSION["lastRequest"] > 8){
            echo "Hey Sonic, you are going way too fast!&#13;&#10;&#13;&#10;(You're sending too many requests.)";
            die("tooManyRequests");
        }
        else{
            $_SESSION["lastRequest"] = time();
        }
    }
    else{
        $_SESSION["lastRequest"] = time();
    }

    require "vendor/autoload.php";
    use Google\Cloud\Translate\TranslateClient;

    $projectId = "translatefyer";

    $translate = new TranslateClient([
        "projectId" => $projectId
    ]);
    $availableLanguages = $translate->languages();

    $iterations = $_POST["iterations"];
    $languages = array();
    for($i = 0; $i < $iterations;$i++){
        $languages[$i] = $availableLanguages[rand(0,count($availableLanguages))];
    }
    
    $text = htmlspecialchars($_POST["sourceText"]);
    $originalLanguage = $translate->detectLanguage($text);
    $originalLanguage = $originalLanguage["languageCode"];
    $languages[$iterations + 1] = $originalLanguage;

    foreach($languages as $target){
        $result = $translate->translate($text,[
            "target" => $target
        ]);
        $text = $result["text"];
    }

    echo $text;
?>