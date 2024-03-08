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
            <h2>Añadir receta:</h2>
            <form action="/recetas" method="post">
                <input type="text" name="titulo" id="titulo" placeholder="Título">
                <textarea name="descripcion" id="descripcion" cols="30" rows="10" placeholder="Descripción"></textarea>
                <input type="text" name="ingredientes" id="ingredientes" placeholder="Ingredientes">
                <input type="text" name="elaboracion" id="elaboracion" placeholder="Elaboración">
                <input type="text" name="etiquetas" id="etiquetas" placeholder="Etiquetas">
                <input type="text" name="imagen" id="imagen" placeholder="Nombre imagen">
                <input type="submit" value="Añadir">
            </form>
            <br>
        </main>
    </body>
</html>