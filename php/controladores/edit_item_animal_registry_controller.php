<?php
require_once("controller.php");
models('sqlConsult');
session_start();

if(isset($_POST)){
    $obj = new conexion();
    $con = $obj->predetermined();
    $model = new Models($con);
    if(
        $_POST['Id'] != "" && 
        $_POST["lote"] != "" && 
        $_POST["color"] != "" && 
        $_POST["caracteristicas"] != "" &&
        $_POST["peso"] != "" &&
        $_POST["precio"] != ""
    ){
        $model->put("Detalle_Registro_Animal");
        
        $fallecimiento = $_POST['fallecimiento'];
        echo $fallecimiento;
        $muerto = '0';
        if($_POST['muerto'] == "si"){
            $muerto = '1';
            $fallecimiento = $_POST['fallecimiento'];
        }else{
            $fallecimiento = 'NULL';
        }

        $key = ['Lote','EstaMuerto','FechaFallecimiento','EstaVendido'];
        $values = [$_POST['lote'],$muerto,$fallecimiento,$_POST['vendido']];
        $q = $model->edit($key,$values,'Id',$_POST['Id']);


        $model->put("OtrosAtributos");
        $Campo = ['Valor'];
        $valuesPeso = [$_POST["peso"]];
        $valuesCaracteristicas = [$_POST["caracteristicas"]];
        $valuesPrecio = [$_POST["precio"]];
        $valuesColor = [$_POST["color"]];
        $q1 = $model->edit2($Campo,$valuesPeso," IdRegistroAnimal = '".$_POST['Id']."' AND Nombre = 'peso'");
        $q2 = $model->edit2($Campo,$valuesCaracteristicas," IdRegistroAnimal = '".$_POST['Id']."' AND Nombre = 'caracteristicas'");
        $q3 = $model->edit2($Campo,$valuesPrecio," IdRegistroAnimal = '".$_POST['Id']."' AND Nombre = 'precio'");
        $q4 = $model->edit2($Campo,$valuesColor," IdRegistroAnimal = '".$_POST['Id']."' AND Nombre = 'color'");
        
        if($_FILES['foto']['name'] != ""){
            echo $_FILES['foto']['name'];
            $model->put("OtrosAtributos");
            $array_foto = mysqli_fetch_array($model->SQLqueryMost(['IdRegistroAnimal','Nombre'],[$_POST['Id'],'foto']));
            $Rut = '../../images/detalleRegistroAnimal/'.$array_foto['Valor'];
            if(unlink($Rut)){
                echo "Archivo Eliminando..............";
                $cadena = explode('/',$array_foto['Valor']);
                $partRuta = $cadena[0].'/'.$cadena[1].'/'.$_FILES['foto']['name'];
                $rutamove = '../../images/detalleRegistroAnimal/'.$partRuta;
                if(move_uploaded_file($_FILES["foto"]['tmp_name'],$rutamove)){

                    $model->put("OtrosAtributos");
                    $model->edit(['Valor'],[$partRuta],'Id',$array_foto['Id']);
                }
            }
        }
        
        if($q){
            $_SESSION['success'] = "Editado Correctamente";
        }else{
            $_SESSION['danger'] = "Error al editar, fallo en la consulta.";
        }
    }else{
        $_SESSION['danger'] = "Campos Incompletos.";
    }
    redirect2('editAnimalRegistry/'.$_POST['Id']);
}