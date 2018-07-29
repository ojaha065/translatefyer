<?php
    /*
        (C) Jani Haiko, 2018
    */

    require "vendor/autoload.php";
    use Google\Cloud\Translate\TranslateClient;

    $projectId = "translatefyer";

    $translate = new TranslateClient([
        "projectId" => $projectId
    ]);
    $availableLanguages = $translate->languages();

    $iterations = 10;
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