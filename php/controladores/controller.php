<?php
require_once("../modelos/connect.php");

function models($ruta){
    require_once("../modelos/".$ruta.".php");
}
function redirect(){
    header("location:../../sheet/");    
}
function redirect2($ruta){
    header("location:../../sheet/$ruta");    
}
function redirectIndex(){
    header("location:../../");
}
function peso($value){
    return str_replace(",",".",number_format($value));
}
function Create_Session($name,$value){
    session_start();
    $_SESSION[$name] =  $value;
}

function getModel($rol){
    $con =  new Conexion();
    if($rol == "cliente"){
        $con = $con->Invitado();
    }else{
        $con = $con->Administrador();
    }
    return new Models($con);
}

function getTime(){
    date_default_timezone_set('America/Bogota');
    $hora1 = new DateTime();
    $hora =  date("Y-m-d")." ".$hora1->format('H:i:s');
    return $hora;
}