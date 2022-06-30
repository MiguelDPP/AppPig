<?php
require_once("controller.php");
models('sqlConsult');
session_start();

if(isset($_POST)){
    $obj = new conexion();
    $con = $obj->predetermined();
    $model = new Models($con);
    if($_POST["op"] == "crear"){
        if($_POST["atributo"] != "" && $_POST["valor"] != ""){
            $model->put("OtrosAtributos");
            $q = $model->insert_null([$_POST["Id_detalle"],$_POST["atributo"],$_POST["valor"]]);
            if($q){
                $_SESSION['success'] = "Agregado Correctamente";
            }else{
                $_SESSION['danger'] = "Error al crear";
            }
        }else{
            $_SESSION['danger'] = "Campos Incompletos.";
        }
    }
    if($_POST["op"] == "update"){
        if($_POST["Id"] != "" && $_POST["valor"] != ""){
            $model->put("OtrosAtributos");
            $q = $model->edit(["Valor"],[$_POST["valor"]],"Id",$_POST["Id"]);
            if($q){
                $_SESSION['success'] = "Editado Correctamente";
            }else{
                $_SESSION['danger'] = "Error al crear";
            }
        }else{
            $_SESSION['danger'] = "Campos Incompletos.";
        }
    }
    
    redirect2('editAnimalRegistry/'.$_POST["Id_detalle"]);
}