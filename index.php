<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Página Principal</title>
    </head>
    <body>
        <?php
            require 'auxiliar.php';

            $pdo = conectar();

            $sent = $pdo->query("SELECT titulo, anyo, sinopsis, nombre
                            AS genero
                          FROM peliculas p
                          JOIN generos g
                            ON p.genero_id = g.id");

            $consulta = $sent->fetchAll();
        ?>
        <table border="1">
            <thead>
                <th>Título</th>
                <th>Año</th>
                <th>Sinopsis</th>
                <th>Género</th>
            </thead>
            <tbody>
                <?php foreach ($consulta as $filas): ?>
                    <tr>
                        <td><?= h($filas['titulo'])?></td>
                        <td><?= h($filas['anyo'])?></td>
                        <td><?= h($filas['sinopsis'])?></td>
                        <td><?= h($filas['genero'])?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </body>
</html>
