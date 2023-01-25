<?php
    include_once("../Config/Database.php");

    class Color {
        private $id;
        private $descripcion;        

        public function __construct()
        {            
        }

        public function setId($_ID) {
            $this->id = $_ID;
        }
        
        public function getId() {
            return $this->id;
        }

        /**
         * Get the value of descripcion
         */ 
        public function getDescripcion()
        {
                return $this->descripcion;
        }

        /**
         * Set the value of descripcion
         *
         * @return  self
         */ 
        public function setDescripcion($descripcion)
        {
                $this->descripcion = $descripcion;

                return $this;
        }

        public function BuscarTodos() {
            $conn = new DataBase();

            $sql = "select * from color;";
            $stmt = $conn->ms->prepare($sql);            
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all();
        }

        public function BuscarPorId() {
            $conn = new DataBase();

            $sql = "select * from color where id = ?;";
            $stmt = $conn->ms->prepare($sql);
            $stmt->bind_param("i",$this->id);
            $stmt->execute();
            $result = $stmt->get_result();
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return json_encode($data);
        }
    }
?>