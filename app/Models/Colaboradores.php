<?php
    namespace App\Models;

    class Colaboradores extends DBAbstractModel {
        private static $instancia;

        public static function getInstancia() {
            if (!isset(self::$instancia)) {
                $miclase = __CLASS__;
                self::$instancia = new $miclase;
            }
            return self::$instancia;
        }

        public function getByCredentials($user = "", $password = "") {
            if ($user != "" && $password != "") {
                $this -> query = "SELECT * FROM colaboradores WHERE usuario = :user AND password = :password";
                $this -> params["user"] = $user;
                $this -> params["password"] = $password;
                $this -> get_results_from_query();
            }

            if (count($this -> rows) == 1) {
                foreach ($this -> rows[0] as $propiedad => $valor) {
                    $this -> $propiedad = $valor;
                }
                $this -> mensaje = "Usuario encontrado";
            } else {
                $this -> mensaje = "Usuario no encontrado";
            }

            return $this -> rows[0] ?? null;
        }

        public function addPoint($id = "") {
            if ($id != "") {
                $this -> query = "UPDATE colaboradores SET saldo = saldo + 10 WHERE id = :id";
                $this -> params["id"] = $id;
                $this -> get_results_from_query();
            }
        }

        public function get() {
            $this->query = "SELECT * FROM colaboradores";
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