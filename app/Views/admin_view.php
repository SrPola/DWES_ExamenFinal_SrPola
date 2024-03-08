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
                echo "<p>Bienvenido, usted está como ".$_SESSION['perfil']."</p>";
                echo '<a href="/logout">Cerrar sesión</a>';
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
            <?php
                $saldo_total = 0;
                foreach ($data["colaboradores"] as $colaborador) {
                    $saldo_total += $colaborador['saldo'];
                }
                
                foreach ($data["colaboradores"] as $colaborador) {
                    $importe = ($colaborador['saldo'] / $saldo_total) * $data["beneficios"];
                    echo "<div>";
                        echo "<h2>".$colaborador['nombre']."</h2>";
                        echo "<p>".$colaborador['saldo']."</p>";
                        echo "<p>".round($importe, 2)."</p>";
                    echo "</div>";
                } 
            ?>
        </main>
    </body>
</html>