<?php

require_once("controller.php");
models('sqlConsult');

models('peoples');
session_start();

if(isset($_POST)){
    $obj = new conexion();
    $con = $obj->predetermined();
    $model = new Models($con);
    $dataUserApi;
    if(isset($_POST["password"])){
        $model->put("Relacion_Persona_Rol");
        $dataUserApi = mysqli_fetch_array($model->SQLqueryMost(["NoDocumento","Contrasena"],[$_POST["NoDocumento"],$_POST["password"]]));
    }
    if(isset($_SESSION['user']) || (count($dataUserApi) > 0)){
        if(isset($_POST['nombre']) && $_POST['nombre'] != "" && isset($_POST['email']) &&  $_POST['email'] != "" && isset($_POST['direccion']) && $_POST['direccion'] != ""
        && isset($_POST['municipio']) && $_POST['municipio'] != "" && isset($_POST['fecha']) &&  $_POST['fecha'] != "" && isset($_POST['telefono']) && $_POST['telefono'] != "" && isset($_POST['sexo']) && $_POST['sexo'] != ""){
            $model->put("Persona");
            $wheres = ['TipoDocumento','Nombre_Completo','Sexo','FechaNacimiento','Telefono','Email','Direccion','Municipio'];
            $values = ['CC',$_POST['nombre'],$_POST['sexo'],$_POST['fecha'],$_POST['telefono'],$_POST['email'],$_POST['direccion'],$_POST['municipio']];
            $sql = $model->edit($wheres,$values,'NoDocumento',$_POST['NoDocumento']);
            if($sql){
                $data_ = mysqli_fetch_array($model->returnDataUser($_POST['NoDocumento']));
                $people_ = new people($data_);
                $_SESSION['people'] = serialize($people_);
                echo "Editado correctamente";
                $_SESSION['success']= "Editado Correctamente.";
            }else{
                $_SESSION['danger']= "Error al conectar.";
                echo "Error al conectar";
            }
            if(!(isset($_POST["password"]))){
                redirect2('profile');
            }
        }else{
            echo "Algunos campos están vacios";
            $_SESSION['danger']= "Algunos campos están vacios";
            if(!(isset($_POST["password"]))){
                redirect2('profile');
            }
        }
    }else{
        echo "Error al realizar la operación";
    }
}else{
    echo "Error al conectar";
    $_SESSION['danger']= "Error al conectar.";
    if(!(isset($_POST["password"]))){
        redirect2('profile');
    }
}