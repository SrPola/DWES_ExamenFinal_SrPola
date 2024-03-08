<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="SrPola">
        <title>Index View</title>
    </head>
    <body>
        <header>
            <h1>Recetas</h1>
            <?php
                if ($data["perfil"] == "invitado") {
            ?>
                <form action="/login" method="post">
                    <input type="text" name="usuario" id="usuario" placeholder="Usuario">
                    <input type="password" name="password" id="password" placeholder="Contraseña">
                    <label for="perfil">Seleccione el perfil:</label>
                    <select name="perfil" id="perfil">
                    <?php  
                        foreach ($data["perfiles"] as $perfil) {
                            echo '<option value="'.$perfil["perfil"].'">'.$perfil["perfil"].'</option>';
                        }
                    ?>
                    </select>
                    <?php 
                        $num1 = rand(1, 9);
                        $num2 = rand(1, 9);
                        $resultado_correcto = $num1 + $num2;

                        $resultados = [$num1 + $num2, $num1 - $num2, $num1 * $num2, $num1 / $num2];
                        
                        shuffle($resultados);
                        echo "Captcha: $num1 + $num2 = ?";
                        echo "<input type='hidden' name='resultado_correcto' value='$resultado_correcto'>";
                        for ($i = 0; $i < count($resultados); $i++) {
                            echo "<input type='radio' name='respuesta' value='$resultados[$i]'>";
                            echo round($resultados[$i], 2);
                        }

                    ?>
                    <br>
                    <input type="submit" value="Iniciar sesión">
                    <br>
                    <br>
                </form>
            <?php
                            
                } else {
                    echo "<p>Bienvenido, usted está como ".$_SESSION['perfil']."</p>";
                    echo '<a href="/logout">Cerrar sesión</a>';
                }
            ?>
        </header>
        <nav>
            <ul>
                <li><a href="/">Inicio</a></li>
                <?php
                    switch ($data["perfil"]) {
                        case 'Administrador':
                            echo '<li><a href="/admin">Administrar</a></li>';
                            break;
                        case 'Suscriptor':
                            // echo '<li><a href="/suscripciones">Suscripciones</a></li>';
                            break;
                        case 'Colaborador':
                            echo '<li><a href="/recetas">Recetas</a></li>';
                            break;
                    }
                ?>
                
            </ul>
        </nav>
        <main>
            <!-- <form action="/" method="post">
                <lavel for="buscar">Buscar:</label>
                <input type="checkbox" name="" id="">
                <input type="submit" value="Buscar">
            </form> -->
            <br>
            <?php
                foreach ($data["recetas"] as $receta) {
                    $imagen = "img_".(explode("_", $receta['imagen'])[1] ?? "");
                    echo "<div style='border: 1px solid black'>";
                        echo '<img src="/img/'.$imagen.'" alt="'.$receta['titulo'].'" style="max-width: 200px">';
                        echo "<p>".$receta["titulo"]."</p>";
                        echo "<p>".$receta["ingredientes"]."</p>";
                        echo "<p>".$receta["elaboracion"]."</p>";
                        echo "<p>".$receta["etiquetas"]."</p>";
                    echo "</div>";
                } 
            ?>
        </main>
    </body>
</html>