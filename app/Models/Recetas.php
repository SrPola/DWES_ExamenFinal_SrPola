<?php
    namespace App\Models;

    class Recetas extends DBAbstractModel {
        private static $instancia;

        public static function getInstancia() {
            if (!isset(self::$instancia)) {
                $miclase = __CLASS__;
                self::$instancia = new $miclase;
            }
            return self::$instancia;
        }
        
        public function get() {
            $this->query = "SELECT * FROM recetas";
            $this->get_results_from_query();
            if (count($this->rows) == 1) {
                foreach ($this->rows[0] as $propiedad=>$valor) {
                    $this->$propiedad = $valor;
                }
                return $this->rows[0];
            }
            return $this->rows;
        }

        public function addReceta($datos_formulario, $idColaborador) {
            $this->query = "INSERT INTO recetas (titulo, ingredientes, elaboracion, etiquetas, imagen, idColaborador) VALUES (:titulo, :ingredientes, :elaboracion, :etiquetas, :imagen, :idColaborador)";
            foreach ($datos_formulario as $key => $value) {
                $this->params[$key] = $value;
            }
            $this->params["idColaborador"] = $idColaborador;
            $this->get_results_from_query();
        }

        public function set() {}
        public function edit() {}
        public function delete() {}
    }