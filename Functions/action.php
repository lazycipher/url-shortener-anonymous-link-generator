<?php
include_once('./urlShortner.php');
$dbFunc = new dbFunction();

if(isset($_POST['url'])){
    $originalUrl =  $dbFunc->urlValidate($_POST['url']);
    if(!$originalUrl){
        echo "URL ERROR";
    }
    else{
        $uniqueCode = $dbFunc->checkUrlExists($originalUrl);
        $shortUrlCode =  $dbFunc->genShortUrlLink($uniqueCode);
        echo "$shortUrlCode";
    }
}



?>