<?php 
if(isset($_GET['url'])){
    $url = $_GET["url"];
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Redirecting to <?php echo $url;?></title>
    <meta http-equiv="refresh" content="1; url=<?php echo $url; ?>" id="url">
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./vendor/bootstrap/css/style.css">
    <!-- Custom styles for this template -->
    <style>
      body {
        padding-top: 54px;
      }
      @media (min-width: 992px) {
        body {
          padding-top: 56px;
        }
      }
    </style>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-122355138-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-122355138-1');
    </script>

  </head>
  <body>
<br/>
<br/> 
    <!-- Page Content -->
    <div class="container" align="center">
      <div class="col-lg-6">
        <div id="shortUrl" class="p-3 mb-2 bg-secondary text-white">
        <h4>Redirecting to <a href="<?php echo $url; ?>" title="<?php echo $url; ?>" rel="noreferrer nofollow"><?php echo $url; ?></a></h4>
        </div>
        </div>
      </div>
    </div>
    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/qrcode.js"></script>
  </body>
</html>
