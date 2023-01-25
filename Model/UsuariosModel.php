<?php
    include_once("../Config/Database.php");

    class UsuariosModel {
        private $id;
        private $usuario;
        private $password;
        private $matricula;

        public function __construct()
        {            
        }

        public function setId($_ID) {
            $this->id = $_ID;
        }
        
        public function getId() {
            return $this->id;
        }
        
        public function setUsuario($_usuario) {
            $this->usuario = $_usuario;
        }
        
        public function getUsuario() {
            return $this->usuario;
        }        

        public function setPassword($_password) {
            $this->password = $_password;
        }
        
        public function getPassword() {
            return $this->password;
        }

        public function setMatricula($_matricula) {
            $this->matricula = $_matricula;
        }
        
        public function getMatricula() {
            return $this->matricula;
        }

        public function crear() {
            $conn = new DataBase();

            $sql = "insert into usuarios(id,usuario,password) values (null,?,?);";
            $stmt = $conn->ms->prepare($sql);
            $stmt->bind_param("ss",$this->usuario,$this->password);
            $stmt->execute();
            $id = $stmt->insert_id;
            return ($id);
        }

        public function BuscarUsuario() {
            $conn = new DataBase();

            $sql = "select * from usuarios where usuario = ? and password = ?;";
            $stmt = $conn->ms->prepare($sql);
            $stmt->bind_param("ss",$this->usuario,$this->password);
            $stmt->execute();
            $result = $stmt->get_result();            
            while ($row = $result->fetch_assoc()) {                
                if($row != null) {
                    return true;
                }
            }            
        }

        public function eliminar() {
            $conn = new DataBase();
            
            $sql = "delete from vehiculo where id = ?;";
            $stmt = $conn->ms->prepare($sql);
            $stmt->bind_param("i",$this->id);
            $stmt->execute();
        }
    }
?>