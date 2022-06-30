<?php
session_start();
$con = unserialize($_SESSION['conexion']);
if(!isset($con)){ 
    header('location:../');
}