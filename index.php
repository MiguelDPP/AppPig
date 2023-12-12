<?php 
    session_start();
    require_once("funciones.php");

    require __DIR__ . '/vendor/autoload.php';
    $envPath = './';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
    models("connect");
    models("alerts");
    if(isset($_SESSION['user'])){
        header('location: sheet');
    }
    $obj = new conexion();
    $alerts = new alerts();
    $con = $obj->predetermined();

    
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>AppPig</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Fjalla+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&family=Pacifico&display=swap" rel="stylesheet">
    <link href="./css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/alerts.css">
</head>
<body style="height: 100vh;">
    <?php 
        if(!$con){
            view("login/upload");
        }else{
            mysqli_set_charset($con,"utf8");
            view("login/login");     
        }
        echo "<br>";
        response(["success","danger"],$alerts); 
    ?> 
    <!-- <script src="js/alert.js"></script> -->
    <script src="js/form.js"></script>
</body>
</html>
