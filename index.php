<?php
    session_start();
    $_SESSION["secretKey"] = "[HIDDEN FOR GITHUB]";
?>

<!DOCTYPE html>
<html lang="en">
    <!--
        (C) Jani Haiko, 2018
        https://github.com/ojaha065/translatefyer
    -->
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <title>Google translatefyer</title>
        <meta name="keywords" content="translatefyer,translate,translation,machine translation,Google Translate" />
        <meta name="description" content="Run texts throught multiple layers of machine translation." />
        <meta name="author" content="Jani Haiko, ojaha065@edu.xamk.fi" />
        <meta name="revised" content="Sunday, August 12th, 2018" />
        <meta name="rating" content="General" />
        <link rel="stylesheet" href="styles.css" type="text/css" media="all" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="languageCodes.js" async></script>
        <script src="scripts.js"></script>
    </head>
    <body>
        <div id="info">
        <h1>Welcome to Translatefyer</h1>
            <noscript>Please allow JavaScript on this page.</noscript>
            <p><b>What is Translatefyer?</b> Translatefyer runs texts throught multiple layers of Google's machine translation. As you know, Google Translate often returns hilarious results. We just take it a step further by running the input throught Google Translator multiple times and switching languages between.</p>
            <p><b>But why?</b> I dunno, for fun, I guess? This project was heavily inspired by the popular <a href="https://www.youtube.com/watch?v=957K58gMbPA" target="_blank">Google Translate Sings</a> videos by the YouTube channel <a href="https://www.youtube.com/channel/UCP2-S6-M9ZvlY8t7cRn4O6A" target="_blank">Translator fails</a>.</p>
            <p><b>How does it work?</b> It's just using <a href="https://cloud.google.com/translate/" target="_blank">Google's translation API</a>. For more technical details, you can check it's <a href="https://github.com/ojaha065/translatefyer" target="_blank">GitHub page</a>.</p>
            <p><b>How is/are behind this? I want to contact you. How I can do that?</b> I'm just a IT-student from Finland. Feel free to to shoot me an email: haiko.jani [at] gmail [dot] com.</p>
        </div>
        <textarea id="sourceText" maxlength="1200" placeholder="Type or paste here." required></textarea>
        <small id="errorArea"></small>
        <small>Tip: The input can be in almost any language. The result will be in the same language. (Providing that Google detected the language correctly.)</small>
        <textarea id="resultText" placeholder="The translatefyed text will be here." readonly></textarea>    
        <small id="languages_wrapper">The input went throught following translations: <span id="languages"></span></small>
        <div id="buttons">
            <button type="button" id="translatefyButton">Translatefy!</button>
            <button type="reset" id="clearButton">Clear</button>
        </div>
        <div id="settings">
            <form>
                <fieldset>
                    <legend>Settings</legend>
                    <label for="iterations">Iterations:</label>
                    <select id="iterations">
                        <option value="3" selected>3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                    <small>Translation from language X to Y = one iteration. Recommended values are from 3 to 5. The larger the value is, the longer the translatefying process will take.</small>
                    <br />
                    <small><a href="login/index.php">Manage</a></small>
                </fieldset>
            </form>
        </div>
        <a href="https://github.com/ojaha065/translatefyer" target="_blank"><img id="github" src="https://s3.amazonaws.com/github/ribbons/forkme_right_green_007200.png" alt="Fork me on GitHub" /></a>
    </body>
    <!--
        *Notices your source*
        OwO What's this?
    -->
</html>