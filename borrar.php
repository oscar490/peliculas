<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Borrar una Película</title>
    </head>
    <body>
        <?php

        require 'auxiliar.php';

        $titulo = filter_input(INPUT_GET, 'titulo');
        $pdo = conectar();
        var_dump($titulo);
        try {
            comprobarParametro($titulo);
            $filas = comprobarPelicula($pdo, $titulo);

            ?>
            <h3>¿Seguro que desea borrar la película <?= $filas['titulo'] ?>?</h3>

            <form action="hacer_borrado.php" method="post">
                <input type="submit" value="Si">
                <input type="hidden" name="titulo" value="<?= $filas['titulo'] ?>">
                <a href='index.php'>No</a>
            </form>
            <?php
        } catch (Exception $e) {
                mostrarErrores($e);

        }

        ?>
    </body>
</html>
