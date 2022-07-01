<?php 
require_once('funciones.php');
session_start();
models("connect");
models("sqlConsult");
models("peoples");
models("alerts");
$alerts = new alerts();

$rol = unserialize($_SESSION['rol']);
$PersonaRol = unserialize($_SESSION['Relacion_Persona_Rol']);

if(!isset($_SESSION['user'])){
    header('location: ../');
}
$data = unserialize($_SESSION['people']);
// $URL = 'http://apppig.site/';
$URL =  "http://localhost/AppPig/";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <?php 
        if(isset($_GET['url'])){
            $title = explode("/",$_GET['url'])[0];
            $titulo;
            switch($title){
                case "food":
                    $titulo = "Alimentos comprados";
                    break;
                default:
                    $titulo = "AppPig";
                    break;
            }
        }else{
            $titulo = "AppPig";
        }
        
    ?>
     
    
    <title><?php echo $titulo?></title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../images/pig.png">
    <link href="<?php echo $URL;?>vendor/jqvmap/css/jqvmap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo $URL;?>vendor/jqvmap/css/jqvmap.min.css">
    <link href="<?php echo $URL;?>vendor/bootstrap-select/dist/css/bootstrap-select.min.css" rel="stylesheet">
    <link href="<?php echo $URL;?>css/style.css" rel="stylesheet">
	<link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="../vendor/datatables/DataTables-1.12.1/css/dataTables.bootstrap4.min2.css"/> -->
<link rel="stylesheet" type="text/css" href="<?php echo $URL;?>vendor/datatables/Buttons-2.2.3/css/buttons.bootstrap4.min.css"/>
    <!-- Datatable -->
    <link href="<?php echo $URL;?>vendor/datatables/DataTables-1.12.1/css/jquery.dataTables.min2.css" rel="stylesheet">

</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <?php require_once('layouts-dash/navHeader.dashboard.php'); ?>
        <!--**********************************
            Nav header end
        ***********************************-->
		
		<!--**********************************
            Chat box start
        ***********************************-->
		<?//php require_once('layouts-dash/chatBox.dashboard.php'); ?>
		<!--**********************************
            Chat box End
        ***********************************-->
		
		<!--**********************************
            Header start
        ***********************************-->
        <?php require_once('layouts-dash/header.dashboard.php'); ?>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <?php require_once('layouts-dash/sidebar.dashboard.php'); ?>

        <!--**********************************
            Sidebar end
        ***********************************-->
		
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            
        <?php
            response(["success","danger"],$alerts); 
            if(isset($_GET['url'])){
                $partsURL = explode("/",$_GET['url']);
                $_SESSION['url_s'] = $partsURL;
                if(file_exists($partsURL[0].".php")){
                    require_once($partsURL[0].".php");
                }

            }else {
                require_once('layouts-dash/index.dashboard.php');
            }
        ?>
        </div>

        <!--**********************************
            Content body end
        ***********************************-->


    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="<?php echo $URL;?>vendor/global/global.min.js"></script>
	<script src="<?php echo $URL;?>vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
	<script src="<?php echo $URL;?>vendor/chart.js/Chart.bundle.min.js"></script>
    <script src="<?php echo $URL;?>js/custom.min.js"></script>
	<script src="<?php echo $URL;?>js/deznav-init.js"></script>
    
    <!-- DataTables -->
    <script type="text/javascript" src="<?php echo $URL;?>vendor/datatables/JSZip-2.5.0/jszip.min.js"></script>
    <script type="text/javascript" src="<?php echo $URL;?>vendor/datatables/pdfmake-0.1.36/pdfmake.min.js"></script>
    <script type="text/javascript" src="<?php echo $URL;?>vendor/datatables/pdfmake-0.1.36/vfs_fonts.js"></script>
    <script src="<?php echo $URL;?>vendor/datatables/DataTables-1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo $URL;?>vendor/datatables/Buttons-2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="<?php echo $URL;?>vendor/datatables/Buttons-2.2.3/js/buttons.bootstrap4.min.js"></script>
    <script type="text/javascript" src="<?php echo $URL;?>vendor/datatables/Buttons-2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="<?php echo $URL;?>vendor/datatables/Buttons-2.2.3/js/buttons.print.min.js"></script>
    <!-- ----------------- -->
    <script src="<?php echo $URL;?>js/dataTableInit.js"></script>
	<!-- Counter Up -->
    <script src="<?php echo $URL;?>vendor/waypoints/jquery.waypoints.min.js"></script>
    <script src="<?php echo $URL;?>vendor/jquery.counterup/jquery.counterup.min.js"></script>	
		
	<!-- Apex Chart -->
	<script src="<?php echo $URL;?>vendor/apexchart/apexchart.js"></script>	
	
	<!-- Chart piety plugin files -->
	<script src="<?php echo $URL;?>vendor/peity/jquery.peity.min.js"></script>
	
	<!-- Dashboard 1 -->
	<script src="<?php echo $URL;?>js/dashboard/dashboard-1.js"></script>

    <!-- Redirect -->
    <script src="<?php echo $URL;?>js/redirect.js"></script>
    <script src="<?php echo $URL;?>js/alert.js"></script>
	
	
</body>
</html>