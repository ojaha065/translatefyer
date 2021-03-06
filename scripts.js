"use strict";

/*
    (C) Jani Haiko, 2018 - 2019
*/

if(location.protocol != "https:"){
    location.replace("https:" + window.location.href.substring(window.location.protocol.length));
}

$(document).ready(function(){
    var translatefyButton = $("#translatefyButton");

    translatefyButton.click(function(){
        $(this).prop("disabled",true);
        $(this).html("Please wait...");
        var sourceText = $("#sourceText").val();
        var iterations = Number($("#iterations").val());
        var model = $("#model").val();

        $.ajax({
            method: "POST",
            url: "getTranslation.php",
            data: {
                sourceText: sourceText,
                iterations: iterations,
                model: model
            },
            success: function(result){
                $("#languages").html("");
                switch(result.code){
                    case 200:
                        $("#resultText").val(result.translation);
                        for(var i in result.languages){
                            var thisLanguage = "";
                            try{
                                thisLanguage = isoLangs[result.languages[i]].name;
                            }
                            catch(error){
                                thisLanguage = result.languages[i];
                            }
                            $("#languages").html($("#languages").html() + thisLanguage + " &rarr; ");
                        }
                        $("#languages").html($("#languages").html().slice(0,-3));
                        $("#languages_wrapper").show();
                        break;
                    case 429:
                        $("#resultText").val("Hey Sonic, you are going way too fast! (You're sending too many requests.)");
                        break;
                    default:
                    console.error(result.code);
                    console.info(result.reason);
                }
                translatefyButton.html("Translatefy!");
                translatefyButton.prop("disabled",false);
            },
            error: function(error){
                console.error(error.status + ": " + error.statusText);
                window.alert("An error occured. Please try again.");
                translatefyButton.html("Translatefy!");
                translatefyButton.prop("disabled",false);
            }
        });
    });
    $("#clearButton").click(function(){
        $("#sourceText").val("");
        $("#resultText").val("");
    });

    $("#sourceText").on("change keyup paste",function(){
        if($(this).val().length > 900){
            translatefyButton.prop("disabled",true);
            $("#errorArea").html("Maximum length of the input is 1000 characters. You have used " + $("#sourceText").val().length + " characters.<br />").show();
        }
        else if($(this).val().length < 5){
            translatefyButton.prop("disabled",true);
        }
        else{
            $("#errorArea").hide();
            translatefyButton.prop("disabled",false);
        }
    });
});