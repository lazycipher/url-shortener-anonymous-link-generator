<?php
include_once('./urlShortner.php');
$dbFunc = new dbFunction();

if(isset($_POST['url'])){
    $url = $_POST['url'];
    $originalUrl =  $dbFunc->urlValidate($url);
    if(!$originalUrl){
        echo "0";
    }
    else{
        $uniqueCode = $dbFunc->checkUrlExists($originalUrl);
        
        echo "$uniqueCode";
    }
}

?>