<?php
 const URL =  "http://apppig.site/";
// const URL =  "http://localhost/AppPig/";
function IncludeURL($name){
    echo URL.$name;
}

function view($ruta){
    require_once("component/".$ruta.".php");
}
function models($ruta){
    require_once("../php/modelos/".$ruta.".php");
}
function controller($ruta){
    require_once(URL."vendor/php/controladores/".$ruta.".php");
}
function ViewSend($view){
    header("location:".URL."sheet/".$view);
}
function response($names,$alert){
    for ($i=0; $i < count($names); $i++) {
        if(isset($_SESSION[$names[$i]])){
            $actual =  $names[$i];
            echo $alert->simple($actual,$_SESSION[$actual]);
            unset($_SESSION[$actual]);
        } 
    }
}

function sheet($ruta){
    $file = $ruta.".php";
    if(file_exists($file))
        require_once($file);
    else
        require_once("Compra.php");
}
function send($ruta){
    echo URL."php/controladores/".$ruta."_controller.php";
}
function isVacio($name){
    if($name == "" || $name == NULL || $name == 'NULL' || $name == '0000-00-00'){
        return "";
    }
    return $name;
}
function MenuVars($sql_todas,$id,$color_button,$ruta,$limit){
    $datas = "";
    $i = 0;
    foreach($sql_todas as $items){
        if($i == 0){
            $datas.= '<div class="btn-group btn-group-toggle mt-4" data-toggle="buttons">';
        }
        $code = "btn-secondary";
        if($items['Codigo'] == $id){
            $code =  $color_button;
        }
        $datas.= '<a href="'.URL.'sheet/'.$ruta.'/'.$items['Codigo'].'" class="btn '.$code.'">
                    <input type="radio" name="options" id="option1" autocomplete="off" checked> '.$items['Nombre'].'
            </a>';

        if($i == $limit){
            $datas.= '</div><br>';
            $datas.= '<div class="btn-group btn-group-toggle mt-4" data-toggle="buttons">';
            $i = 0;
        }
        $i++;
    }
    if($i != 0){
        $datas.= '</div><br>';
    }
    if($i == 1){
        return "";
    }
    return $datas;
}

function getModel(){
    $con =  new Conexion();
    if($_SESSION['rol'] == "Invitado"){
        $con = $con->Invitado();
    }else{
        $con = $con->Administrador();
    }
    return new Models($con);
}