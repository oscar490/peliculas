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
                $titulo = trim(filter_input(INPUT_GET, 'titulo')) ?? '';

                $pdo = conectar();

                $filasBuscadas = buscarPelicula($pdo, $titulo);
                mostrarResultados($filasBuscadas);

            } catch (Exception $e) {
                mostrarErrores($e);
            }
        ?>
    </body>
</html>
