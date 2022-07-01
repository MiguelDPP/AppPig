<?php 
require_once("connect.php");
require_once("sqlConsult.php");

class lot{
    private $Id;
    public $Nombre;
    public $Descripcion;
    function __construct($data)
    {
        $this->Id = $data["Id"];
        $this->Nombre = $data["Nombre"];
        $this->Descripcion = $data["Descripcion"];
    }
    function getId(){
        return $this->Id;
    }
    function getData($admin){
        $button = "";
        if($admin){
            $button = "<div class='d-flex justify-content-center'>
            <a class='btn btn-info shadow btn-xs sharp mr-1' href='./lotAnimals/{$this->Id}'><i class='mdi mdi-eye'></i></a>
            <button class='edit btn btn-primary shadow btn-xs sharp mr-1' value='{$this->Id}'><i class='fa fa-pencil'></i></button>
            <button class='delete btn btn-danger shadow btn-xs sharp mr-1' value='{$this->Id}'><i class='mdi mdi-delete'></i></button>
            </div>";    
        }
        $obj = new conexion();
        $con = $obj->predetermined();
        $model = new Models($con);
        $model->put("Detalle_Registro_Animal");
        $CantidadCedos = mysqli_num_rows($model->SQLqueryDuos('Lote',$this->Id));
        $data = "
            <tr>
                <td> {$this->Nombre} </td>
                <td> {$this->Descripcion} </td>
                <td> {$CantidadCedos} </td>
                <td>
                        {$button}
                </td>
            </tr>
        ";
        return $data;
    }

}