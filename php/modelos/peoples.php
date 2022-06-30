<?php 
require_once("connect.php");
require_once("sqlConsult.php");

class people{

    private $NoDocumento;
    public $TipoDocumento;
    public $NombreCompleto;
    public $FechaNacimiento;
    public $Telefono;
    public $Genero;
    public $Email;
    public $Direccion;
    public $Foto;
    public $Municipio;
    public $Model;
    public $userCliente = "";
    public $url = "";
    public $is_complet =  0;

    function __construct($data)
    {
        $this->NoDocumento = $data["NoDocumento"];
        $this->TipoDocumento = $data["TipoDocumento"];
        $this->NombreCompleto = $data["Nombre_Completo"];
        $this->Genero = $data["Sexo"];
        $this->FechaNacimiento = $data["FechaNacimiento"];
        $this->Telefono = $data["Telefono"];
        $this->Email = $data["Email"];
        $this->Direccion = $data["Direccion"];
        $this->Municipio = $data["Municipio"];
        $this->Foto = $data["Foto"];
    }


    function getNodocumento(){
        return $this->NoDocumento;
    }
    function getFoto(){
        $file = URL.'vendor/img/'.$this->Foto;
        $file = str_replace(' ','%20',$file);

        if(false == file($file)){
            $file = URL.'vendor/img/user.png';
        }
        return $file;
    }
    function getRol() {
        $obj = new conexion();
        $con = $obj->predetermined();
        $model = new Models($con);
        $model->put("Relacion_Persona_Rol");
        $data = mysqli_fetch_array($model->SQLqueryDuos('NoDocumento', $this->NoDocumento));
        if($data["IdRol"] == 1){
            return "Administrador";
        }else {
            return "Jefe De Granja";
        }

    }

    function getData(){
        if($this->Foto == ""){
            $this->Foto = "../images/profile/user.png";
        }
        $Genero = ($this->Genero == 0)?'Femenino':'Masculino';
        $data = "
            <tr>
                <td>
                <img class='ounded-circle' width='35' src='{$this->Foto}' alt=''>
                 
                 </td>
                <td> {$this->NoDocumento} </td>
                <td> {$this->NombreCompleto} </td>
                <td> {$Genero}</td>
                <td> {$this->getRol()}</td>
                <td> {$this->Boar($this->Telefono)}</td>
                <td> {$this->Boar($this->Email)}</td>
                <td> {$this->Boar($this->Direccion)}</td>
                <td> {$this->Boar($this->Municipio)}</td>
                <td>
                <div class='d-flex justify-content-center'>
                    <a href='./editUser/".$this->NoDocumento."' class='btn btn-primary shadow btn-xs sharp mr-1'><i class='fa fa-pencil'></i></a>
                </div>
                </td>
            </tr>
        ";
        return $data;
    }


    // function getNombreshort(){
    //     $name = $this->PrimerNombre." ".$this->PrimerApellido;
    //     return $name;
    // }
    function getNombreCompleto(){
        $name = $this->NombreCompleto;
        return $name;
    }
    function useModel(){
        $con =  new conexion();
        $con->predetermined();
        $this->Model = new Models($con);
    }

