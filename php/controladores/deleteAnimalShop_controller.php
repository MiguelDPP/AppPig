<?php
require_once("controller.php");
models('sqlConsult');
session_start();
$eliminada = false;

if(isset($_POST)){
    $obj = new conexion();
    $con = $obj->predetermined();
    $model = new Models($con);

    if($_POST['id'] != ""){
        $model->put("Detalle_Registro_Animal");
        $rows = mysqli_num_rows($model->SQLqueryDuos('IdRegistroAnimal',$_POST['id']));
        if($rows == 0 ){
            $model->put("Registro_Animal");
            $q = $model->delete('Id',$_POST['id']);
            if($q){
                $eliminada = true;
                $_SESSION['success'] = "Compra Eliminada Correctamente";
            }else{
                $_SESSION['danger'] = "Error al eliminar";
            }
        }else{
            $_SESSION['danger'] = "No se puede eliminar esta categoria porque tiene cerdos registrados.";
        }
    }else{
        $_SESSION['danger'] = "Campos Incompletos.";
    }

    if($eliminada == true){
        redirect2('animalRegistry');
    }else{
        redirect2('deleteAnimalShop/'.$_POST['id']);
    }

}