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
    if(isset($_SESSION['user']) || (count($dataUserApi) > 0 && $dataUserApi["IdRol"] == 1)){
        $model->put("Persona");
        if($_POST['NoDocumento'] != ""){
            $i = mysqli_num_rows($model->SQLqueryDuos('NoDocumento', $_POST['NoDocumento'])); 
            if($i == 0){

                if($_POST['nombre'] != "" && $_POST['contraseña'] != "" && $_POST['email'] != "" && $_POST['direccion'] != ""
                && $_POST['municipio'] != "" && $_POST['fecha'] != "" && $_POST['telefono'] != "" && $_POST['sexo'] != ""){

                    $datas = ['TipoDocumento','NoDocumento','Nombre_Completo','Sexo','FechaNacimiento','Telefono','Email','	Direccion','Municipio'];
                    $value = [$_POST['tipo'],$_POST['NoDocumento'],$_POST['nombre'],$_POST['sexo'],$_POST['fecha'],$_POST['telefono'],$_POST['email'],$_POST['direccion'],$_POST['municipio']];
                    $q = $model->insertData($datas,$value);
                    if($q){
                        $model->put("Relacion_Persona_Rol");
                        $t = $model->insert_null([$_POST['NoDocumento'],'2',$_POST['contraseña']]);
                        if($t){
                            $_SESSION['success'] = "Creado Correctamente";
                            echo "Creado Correctamente";
                        }
                        if(!(isset($_POST["user"]) && isset($_POST["password"])) && isset($_SESSION["user"])){
                            redirect2('listUsers');
                        }
                    }else{
                        $_SESSION['danger'] = "Error en la BD.";
                        echo "Error en la BD.";
                    }

                }else{
                    $_SESSION['danger'] = "Algunos campos estan vacios.";
                    echo "Algunos campos estan vacios.";
                }

            }else{
                $_SESSION['danger'] = "El numero de documento ya pertenece a una persona de la base de datos.";
                echo "El numero de documento ya pertenece a una persona de la base de datos.";
            }
        }else{
            $_SESSION['danger'] = "Algunos campos estan vacios.";
            echo "Algunos campos estan vacios.";
        }
    }else{
        echo "Error: No tienes permiso de realizar esta operación";
    } 
}
if(!(isset($_POST["user"]) && isset($_POST["password"])) && isset($_SESSION["user"])){
    redirect2('create-farm-manager');
}