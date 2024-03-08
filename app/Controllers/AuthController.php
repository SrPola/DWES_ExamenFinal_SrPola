<?php
    namespace App\Controllers;
    use App\Models\Perfiles;
    use App\Models\Administradores;
    use App\Models\Suscriptores;
    use App\Models\Colaboradores;

    class AuthController extends BaseController{
        public function loginAction() {
            $perfiles = Perfiles::getInstancia()->get();

            var_dump($_POST);

            if (isset($_POST) && !empty($_POST)) {
                if ($_POST["respuesta"] == $_POST["resultado_correcto"]) {
                    foreach ($perfiles as $perfil) {
                        if ($perfil['perfil'] == $_POST['perfil']) {
                            switch ($_POST['perfil']) {
                                case 'Administrador':
                                    $admin = Administradores::getInstancia();
                                    $auth = $admin->getByCredentials($_POST['usuario'], $_POST['password']);
                                    if ($auth) {
                                        $_SESSION['perfil'] = $_POST['perfil'];
                                        $_SESSION["usuario"] = $auth;
                                    }
                                    header("Location: /");
                                case 'Suscriptor':
                                    $auth = Suscriptores::getInstancia()->getByCredentials($_POST['usuario'], $_POST['password']);
                                    if ($auth) {
                                        $_SESSION['perfil'] = $_POST['perfil'];
                                        $_SESSION["usuario"] = $auth;
                                    }
                                    header("Location: /");
                                case 'Colaborador':
                                    $auth = Colaboradores::getInstancia()->getByCredentials($_POST['usuario'], $_POST['password']);
                                    if ($auth) {
                                        $_SESSION['perfil'] = $_POST['perfil'];
                                        $_SESSION["usuario"] = $auth;
                                    }
                                    header("Location: /");
                            }
                        }
                    }
                }    
            }
            header("Location: /");
        }

        public function logoutAction() {
            session_destroy();
            header("Location: /");
        }
    }
