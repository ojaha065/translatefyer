"use strict";

/*
    (C) Jani Haiko, 2018
*/

$(document).ready(function(){
    $("#translatefyButton").click(function(){
        $(this).prop("disabled",true);
        var sourceText = $("#sourceText").val();

        $.ajax({
            method: "POST",
            url: "getTranslation.php",
            data: {
                sourceText: sourceText
            },
            success: function(result){
                console.info("Got result!");
                $("#resultText").val(result);
                $(this).prop("disabled",false);
            },
            error: function(error){
                console.error(error.status + ": " + error.statusText);
                $(this).prop("disabled",false);
            }
        });
    });
    $("#clearButton").click(function(){
        $("#sourceText").val("");
        $("#resultText").val("");
    });
});