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
    if(isset($_POST["user"]) && isset($_POST["password"])){
        $model->put("Relacion_Persona_Rol");
        $dataUserApi = mysqli_fetch_array($model->SQLqueryMost(["NoDocumento","Contrasena"],[$_POST["user"],$_POST["password"]]));
    }
    if(isset($_SESSION['user']) || (count($dataUserApi) > 0 && $dataUserApi["IdRol"] == "1")){
        if($_POST['nombre'] != "" && $_POST['contraseña'] != "" && $_POST['email'] != "" && $_POST['direccion'] != ""
        && $_POST['municipio'] != "" && $_POST['fecha'] != "" && $_POST['telefono'] != "" && $_POST['sexo'] != ""){
            $model->put("Persona");
            $wheres = ['TipoDocumento','NoDocumento','Nombre_Completo','Sexo','FechaNacimiento','Telefono','Email','Direccion','Municipio'];
            $values = [$_POST['tipo'],$_POST['NoDocumento1'],$_POST['nombre'],$_POST['sexo'],$_POST['fecha'],$_POST['telefono'],$_POST['email'],$_POST['direccion'],$_POST['municipio']];
            $sql = $model->edit($wheres,$values,'NoDocumento',$_POST['NoDocumento']);
            if($sql){
                $model->put('Relacion_Persona_Rol');
                $t = $model->edit(['Contrasena'],[$_POST['contraseña']],'NoDocumento',$_POST['NoDocumento1']);
                $_SESSION['success']= "Editado Correctamente.";
                echo "Editado Correctamente.";
                if(!(isset($_POST["user"]) && isset($_POST["password"])) && isset($_SESSION["user"])){
                    redirect2('editUser/'.$_POST['NoDocumento1']);
                }

            }else{
                $_SESSION['danger']= "Error al conectar.";
                echo "Error al conectar.";
                if(!(isset($_POST["user"]) && isset($_POST["password"])) && isset($_SESSION["user"])){
                    redirect2('editUser/'.$_POST['NoDocumento']);
                }
            }  
        
        }else{
            echo "Faltan datos";
            if(!(isset($_POST["user"]) && isset($_POST["password"])) && isset($_SESSION["user"])){
                redirect2('editUser/'.$_POST['NoDocumento']);
            }
        }
    }else{
        echo "Error: No tienes permiso de realizar esta operación";
    } 
}else{
    $_SESSION['danger']= "Error al conectar.";
    echo "Error al conectar.";
    if(!(isset($_POST["user"]) && isset($_POST["password"])) && isset($_SESSION["user"])){
        redirect2('listUsers'); 
    }
    
}