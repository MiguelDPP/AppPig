<?php
date_default_timezone_set('America/Bogota');
    /*class consult{
        private $con;

        function __construct($con){
            $this->con = $con;
        }
        function select($tabla, $column, $condicion, $agrupamiento){
            $sqlQuery = 'SELECT';
            if(count($column)==0){
                $sqlQuery.= "* FROM";
                
            }else{
                foreach($column as $col){
                    $sqlQuery .= " $col";
                }
                $sqlQuery.= " FROM";
            }
            foreach($tabla as $dato){
                $sqlQuery.= " $dato[0] as $dato[1]";
            }
            if($condicion !== ""){
                $sqlQuery.= " WHERE $condicion";
            }
            if($agrupamiento !== ""){
                $sqlQuery.= " group by $agrupamiento";
            }
            return mysqli_query($this->con, $sqlQuery);
        }
    }*/

    class Models{

        public $table;
        public $conexion;
        public $components;
    
        function __construct($con) {
            $this->conexion = $con;
            $this->components = new Components();
        }
        function put($name){
            $this->table = $name;
        }
        function name(){
            return $this->table;
        }
        function SQLquery(){
            $name = $this->name();
            return mysqli_query($this->conexion,"SELECT * FROM $name");
        }
        function SQLqueryOrderDescends($attr){
            $name = $this->name();
            return mysqli_query($this->conexion,"SELECT * FROM $name ORDER BY $attr DESC");
        }
        function SQLqueryDuos($where,$value){
            $name = $this->name();
            return mysqli_query($this->conexion,"SELECT * FROM $name WHERE $where = '$value'");
        }
        function SQLqueryPersonalized($conditions){
            $name = $this->name();
            return mysqli_query($this->conexion,"SELECT * FROM $name WHERE $conditions ");
        }
        function SQLqueryPersonalized2_0($Select,$From,$conditions){
            return mysqli_query($this->conexion,"SELECT $Select FROM $From WHERE $conditions ");
        }
        function SQLqueryDuosSearch($where,$value){
            $name = $this->name();
            return mysqli_query($this->conexion,"SELECT * FROM $name WHERE $where LIKE '%$value%'");
        }
        function SQLqueryDuosDescends($where,$value,$attr){
            $name = $this->name();
            return mysqli_query($this->conexion,"SELECT * FROM $name WHERE $where = '$value' ORDER BY $attr DESC ");
        }
        function SQLqueryDescends($sql,$attr){
            $name = $this->name();
            return mysqli_query($this->conexion,"SELECT * FROM $name WHERE $sql ORDER BY $attr DESC ");
        }
        function SQLqueryMost($wheres,$values){
            $name = $this->name();
            $comparations = $this->components->transformStringDuos($wheres,$values," AND ");
            return mysqli_query($this->conexion,"SELECT * FROM $name WHERE $comparations");
        }
        
        function SQLqueryRangeMost($wheres,$values,$r1,$r2){
            $name = $this->name();
            $r1 = intval($r1);
            $r2 = intval($r2);
            $comparations = $this->components->transformStringDuos($wheres,$values," AND ");
            return mysqli_query($this->conexion,"SELECT * FROM $name WHERE $comparations LIMIT $r1,$r2");
        }
        function insert($values){
            $name = $this->name();
            $data = $this->components->transformString($values);
            return mysqli_query($this->conexion,"INSERT INTO $name VALUES($data)");
        }
        function insert_null($values){
            $name = $this->name();
            $data = $this->components->transformString($values);
            return mysqli_query($this->conexion,"INSERT INTO $name VALUES(null,$data)");
        }
        function insertData($data, $value){
            $name = $this->name();
            $datas = $this->components->transformArray($data);
            $values = $this->components->transformString($value);
            return mysqli_query($this->conexion,"INSERT INTO $name($datas) VALUES($values)");
        }
        function edit($keys,$values,$where,$value){
            $name = $this->name();
            $data = $this->components->transformStringDuos($keys,$values," ,");
            return mysqli_query($this->conexion,"UPDATE $name SET $data WHERE $where = '$value'");
        }
        function edit2($keys,$values,$conditions){
            $name = $this->name();
            $data = $this->components->transformStringDuos($keys,$values," ,");
            return mysqli_query($this->conexion,"UPDATE $name SET $data WHERE $conditions");
        }
        function edit3($keys,$values){
            $name = $this->name();
            $data = $this->components->transformStringDuos($keys,$values," ,");
            return mysqli_query($this->conexion,"UPDATE $name SET $data ");
        }
        function delete($where,$value){
            $name = $this->name();
            return mysqli_query($this->conexion,"DELETE FROM $name WHERE $where = '$value'");
        }
        function list($where,$value){
            return $this->filter(1,$this->SQLqueryDuos($where,$value));
        }
        function listMost($wheres,$values){
            return $this->filter(1,$this->SQLqueryMost($wheres,$values));
        }
        function listAll(){
            return $this->filter(2,$this->SQLquery());
        }
        //----Nuevo-------
        function listLastOrder($colum){
            $name = $this->name();
            return mysqli_query($this->conexion,"SELECT * FROM $name ORDER BY $colum DESC");
        }
        function listLastOderLimit($colum, $lim1, $lim2){
            $name = $this->name();
            return mysqli_query($this->conexion,"SELECT * FROM $name ORDER BY $colum DESC LIMIT $lim1,$lim2");
        }
        function listFirtOderLimit($colum, $lim1, $lim2){
            $name = $this->name();
            return mysqli_query($this->conexion,"SELECT * FROM $name ORDER BY $colum LIMIT $lim1,$lim2");
        }
        function lastRow($attr){
            $name = $this->name();
            $sql = mysqli_query($this->conexion,"SELECT * FROM $name ORDER BY $attr DESC LIMIT 1");
            return $this->filter(1,$sql);
        }
        function generate_string($input, $strength = 16) {
            $input_length = strlen($input);
            $random_string = '';
            for($i = 0; $i < $strength; $i++) {
                $random_character = $input[mt_rand(0, $input_length - 1)];
                $random_string .= $random_character;
            }
            return $random_string;
        }
        //----------------
        function listAllDuos($where,$value){
            return $this->filter(1,$this->SQLqueryDuos($where,$value));
        }
        function SQLpersonalized($sql,$options){
            return $this->filter($options,mysqli_query($this->conexion,$sql));
        }
        function is_exist($where,$value){
            $result = $this->list($where,$value);
            if(empty($result)){
                return false;
            }
            return true;
        }
        function is_exist_personalized($sql){
            $result = $this->SQLpersonalized($sql,1);
            if(empty($result)){
                return false;
            }
            return true;
        }
        function is_exist_WheresMost($wheres,$values){
            $name = $this->name();
            $result = $this->filter(3,$this->SQLqueryMost($wheres,$values));
            if($result > 0){
                return true;
            }
            return false;
        }
        function rowCount($where,$value){
            return $this->filter(3,$this->SQLqueryDuos($where,$value));
        }
        function filter($options,$result){
            switch ($options) {
                case 1:
                    return mysqli_fetch_array($result);
                    break;
                case 2:
                    return mysqli_fetch_all($result,MYSQLI_BOTH);
                    break;
                case 3:
                    return mysqli_num_rows($result);
                    break;
                case 4:
                    return mysqli_fetch_assoc($result);
                    break;
            }
        }
        function returnDataUser($data){
            $this->table = "Persona"; 
            return $this->SQLqueryMost(['NoDocumento'],[$data]);
        }
    }

    // Components
    class Components {
        function transformString($values){
            $string = "";
            $k = count($values);
            for ($i=0; $i < $k ; $i++) {
                if($values[$i] != null){
                    if($i == ($k-1)){
                        $string .= "'".$values[$i]."'";
                    }else{
                        $string .= "'".$values[$i]."',";
                    }
                }else{
                    $string .= $values[$i];
                } 
            }
            return $string;
        }
        function transformArray($values){
            $string = "";
            $k = count($values);
            for ($i=0; $i < $k ; $i++) {
                if($values[$i] != null){
                    if($i == ($k-1)){
                        $string .= "".$values[$i]."";
                    }else{
                        $string .= "".$values[$i].",";
                    }
                }else{
                    $string .= $values[$i];
                } 
            }
            return $string;
        }
        function transformStringDuos($keys,$values,$Symbol){
            $string = "";
            $z = count($keys);
            for ($i=0; $i < $z ; $i++) { 
                if($i == ($z-1)){
                    $string .= $keys[$i]." = '$values[$i]'";
                }else{
                    $string .= $keys[$i]." = '$values[$i]' $Symbol ";
                }
            }
            return $string;
        }
    
    } 