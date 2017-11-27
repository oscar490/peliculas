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

        $titulo = filter_input(INPUT_POST, 'titulo');
        $pdo = conectar();

        try {
            comprobarParametro($titulo);
            comprobarPelicula($pdo, $titulo);

            if (borrarPelicula($pdo, $titulo)) {
              $_SESSION['mensaje'] = 'Se ha borrado la película';
              header('Location: index.php');
            }
            var_dump($_SESSION);

        } catch (Exception $e) {
            mostrarErrores($e);
        }

        ?>
    </body>
</html>
