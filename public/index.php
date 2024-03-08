<?php
    require_once "../vendor/autoload.php";

    require_once "../bootstrap.php";
    
    use App\Controllers\AuthController;
    use App\Controllers\ColaboController;
    use App\Controllers\AdminController;
    use App\Core\Router;
    use App\Controllers\IndexController;
    use App\Models\Perfiles;

    

    session_start();

    if (!isset($_SESSION['perfil'])) {
        $_SESSION['perfil'] = "invitado";
    }

    $perfiles = ["invitado"];
    $perfiles_servidor = Perfiles::getInstancia()->get();
    foreach ($perfiles_servidor as $perfil) {
        $perfiles[] = $perfil['perfil'];
    }

    $router = new Router();
    $router->add(array(
        "name" => "home", // Nombre de la ruta
        "path" => "/^\/$/", // Expresión regular con la que extraemos la ruta de la URL
        "action" => [IndexController::class, "indexAction"], // Clase y metedo que se ejecuta cuando se busque esa ruta
        "auth" => $perfiles) // Perfiles de autenticación que pueden acceder
    );

    $router->add(array(
        "name" => "Login",
        "path" => "/^\/login$/", 
        "action" => [AuthController::class, "loginAction"], 
        "auth" => ["invitado"])
    );

    $router->add(array(
        "name" => "Logout",
        "path" => "/^\/logout$/", 
        "action" => [AuthController::class, "logoutAction"], 
        "auth" => $perfiles)
    );

    $router->add(array(
        "name" => "recetas",
        "path" => "/^\/recetas$/", 
        "action" => [ColaboController::class, "addAction"], 
        "auth" => ["Colaborador"])
    );

    $router->add(array(
        "name" => "Admin",
        "path" => "/^\/admin$/", 
        "action" => [AdminController::class, "listarAction"], 
        "auth" => ["Administrador"])
    );

    $request = $_SERVER['REQUEST_URI']; // Recoje URL
    $route = $router->match($request); // Busca en todas las rutas hasta encontrar cual coincide con la URL
    
    if ($route) {
        if (in_array($_SESSION['perfil'], $route['auth'])) {
            $className = $route['action'][0];
            $classMethod = $route['action'][1];
            $object = new $className;
            $object->$classMethod($request);
        } else {
            header("Location: /");
        }
    } else {
        exit(http_response_code(404));
    }
