<?php 
include_once("./urlShortner.php");
$dbFunc = new dbFunction();

if(isset($_GET['url'])){
    $shortCode = $_GET["url"];
}
$url = $dbFunc->getOriginalUrl($shortCode);


?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="refresh" content="1; url=<?php echo $url; ?>" id="url">
<title>Redirecting to <?php echo $url; ?>/</title>
<!--<link rel="shortcut icon" href="https://anon.to/favicon.png">-->
<style>
        html{margin:0;padding:0;width:100%;height:100%;}
        body{margin:0;padding:0;width:100%;height:100%;color:#000000;display:table;font-weight:100;font-family:Menlo,Monaco,Consolas,"Courier New",monospace}.container{text-align:center;display:table-cell;vertical-align:middle}.content{text-align:center;font-size:18px;display:inline-block}.content a{color:#ff0000;text-decoration:none}
    </style>
</head>
<body>
<div class="container">
<div class="content">
<h1>Redirecting to <a href="<?php echo $url; ?>" title="<?php echo $url; ?>" rel="noreferrer nofollow"><?php echo $url; ?></a>
</h1>
</div>
</div>
</body>
</html>