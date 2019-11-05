<?php
    session_start();
    $_SESSION["secretKey"] = "[HIDDEN FOR GITHUB]";
?>

<!DOCTYPE html>
<html lang="en">
    <!--
        (C) Jani Haiko, 2018 - 2019
        https://github.com/ojaha065/translatefyer
    -->
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width,initial-scale=1.0" />
        <title>Google translatefyer</title>
        <meta name="keywords" content="translatefyer,translate,translation,machine translation,Google Translate" />
        <meta name="description" content="Run texts throught multiple layers of machine translation." />
        <meta name="author" content="Jani Haiko, ojaha065@edu.xamk.fi" />
        <meta name="revised" content="Thursday, July 4th, 2018" />
        <meta name="rating" content="General" />
        <link rel="stylesheet" href="styles.css" type="text/css" media="all" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="languageCodes.js" async></script>
        <script src="scripts.js"></script>
    </head>
    <body>
        <div class="info">
        <h1>Welcome to Translatefyer</h1>
            <noscript>Please allow JavaScript on this page.</noscript>
            <p><b>What is Translatefyer?</b> Translatefyer runs texts throught multiple layers of Google's machine translation. As you know, Google Translate often returns hilarious results. We just take it a step further by running the input throught Google Translator multiple times and switching languages between.</p>
            <p><b>But why?</b> I dunno, for fun, I guess? This project was heavily inspired by the popular <a href="https://www.youtube.com/watch?v=957K58gMbPA" target="_blank">Google Translate Sings</a> videos by the YouTube channel <a href="https://www.youtube.com/channel/UCP2-S6-M9ZvlY8t7cRn4O6A" target="_blank">Translator fails</a>.</p>
            <p><b>How does it work?</b> It's just using <a href="https://cloud.google.com/translate/" target="_blank">Google's translation API</a>. For more technical details, you can check it's <a href="https://github.com/ojaha065/translatefyer" target="_blank">GitHub page</a>.</p>
            <p><b>Who is/are behind this? I want to contact you. How I can do that?</b> I'm just a IT-student from Finland. Feel free to to shoot me an email: haiko.jani [at] gmail [dot] com.</p>
            <p id="noticeAboutLimits"><b>Update 11/2019:</b> Due to the increased pricing of Google Cloud Translation, I implemented a new limitation. Only 2000 characters can be processed per day. <strong>This limit is shared between all users</strong>. If you get an error message, please try again after 24 hrs. I'm really sorry about this, and I'm currently considering alternatives for Google Translate. (like Bing translator)</p>
        </div>
        <textarea id="sourceText" maxlength="1200" placeholder="Type or paste here." required></textarea>
        <small id="errorArea"></small>
        <small>Tip: The input can be in almost any language. The result will be in the same language. (Providing that Google detected the language correctly.)</small>
        <textarea id="resultText" placeholder="The translatefyed text will be here." readonly></textarea>    
        <small id="languages_wrapper">The input went throught following translations: <span id="languages"></span></small>
        <br />
        <div id="buttons">
            <button type="button" id="translatefyButton" disabled>Translatefy!</button>
            <button type="reset" id="clearButton">Clear</button>
        </div>
        <p id="noticeAboutLimits" class="info"><b>Update 11/2019:</b> Due to the increased prises of Google Translate API, I implemented a new limitation. Only 2000 characters per day can be processed. This limit is shared between all users. If you get an error message, please try again after 24 hrs. I'm really sorry about this, and I'm currently considering alternatives for Google Translate. (like Bing translator)</p>
        <p class="info">This is pretty old and crappy project written in PHP. Pressing the button above sometimes throws random errors. If that happens, just try again and it might work fine... I might look into this some time in the future when I have extra time.</p>
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
                    <br />
                    <small>Translation from language X to Y = one iteration. Recommended values are from 3 to 5. The larger the value is, the longer the translatefying process will take.</small>
                    <hr />
                    <label for="model">Translation model:</label>
                    <select id="model">
                        <option value="nmt" selected>Neural Machine Translation</option>
                        <option value="base">Phrase-Based Machine Translation</option>
                    </select>
                    <br />
                    <small>Google offers two different machine translation models. I like to think them as a to different translation engines. Using the Neural Machine Translation (NMT) model usually provides more accurate translations than the phrase-based one but the translation(s) also take twice (or more) as long.</small>
                    <hr />
                    <small><a href="login/index.php">Admin settings</a></small>
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