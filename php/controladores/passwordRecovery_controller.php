<?php
require_once("controller.php");
models('sqlConsult');

models('peoples');
session_start();

if(isset($_POST['doc']) && isset($_POST['email'])){
    $documento = $_POST['doc'];
    $email = $_POST['email'];
    
    $obj = new conexion();
    $con = $obj->predetermined();
    $model = new Models($con);
    $model->put("Persona");
    $sql = mysqli_fetch_array($model->SQLqueryMost(['NoDocumento','Email'],[$documento,$email]));
    if(count($sql) != 0){
        $Strings='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $nuevaContraseña = substr(str_shuffle($Strings), 0, 8);
        $asunto = "Recuperación de contraseña";
        $cuerpo =  "
        Se ha solicitado cambio de contraseña a esta cuenta vinculada con AppPig, se generó una nueva contraseña para el inicio de sesión. La contraseña es la siguiente: <b>".$nuevaContraseña."</b>  
        
        
        Si no ha solicitado el cambio de contraseña es importante que ingrese y haga los respectivos cambios";
        $headers = "MIME-Version: 1.0\r\n"; 
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
        $headers .= "From: App Pig <apppig.site@gmail.com>\r\n"; 
        
        $model->put("Relacion_Persona_Rol");
        $result = $model->edit(['Contrasena'],[$nuevaContraseña],'NoDocumento',$documento);
        if($result) {
            mail($email,$asunto,$cuerpo,$headers);
            $_SESSION['success']= "Se ha enviado un correo electronico con la nueva contraseña";
            redirectIndex();
        }else{
            $_SESSION['danger']= "Ha ocurrido un error con la operación";
            header("location:../../forgot-password.php");
        }

        
        
    }else{
        $_SESSION['danger']= "El usuario no se puede reconocer, intente de nuevo";
        header("location:../../forgot-password.php");
    }
    
}