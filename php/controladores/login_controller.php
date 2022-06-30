<?php
require_once("controller.php");
models('sqlConsult');

models('peoples');
session_start();

if(isset($_POST['username']) && isset($_POST['password'])){
    $obj = new conexion();
    $con = $obj->predetermined();

    $user =  mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    
    
    $model = new Models($con);
    $model->put("Relacion_Persona_Rol");
    $sql = mysqli_fetch_array($model->SQLqueryMost(['NoDocumento','Contrasena'],[$user,$password]));
    if(count($sql) != 0){
        $model->put("Roles");
        $sql2 = mysqli_fetch_array($model->SQLqueryDuos('Id', $sql['Id'])); 
        $_SESSION['user'] = $user;
        $_SESSION['rol'] = serialize($sql2);
        $_SESSION['Relacion_Persona_Rol'] = serialize($sql);
        $data = mysqli_fetch_array($model->returnDataUser($sql["NoDocumento"]));
        $people = new people($data);
        $_SESSION['people'] = serialize($people);
        $_SESSION['conexion'] =  serialize($con);
        $_SESSION['success']= "Bienvenido al sistema";
        redirect();

    }else{
        $_SESSION['danger'] = "El usuario o Contraseña es incorrecto.";
        redirectIndex();
    }
}