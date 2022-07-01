<?php 
require_once("connect.php");
require_once("sqlConsult.php");

class animal{
    private $Id;
    public $IdLote;
    public $EstaMuerto;
    public $FechaFallecimiento;
    public $Precio;
    public $EstaVendido;
    public $Foto;
    public $Descripcion;
    public $Peso;
    public $Color;
    function __construct($data)
    {
        $obj = new conexion();
        $con = $obj->predetermined();
        $model = new Models($con);
        $this->Id = $data["Id"];
        $this->IdLote = $data["Lote"];
        $this->EstaMuerto = ($data["EstaMuerto"]=="0")?"No":"Si";
        if($data["EstaMuerto"] == 1){
            $this->FechaFallecimiento = $data["FechaFallecimiento"];
        }else{
            $this->FechaFallecimiento = "-";
        }
        $this->EstaVendido = ($data["EstaVendido"] == "0")?"No":"Si";  
        $model->put('OtrosAtributos');
        $array_foto = mysqli_fetch_array($model->SQLqueryMost(['IdRegistroAnimal','Nombre'],[$this->Id,'foto']));
        $array_caracteristica = mysqli_fetch_array($model->SQLqueryMost(['IdRegistroAnimal','Nombre'],[$this->Id,'caracteristicas']));
        $array_color = mysqli_fetch_array($model->SQLqueryMost(['IdRegistroAnimal','Nombre'],[$this->Id,'color']));
        $array_peso = mysqli_fetch_array($model->SQLqueryMost(['IdRegistroAnimal','Nombre'],[$this->Id,'peso']));
        $array_precio = mysqli_fetch_array($model->SQLqueryMost(['IdRegistroAnimal','Nombre'],[$this->Id,'precio']));      
        $this->Foto = $array_foto["Valor"];
        $this->Precio = $array_precio["Valor"];
        $this->Color = $array_color["Valor"];
        $this->Descripcion = $array_caracteristica["Valor"];
        $this->Peso = $array_peso["Valor"];
    }
    function getId(){
        return $this->Id;
    }
    function getData(){
        if($this->Foto == ""){
            $this->Foto = "../images/pig.png";
        }else{
            $this->Foto = "../images/detalleRegistroAnimal/".$this->Foto;
        }
        $data = "
            <tr>
                <td><img class='mr-3 img-fluid rounded' width='85'
                src='{$this->Foto}'
                alt='DexignZone'>
                <td> {$this->Descripcion} </td>
                <td> {$this->Peso} kg</td>
                <td> {$this->Color} </td>
                <td> {$this->Precio} </td>
                <td> {$this->EstaMuerto} </td>
                <td> {$this->FechaFallecimiento} </td>
                <td> {$this->EstaVendido} </td>
            </tr>
        ";
        return $data;
    }

}