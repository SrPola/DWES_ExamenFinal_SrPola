<?php
    namespace App\Controllers;
    use App\Models\Colaboradores;
    use App\Models\Config;

    class AdminController extends BaseController{
        public function listarAction() {
            $data = [
                "colaboradores" => Colaboradores::getInstancia()->get(),
                "perfil" => $_SESSION['perfil'],
                "beneficios" => (Config::getInstancia()->get())["beneficios"],
            ];
            $this->renderHTML("../app/Views/admin_view.php", $data);
        }
    }
