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

        try {
            comprobarParametro($titulo);

        } catch (Exception $e) {
            mostrarErrores($e);
        }

        ?>
    </body>
</html>
