<?php
    namespace App\Models;

    class Administradores extends DBAbstractModel {
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
                $this -> query = "SELECT * FROM administradores WHERE usuario = :user AND password = :password";
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
        public function get() {}
        public function set() {}
        public function edit() {}
        public function delete() {}
    }