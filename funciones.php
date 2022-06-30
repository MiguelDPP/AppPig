<?php
require_once("funcionesGenerales.php");

function view($ruta){
    require_once("php/secciones/".$ruta.".php");
}
function models($ruta){
    require_once("php/modelos/".$ruta.".php");
}
function controller($ruta){
    require_once("php/controladores/".$ruta.".php");
}
function send($ruta){
    echo "php/controladores/".$ruta."_controller.php";
}