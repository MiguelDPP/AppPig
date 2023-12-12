<?php
    class conexion{

        private $HOST = $_ENV['HOST'];
        private $USER= $_ENV['USER'];
        private $PASSWORD= $_ENV['PASSWORD'];
        private $BD = $_ENV['BD'];
        private $CHARSET = "utf8";


        private function connect($is_pure){
            if($is_pure){
                $con = mysqli_connect($this->HOST,$this->USER,$this->PASSWORD);
            }else{
                $con = mysqli_connect($this->HOST,$this->USER,$this->PASSWORD,$this->BD);
            }
            if($con){
                mysqli_set_charset($con, $this->CHARSET);
            }
     
            return $con;
        }

        private function UpdateValues($USER, $PASSWORD, $BD){
            $this->USER = $USER;
            $this->PASSWORD = $PASSWORD;
            $this->BD = $BD;
        } 

        public function pure(){
            return $this->connect(true);
        }

        public function personalized($USER, $PASSWORD, $BD){
            //$this->UpdateValues($USER, $PASSWORD, $BD);
            return $this->connect(false);
        }

        public function personalized2($USER, $PASSWORD){
            //$this->USER = $USER;
            //$this->PASSWORD = $PASSWORD;
            return $this->connect(true);
        }

        public function predetermined(){
            //$this->UpdateValues("root","", "micastore");
            return $this->connect(false);
        }

        public function dataTable($BD){
            //$this->UpdateValues("root",  "", $BD);
            return $this->connect(false);
        }
        public function Invitado(){
            return $this->personalized('Invitado','12345','micastore');
        }
        public function Administrador(){
            return $this->personalized('root','','micastore');
        }
    }
?>
