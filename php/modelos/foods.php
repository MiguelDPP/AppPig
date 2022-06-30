<?php 
require_once("connect.php");
require_once("sqlConsult.php");

class food{
    private $Id;
    public $Lote;
    public $Nombre;
    public $Cantidad;
    public $Precio;
    public $FechaCompra;
    function __construct($data)
    {
        $this->Id = $data["Id"];
        $this->Nombre = $data["Nombre"];
        $this->Lote = $data["Lote"];
        $this->Cantidad = $data["Cantidad"];
        $this->Precio = $data["Precio"];
        $this->FechaCompra = $data["FechaCompra"];
    }
    function getId(){
        return $this->Id;
    }
    function getData($admin){
        $button = "";
        if($admin){
            $button = "<div class='d-flex justify-content-center'>
            <button class='edit btn btn-primary shadow btn-xs sharp mr-1' value='{$this->Id}'><i class='fa fa-pencil'></i></button>
            <button class='delete btn btn-danger shadow btn-xs sharp mr-1' value='{$this->Id}'><i class='mdi mdi-delete'></i></button>
            </div>";    
        }
        $obj = new conexion();
        $con = $obj->predetermined();
        $model = new Models($con);
        $model->put("Lotes");
        $CantidadCerdos = mysqli_fetch_array($model->SQLqueryDuos('Id',$this->Lote));
        $data = "
            <tr>
                <td idLote='{$this->Lote}'> {$CantidadCerdos["Nombre"]} </td>
                <td> {$this->Nombre} </td>
                <td> {$this->Cantidad} </td>
                <td> {$this->Precio} </td>
                <td> {$this->FechaCompra} </td>
                <td>
                        {$button}
                </td>
            </tr>
        ";
        return $data;
    }

}