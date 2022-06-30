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
            if(isset($_POST['Lote']) && $_POST['Lote'] != "" && isset($_POST['Nombre']) && $_POST['Nombre'] != "" && isset($_POST['Cantidad']) && $_POST['Cantidad'] != "" && isset($_POST['Precio']) && $_POST['Precio'] != "" && isset($_POST['FechaCompra']) && $_POST['FechaCompra'] != ""){
                $model->put("ComidaComprada");

                $q = $model->insert_null([$_POST["Nombre"],$_POST["Cantidad"],$_POST["Precio"],$_POST["FechaCompra"],$_POST["Lote"]]);
                if($q){
                    $_SESSION['success'] = "Creado Correctamente";
                }else{
                    $_SESSION['danger'] = "Error al crear Lote";
                }
            }else{
                $_SESSION['danger'] = "Campos Incompletos.";
            }
        }elseif($_POST['Estado'] == "2"){
            if(isset($_POST["IdAlimento"]) && $_POST["IdAlimento"] != "" && isset($_POST['Lote']) && $_POST['Lote'] != "" && isset($_POST['Nombre']) && $_POST['Nombre'] != "" && isset($_POST['Cantidad']) && $_POST['Cantidad'] != "" && isset($_POST['Precio']) && $_POST['Precio'] != "" && isset($_POST['FechaCompra']) && $_POST['FechaCompra'] != ""){
                $IdAlimento = $_POST["IdAlimento"];
                $model->put("ComidaComprada");
                $q = $model->edit(['Nombre', 'Cantidad','Precio','FechaCompra','Lote'],[$_POST["Nombre"],$_POST["Cantidad"],$_POST["Precio"],$_POST["FechaCompra"],$_POST["Lote"]], 'Id', $IdAlimento);
                if($q){
                    $_SESSION['success'] = "Editado Correctamente";
                }else{
                    $_SESSION['danger'] = "Error al editar Lote";
                }
            }else{
                $_SESSION['danger'] = "Falló al editar, asegurese de que estén todos los campos";
            }
        }elseif($_POST["Estado"] == "3"){
            if(isset($_POST["IdAlimentoDelete"]) && $_POST["IdAlimentoDelete"] != ""){
                $model->put("ComidaComprada");
                $result2 = $model->delete('Id', $_POST["IdAlimentoDelete"]);
                if($result2){
                    $_SESSION['success'] = "Eliminado Correctamente";
                }else{
                    $_SESSION['danger'] = "Error al eliminar, intente de nuevo";
                }
            }else{
                $_SESSION['danger'] = "Falló al Eliminar, asegurese de que estén todos los campos";
            }
        }
    }else{
        $_SESSION['danger'] = "Error en la operacion, intentelo de nuevo";
    }
}
redirect2('food');