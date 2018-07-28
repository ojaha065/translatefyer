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

    $text = $_POST["sourceText"];
    $target = "en";

    $result = $translate->translate($text,[
        "target" => $target
    ]);

    echo json_encode($result);
?>