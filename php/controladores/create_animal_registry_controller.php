<?php
require_once("controller.php");
models('sqlConsult');
session_start();

if(isset($_POST)){
    $obj = new conexion();
    $con = $obj->predetermined();
    $model = new Models($con);
    if($_POST["raza"] != "" && $_POST["cantidad"] != ""){
        $model->put("Registro_Animal");
        $q = $model->insert_null([$_POST["raza"],$_POST["cantidad"]]);
        if($q){
            $_SESSION['success'] = "Creado Correctamente";
        }else{
            $_SESSION['danger'] = "Error al crear";
        }
    }else{
        $_SESSION['danger'] = "Campos Incompletos.";
    }
    redirect2('animalRegistry');
}