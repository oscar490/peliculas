<?php session_start() ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Hacer Borrado de película</title>
    </head>
    <body>
        <?php
        require 'auxiliar.php';

        $id = filter_input(INPUT_POST, 'id');
        var_dump($id);
        $pdo = conectar();

        try {
            comprobarParametro($id);
            $fila = comprobarPelicula($pdo, $id);

            if (borrarPelicula($pdo, $id)) {
              $nombrePelicula = $fila['titulo'];
              $_SESSION['mensaje'] = "Se ha borrado la película $nombrePelicula";
              header('Location: index.php');
            }


        } catch (Exception $e) {
            mostrarErrores($e);
        }

        ?>
    </body>
</html>
