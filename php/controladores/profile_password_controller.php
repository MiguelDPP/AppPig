<?php
require_once("controller.php");
models('sqlConsult');
models('peoples');
session_start();
$dataUserApi;
if(isset($_POST)){
    $obj = new conexion();
    $con = $obj->predetermined();
    $model = new Models($con);

    if(isset($_POST["actual"])){
        $model->put("Relacion_Persona_Rol");
        $dataUserApi = mysqli_fetch_array($model->SQLqueryMost(["NoDocumento","Contrasena"],[$_POST["NoDocumento"],$_POST["actual"]]));
    }

    if(isset($_SESSION['user']) || (count($dataUserApi) > 0 )){
        if(isset($_POST['NoDocumento']) && $_POST['actual'] != ""){
            $model->put("Relacion_Persona_Rol");
            $sql = $model->SQLqueryDuos('NoDocumento', $_POST['NoDocumento']); 
            if(mysqli_num_rows($sql) > 0){
                $datas = mysqli_fetch_array($sql);
                if($datas['Contrasena'] == $_POST['actual']){
                    if($_POST['nueva'] == $_POST['nueva_confirmar']){
                        $q = $model->edit(['Contrasena'],[$_POST['nueva']],'NoDocumento',$_POST['NoDocumento']);
                        if($q){
                            $_SESSION['success']= "Contraseña Cambiada Correctamente.";
                            echo "Contraseña Cambiada Correctamente.";
                        }else{
                            $_SESSION['danger']= "Error al cambiar la contraseña.";
                            echo "Error al cambiar la contraseña.";
                        }
                    }else{
                        $_SESSION['danger']= "Las 2 contraseñas Nuevas no COINCIDEN.";
                        echo "Las 2 contraseñas Nuevas no COINCIDEN.";
                    }
                }else{
                    $_SESSION['danger']= "La contraseña NO coincide con la actual.";
                    echo "La contraseña NO coincide con la actual.";
                }
            }     
        }else{
            $_SESSION['danger']= "Campos Vacios";
            echo "Campos Vacios";
        }
    }else{
        echo "Error al realizar la operación";
    }
    
}
if(isset($_SESSION['user'])){
    redirect2('profile');
}
