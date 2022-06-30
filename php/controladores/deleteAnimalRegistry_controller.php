<?php
require_once("controller.php");
models('sqlConsult');
session_start();

if(isset($_POST)){
    $obj = new conexion();
    $con = $obj->predetermined();
    $model = new Models($con);
    if($_POST['id'] != ""){
        $model->put("Detalle_Registro_Animal");
        $q = $model->delete('Id',$_POST['id']);
        if($q){
            $_SESSION['success'] = "Items Elimanado Correctamente";
        }else{
            $_SESSION['danger'] = "Error al eliminar";
        }
    }else{
        $_SESSION['danger'] = "Campos Incompletos.";
    }
    redirect2('deleteItemAnimal/'.$_POST['id']);
}