    function get_people($NoDocumento){
        $this->useModel();
        $this->Model->put("Persona");
        $data = mysqli_fetch_array($this->Model->returnDataUser($NoDocumento));
        return $data; 
    }
    /*function getTipoDocumento($type = false){
        $this->useModel("administrador");
        $this->Model->put("tipodocumento");
        $data = mysqli_fetch_array($this->Model->SQLqueryDuos("id",$this->TipoDocumento));
        if($type == false){
            return $data['Nombre'];
        }
        return $data['Sigla'];
    }*/
    function getGenero(){
        // $this->Model->put("genero");
        // $data = mysqli_fetch_array($this->Model->SQLqueryDuos("Codigo",$this->Genero));
        if($this->Genero == 0 ){
            return "Femenino";
        }
        return "Masculino";
    }
    function getMunicipio(){
        $this->Model->put('municipios');
        $SQLarray = mysqli_fetch_array($this->Model->SQLqueryDuos("id_municipio",$this->Municipio));
        return $SQLarray['municipio'];
    }
    function setCustomer($name){
        $this->userCliente = $name;
    }
    function setUrl($name){
        $this->url = $name;
    }
    function is_vacio($name){
        if($name == "" || $name == NULL || $name == 'NULL'){
            return "";
        }
        return $name;
    }
    function getDataProveedor($rol,$data){
        $this->useModel($rol);
        $file = URL.'vendor/img/'.$this->Foto;
        $file = str_replace(' ','%20',$file);

        if(false == file($file)){
            $file = URL.'vendor/img/user.png';
        }
        $y = "No";
        if($data['EsEmpresa'] == 1){
            $y = "Si";
        }
        $Estado = "Activo";
        $color_celda = "";
        if($data['Estado'] != 1){
            $Estado = "Inactivo";
            $color_celda = "bg-danger";
        }
        $data = "
            <tr>
                <td> {$this->NoDocumento}</td>
                <td> {$this->NombreCompleto}</td>
                <td> {$this->Boar($data['Nombre'])}</td>
                <td> {$this->Boar($data['NIT'])}</td>
                <td> {$this->Boar($y)}</td>
                <td> <img src='{$file}' class='photos' style='cursor:pointer;'></td>
                <td class='$color_celda'><b>$Estado</b></td>
                <td> <a class='btn btn-icons btn-rounded btn-inverse-outline-primary' href='".$this->url."register/".$this->NoDocumento."'><i class='mdi mdi-pencil'></i><a href='".$this->url."users/".$this->NoDocumento."' class='badge badge-warning'>Roles</a></a></td>
            </tr>
        ";
        return $data;
    }
    function getDataCustomer($rol,$activo){
        $this->useModel($rol);
        $file = URL.'vendor/img/'.$this->Foto;
        $file = str_replace(' ','%20',$file);

        if(false == file($file)){
            $file = URL.'vendor/img/user.png';
        }
        $color_celda = "";
        if($activo == "Inactivo"){
            $color_celda = "bg-danger";
        }
        $data = "
            <tr>
                <td> {$this->NoDocumento}</td>
                <td> {$this->NombreCompleto} </td>
                <td> <img src='{$file}' class='photos' style='cursor:pointer;'></td>
                <td class='$color_celda'> <b>{$activo}</b></td>
                <td> <a class='btn btn-icons btn-rounded btn-inverse-outline-primary' href='".$this->url."register/".$this->NoDocumento."'><i class='mdi mdi-pencil'></i><a href='".$this->url."users/".$this->NoDocumento."' class='badge badge-warning'>Roles</a></a></td>
            </tr>
        ";
        return $data;
    }
    function Boar($boar,$ot = false){
        if($boar == null || $boar == "NULL" || $boar == "Sin cuenta" || $boar == "0000-00-00"){
            $this->is_complet = $this->is_complet+1;
            if($ot == false){
                return "<a  href='".$this->url."register/".$this->NoDocumento."' class='badge badge-success'>Completar Usuario</a>";
            }else{
                return "";
            }
        }
        return $boar;
    }
    
    function getDirectoyCustomer($datas,$Estado){
        $this->useModel('Administrador');
        $data = "<tr>";
        for ($i=0; $i < count($datas); $i++) { 
            $name = $datas[$i];
            switch($name){
                case 'tipodocumento':
                    $name = $this->TipoDocumento;
                    $data .= "<td> {$name}</td>";
                    break;
                case 'Genero':
                    $data .= "<td> {$this->getGenero()}</td>";
                    break;
                case 'Municipio':
                    $data .= "<td> {$this->getMunicipio()}</td>";
                    break;
                case 'Foto':
                    $data .= "<td> <img src='{$this->getFoto()}' class='photos' style='cursor:pointer;'></td>";
                    break;
                case 'Estado':
                    $color_celda = "";
                    if($Estado == "Inactivo"){
                        $color_celda = "bg-danger";
                    }
                    $data .= "<td class='$color_celda'><b>$Estado</b></td>";
                    break;
                default:
                    $data .= "<td> {$this->Boar($this->$name)}</td>";
                    break;
            }
        }
        $data .= "</tr>";
        /*$data = "
            <tr>
                <td> {$this->PrimerNombre} {$this->SegundoNombre}</td>
                <td> {$this->PrimerApellido} {$this->SegundoApellido}</td>
                <td> {$this->Telefono}</td>
                <td> {$this->Direccion}</td>
                <td> {$this->Email}</td>
            </tr>
        ";*/
        return $data;

        
    }
    
}