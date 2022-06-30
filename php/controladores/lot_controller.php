<?php

use LDAP\Result;

require_once("controller.php");
models('sqlConsult');
session_start();

if(isset($_POST)){
    $obj = new conexion();
    $con = $obj->predetermined();
    $model = new Models($con);

    if(isset($_POST['Estado'])){
        if($_POST['Estado'] == "1"){
            if(isset($_POST['Nombre']) && $_POST['Nombre'] != "" && isset($_POST["Descripcion"])){
                $model->put("Lotes");
                $Descripcion = $_POST["Descripcion"];
                if($Descripcion == ""){
                    $Descripcion = " ";
                }
                $q = $model->insert_null([$_POST["Nombre"],$Descripcion]);
                if($q){
                    $_SESSION['success'] = "Creado Correctamente";
                }else{
                    $_SESSION['danger'] = "Error al crear Lote";
                }
            }else{
                $_SESSION['danger'] = "Campos Incompletos.";
            }
        }elseif($_POST['Estado'] == "2"){
            if(isset($_POST["IdLote"]) && $_POST["IdLote"] != ""){
                $IdLote = $_POST["IdLote"];
                $model->put("Lotes");
                $q = $model->edit(['Nombre', 'Descripcion'],[$_POST['Nombre'], $_POST['Descripcion']], 'Id', $IdLote);
                if($q){
                    $_SESSION['success'] = "Editado Correctamente";
                }else{
                    $_SESSION['danger'] = "Error al editar Lote";
                }
            }else{
                $_SESSION['danger'] = "Falló al editar";
            }
        }elseif($_POST["Estado"] == "3"){
            if(isset($_POST["IdLote"]) && $_POST["IdLote"] != ""){
                $model->put("Detalle_Registro_Animal");
                $result = mysqli_num_rows($model->SQLqueryDuos('Lote', $_POST["IdLote"]));
                if($result == 0){
                    $model->put("Lotes");
                    $result2 = $model->delete('Id', $_POST["IdLote"]);
                    if($result2){
                        $_SESSION['success'] = "Eliminado Correctamente";
                    }else{
                        $_SESSION['danger'] = "Error al eliminar, intente de nuevo";
                    }
                }else{
                    $_SESSION['danger'] = "Este lote contiene registro de animales, no se puede eliminar";
                }
            }
        }
    }else{
        $_SESSION['danger'] = "Error en la operacion, intentelo de nuevo";
    }
}
redirect2('lot');