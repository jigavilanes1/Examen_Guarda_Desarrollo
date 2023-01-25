<?php
    include_once("../Config/Database.php");

    class Marca {
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
    }
?>