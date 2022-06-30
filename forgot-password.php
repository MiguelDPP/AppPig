<?php 
session_start();
require_once("funciones.php");
models("alerts");
$alerts = new alerts();
echo "<br>";
response(["success","danger"],$alerts); 
?>
<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>AppPig | Recuperación de contraseña</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="./images/favicon.png">
    <link href="./css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/alerts.css">

</head>

<body class="h-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Recuperación de contraseña</h4>
                                    <form id="form" action="<?php send('passwordRecovery') ?>" method="POST">
                                        <div class="form-group">
                                            <label><strong>Documento</strong></label>
                                            <input type="number" name="doc" class="form-control" placeholder="12345">
                                        </div>
                                        <div class="form-group">
                                            <label><strong>Correo electronico</strong></label>
                                            <input type="email" name="email" class="form-control" placeholder="hello@example.com">
                                        </div>
                                        <div class="textError text-center d-none">
                                            <p>Datos incompletos, intente de nuevo.</p>
                                        </div>
                                        <div class="text-center">
                                            <button  type="submit" class="btn btn-primary btn-block">Enviar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
    <script src="js/alert.js"></script>
    <script src="./vendor/global/global.min.js"></script>
	<script src="./vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>
    <script src="./js/custom.min.js"></script>
    <script src="./js/deznav-init.js"></script>
    <script src="js/forgot-password.js"></script>
    

</body>

</html>