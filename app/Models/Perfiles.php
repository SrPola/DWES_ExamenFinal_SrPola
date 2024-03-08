<?php
    namespace App\Models;

    class Perfiles extends DBAbstractModel {
        private static $instancia;

        public static function getInstancia() {
            if (!isset(self::$instancia)) {
                $miclase = __CLASS__;
                self::$instancia = new $miclase;
            }
            return self::$instancia;
        }

        public function get() {
            $this->query = "SELECT * FROM perfiles";
            $this->get_results_from_query();
            if (count($this->rows) == 1) {
                foreach ($this->rows[0] as $propiedad=>$valor) {
                    $this->$propiedad = $valor;
                }
                return $this->rows[0];
            }
            return $this->rows;
        }
        
        public function set() {}
        public function edit() {}
        public function delete() {}
    }