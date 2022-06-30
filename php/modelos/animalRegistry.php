<?php 
require_once("connect.php");
require_once("sqlConsult.php");

class animalRegistry{

    public $Id;
    public $RazaAnimal;
    public $Cantidad;

    function __construct($data){
        $this->Id = $data["Id"];
        $this->RazaAnimal = $data["RazaAnimal"];
        $this->Cantidad = $data["RazaAnimal"];
    }

}