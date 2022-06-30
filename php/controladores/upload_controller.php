<?php 
session_start();
require_once("controller.php");
if(isset($_POST['username']) && isset($_POST['password'])){
    $user = str_replace(" ","",$_POST['username']);
    $password =  str_replace(" ","",$_POST['password']);
    if(($user != "" && $password != "") || ($user == "root" && $password == "")){
        upload($user,$password);
    }
}

function upload($user,$password){
        $pure = new conexion();
        $con = $pure->personalized2($user,$password);
        if(!$con){
            Create_Session("danger","User y password incorrectos!");
        }else{
            $_SESSION['user'] = $user;
            $_SESSION['password'] =  $password;
            $lines = "";
            // Ruta al fichero que vas a cargar.
            $name_fichero = $_FILES['sql']['name'];
            $cadena_extension = substr($name_fichero,-4);

            if($cadena_extension == ".sql"){

                $fichero = $_FILES['sql']['tmp_name'];
                $temp = '';
                $comentario_multilinea = false;
                $lineas = file($fichero);

                foreach ($lineas as $linea) {

                    $linea = trim($linea);
                    if ( (substr($linea, 0, 2) == '--') or (substr($linea, 0, 1) == '#') or ($linea == '') )
                        continue;
            
                    if ( substr($linea, 0, 2) == '/*' ) $comentario_multilinea = true;

                    if ( $comentario_multilinea ) {
                        if ( (substr($linea, -2, 2) == '*/') or (substr($linea, -3, 3) == '*/;') ) $comentario_multilinea = false;
                        continue;
                    }

                    $temp .= $linea;

                    if (substr($linea, -1, 1) == ';') {
                        mysqli_query($con, $temp) or print('<strong>Error en la consulta</strong> \'' . $temp . '\' - ' . mysqli_error($con) . "<br /><br />\n");
                        $temp = '';
                    }
                }
                Create_Session("success","SQL importado correctamente.");
            }else{
                Create_Session("danger","El archivo adjuntado no corresponde a un sql.");
            }
        }
}
unset($_SESSION['user'],$_SESSION['password']);
redirect("index");
