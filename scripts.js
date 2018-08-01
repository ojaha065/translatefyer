"use strict";

/*
    (C) Jani Haiko, 2018
*/

if(location.protocol != "https:"){
    location.replace("https:" + window.location.href.substring(window.location.protocol.length));
}

$(document).ready(function(){
    $("#translatefyButton").click(function(){
        $(this).prop("disabled",true);
        $(this).html("Please wait...");
        var sourceText = $("#sourceText").val();
        var iterations = Number($("#iterations").val());

        $.ajax({
            method: "POST",
            url: "getTranslation.php",
            data: {
                sourceText: sourceText,
                iterations: iterations
            },
            success: function(result){
                console.info("Got result!");
                $("#resultText").val(result);
                $("#translatefyButton").html("Translatefy!");
                $("#translatefyButton").prop("disabled",false);
            },
            error: function(error){
                console.error(error.status + ": " + error.statusText);
                $("#translatefyButton").html("Translatefy!");
                $("#translatefyButton").prop("disabled",false);
            }
        });
    });
    $("#clearButton").click(function(){
        $("#sourceText").val("");
        $("#resultText").val("");
    });

    $("#sourceText").on("change keyup paste",function(){
        if($(this).val().length > 1100){
            $("#errorArea").html("Maximum length of the input is 1200 characters. You have used " + $("#sourceText").val().length + " characters.<br />").show();
        }
        else{
            $("#errorArea").hide();
        }
    });
});