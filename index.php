<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Página Principal</title>
    </head>
    <body>
        <form action="index.php" method="get">
            <label for="buscar">Buscar</label>
            <input type="text" name="titulo" id="buscar">

            <input type="submit" value="Buscar">
        </form>
        <?php
            try {
                require 'auxiliar.php';
                $titulo = filter_input(INPUT_GET, 'titulo');
                
                $pdo = conectar();
                $sent = $pdo->query("SELECT titulo, anyo, sinopsis, nombre
                                AS genero
                              FROM peliculas p
                              JOIN generos g
                                ON p.genero_id = g.id");

                $consulta = $sent->fetchAll();


                if (empty($_GET)) {
                    mostrarResultados($consulta);
                } else {
                    $filasBuscadas = buscarPelicula($pdo, $titulo);
                    mostrarResultados($filasBuscadas);
                }
            } catch (Exception $e) {
                mostrarErrores($e);
            }
        ?>
    </body>
</html>
