<?php
$strurl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$url = parse_url($strurl, PHP_URL_QUERY);
if (preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$url)) {
    header("location:./refer.php?url=$url");
}

?> 
<!DOCTYPE html>
<html>
<head>
    <title>URL SHORTNER</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="./js/main.js"></script>

</head>
<body>
<h1>URL Shortner</h1>

<div align="center">
        <form id="input-form" action="" method="POST">
                <div id="urlError"></div>
                <label for="fname">URL</label>
                <input type="text" id="originalUrl" name="originalUrl" placeholder="URL">
                
                
            
                <input type="submit" id="submit" name="submit" value="Submit">
            
              </form>

        <div id="shortUrl"></div>
</div>

</body>
</html>

