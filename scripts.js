"use strict";

/*
    (C) Jani Haiko, 2018
*/

$(document).ready(function(){
    $("#translatefyButton").click(function(){
        var sourceText = $("#sourceText").val();

        $.ajax({
            method: "POST",
            url: "getTranslation.php",
            data: {
                sourceText: sourceText
            },
            success: function(result){
                console.log(result);
            },
            error: function(error){
                console.error(error.status + ": " + error.statusText);
            }
        });
    });
});