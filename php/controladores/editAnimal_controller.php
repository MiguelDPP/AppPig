<?php
require_once("controller.php");
models('sqlConsult');
session_start();

if(isset($_POST)){
    $obj = new conexion();
    $con = $obj->predetermined();
    $model = new Models($con);
    if($_POST["id"] != "" && $_POST["cantidad"] != ""){
        $model->put("Detalle_Registro_Animal");
        $rows = mysqli_num_rows($model->SQLqueryDuos('IdRegistroAnimal',$_POST["id"]));
        if($_POST["cantidad"] > $rows){
            $model->put("Registro_Animal");
            $keys = ['RazaAnimal','Cantidad'];
            $values = [$_POST["raza"],$_POST["cantidad"]];
            $q = $model->edit($keys,$values,'Id',$_POST["id"]);
            if($q){
                $_SESSION['success'] = "Editado Correctamente";
            }else{
                $_SESSION['danger'] = "Error al editar";
            }
        }else{
            $_SESSION['danger'] = "No puede reducir de esta manera la cantidad, ya que existen mas cerdos registrados de la cantidad de la compra que se desea aplicar.";
        }
        
    }else{
        $_SESSION['danger'] = "Campos Incompletos.";
    }
    redirect2('editAnimal/'.$_POST["id"]);
}