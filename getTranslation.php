<?php
    /*
        (C) Jani Haiko, 2018
    */

    session_start();

    header("Content-Type: application/json;charset=UTF-8");
    $dataToSend = array();

    if(!isset($_SESSION["secretKey"]) && $_SESSION["secretKey"] == "[HIDDEN FOR GITHUB]"){
        $dataToSend["code"] = 403;
        $dataToSend["status"] = "Forbidden";
        $dataToSend["reason"] = "Invalid secretKey";
        echo json_encode($dataToSend);
        die();
    }
    if(!isset($_SERVER["HTTP_X_REQUESTED_WITH"]) || strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) != "xmlhttprequest"){
        $dataToSend["code"] = 400;
        $dataToSend["status"] = "Bad Request";
        $dataToSend["reason"] = "Wrong HTTP_X_REQUESTED_WITH";
        echo json_encode($dataToSend);
        die();
    }
    if(!isset($_POST["iterations"]) || !isset($_POST["sourceText"]) || !isset($_POST["model"])){
        $dataToSend["code"] = 400;
        $dataToSend["status"] = "Bad Request";
        $dataToSend["reason"] = "Values not set";
        echo json_encode($dataToSend);
        die();
    }
    if(strlen($_POST["sourceText"]) > 1000 || $_POST["iterations"] > 4){
        $dataToSend["code"] = 413;
        $dataToSend["status"] = "Payload Too Large";
        $dataToSend["reason"] = "The input is too long";
        echo json_encode($dataToSend);
        die();
    }
    if(strlen($_POST["sourceText"]) < 5){
        $dataToSend["code"] = 400;
        $dataToSend["status"] = "Bad Request";
        $dataToSend["reason"] = "The input is too short";
        echo json_encode($dataToSend);
        die();
    }

    if(isset($_SESSION["lastRequest"])){
        if(time() - $_SESSION["lastRequest"] < 5){
            $dataToSend["code"] = 429;
            $dataToSend["status"] = "Too Many Requests";
            $dataToSend["reason"] = "You're sending too many requests";
            echo json_encode($dataToSend);
            die();
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

    $allLanguages = array();
    $allLanguages[0] = $originalLanguage;

    if($_POST["model"] === "nmt" || $_POST["model"] === "base"){
        $model = $_POST["model"];
    }
    else{
        $dataToSend["code"] = 400;
        $dataToSend["status"] = "Bad Request";
        $dataToSend["reason"] = "Wrong model";
        echo json_encode($dataToSend);
        die();
    }

    foreach($languages as $target){
        $result = $translate->translate($text,[
            "target" => $target,
            "format" => "text",
            "model" => $model
        ]);
        $text = $result["text"];
        $allLanguages[] = $target;
    }

    $dataToSend["code"] = 200;
    $dataToSend["status"] = "OK";
    $dataToSend["translation"] = $text;
    $dataToSend["languages"] = $allLanguages;
    echo json_encode($dataToSend);
?>