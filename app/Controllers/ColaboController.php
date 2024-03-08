<?php
    namespace App\Controllers;
    use App\Models\Recetas;
    use App\Models\Colaboradores;

    class ColaboController extends BaseController{
        public function addAction() {
            if (!isset($_POST) || empty($_POST)) {
                $data = [
                   
                    "perfil" => $_SESSION["perfil"],
                ];
                $this->renderHTML("../app/Views/add_view.php", $data);
            } else {
                Recetas::getInstancia()->addReceta($_POST, $_SESSION["usuario"]["id"]);
                Colaboradores::getInstancia()->addPoint($_SESSION["usuario"]["id"]);
                // header("Location: /");
            }
        }
    }
