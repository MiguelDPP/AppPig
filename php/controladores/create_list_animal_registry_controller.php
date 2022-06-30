<?php
require_once("controller.php");
models('sqlConsult');
session_start();

if(isset($_POST)){
    $obj = new conexion();
    $con = $obj->predetermined();
    $model = new Models($con);
    if(
        $_POST['IdRegistroAnimal'] != "" && 
        $_FILES['foto']['name'] != "" && 
        $_POST["lote"] != "" && 
        $_POST["color"] != "" && 
        $_POST["caracteristicas"] != "" &&
        $_POST["peso"] != "" &&
        $_POST["precio"] != ""
    ){
        $model->put("Detalle_Registro_Animal");
        $q = $model->insert_null([$_POST["IdRegistroAnimal"],$_POST["lote"],'0','NULL','0']);
        $lastRow = $model->lastRow('Id');
        //CREAMOS ARCHIVOS
        $carpetaRaiz = '../../images/detalleRegistroAnimal/'.$_POST["IdRegistroAnimal"];
        if(file_exists($carpetaRaiz) == false){
            if(!mkdir($carpetaRaiz, 0777, true)) {
                echo $carpetaRaiz;
                die('Fallo al crear las carpetas... 1');
    
            }
        }

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $carpetaHija = '../../images/detalleRegistroAnimal/'.$_POST["IdRegistroAnimal"].'/';
        
        $serial = "";
        $ruta = "";
        $ruta1 = "";
        do{
            $serial = $model->generate_string($permitted_chars,10);
            $ruta = file_exists($carpetaHija.$serial);
        }while($ruta == true);

        $ruta1 = $carpetaHija.$serial;

        if(!mkdir($ruta1, 0777, true)) {
            die('Fallo al crear las carpetas... 2');
        }
        $save_ruta = $_POST["IdRegistroAnimal"].'/'.$serial.'/'.$_FILES["foto"]['name'];
        $save_photo = move_uploaded_file($_FILES["foto"]['tmp_name'],$ruta1."/".$_FILES["foto"]['name']);
        
        //SUBIR ARCHIVO
        $model->put("OtrosAtributos");
        $q1 = $model->insert_null([$lastRow['Id'],'foto',$save_ruta]);
        $q2 = $model->insert_null([$lastRow['Id'],'caracteristicas',$_POST['caracteristicas']]);
        $q3 = $model->insert_null([$lastRow['Id'],'color',$_POST['color']]);
        $q4 = $model->insert_null([$lastRow['Id'],'peso',$_POST['peso']]);
        $q5 = $model->insert_null([$lastRow['Id'],'precio',$_POST['precio']]);
        
        if($q){
            $_SESSION['success'] = "Creado Correctamente";
        }else{
            $_SESSION['danger'] = "Error al crear";
        }
    }else{
        $_SESSION['danger'] = "Campos Incompletos.";
    }
    redirect2('listAnimalRegistry/'.$_POST['IdRegistroAnimal']);
}