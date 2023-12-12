<?php
    require __DIR__ . '/vendor/autoload.php';
   
    class conexion{
         
        private $HOST = "";
        private $USER= "";
        private $PASSWORD= "";
        private $BD = "";
        private $CHARSET = "utf8";
        private $PORT = "";


        private function connect($is_pure){
            $envPath = './';
            $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
            $dotenv->load();

            $this->HOST = $_ENV['HOST'];
            $this->USER= $_ENV['USER'];
            $this->PASSWORD= $_ENV['PASSWORD'];
            $this->BD = $_ENV['BD'];
            $this->PORT = $_ENV['PORT'];
            if($is_pure){
                $con = mysqli_connect($this->HOST,$this->USER,$this->PASSWORD);
            }else{
                $con = mysqli_connect($this->HOST,$this->USER,$this->PASSWORD,$this->BD, $this->PORT);
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
