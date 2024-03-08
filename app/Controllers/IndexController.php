<?php
    namespace App\Controllers;
    use App\Models\Recetas;
    use App\Models\Perfiles;

    class IndexController extends BaseController{
        public function indexAction() {
            $data = [
                "recetas" => Recetas::getInstancia()->get(),
                "perfiles" => Perfiles::getInstancia()->get(),
                "perfil" => $_SESSION['perfil'],
            ];
            $this->renderHTML("../app/Views/index_view.php", $data); // La ruta parte de la ubicacion del fichero index.php
        }
    }
