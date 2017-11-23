<?php

/**
 * Crea una conexión con la base de datos.
 * @return PDO  Instancia de la conexión
 */
function conectar(): PDO
{
    return new PDO('pgsql:host=localhost;dbname=peliculas', 'peliculas',
        'peliculas');
}

/**
 * Seaneamiento de salida
 * @param  string $cadena Cadena a sanear.
 * @return string         Cadena saneada.
 */
function h(string $cadena): string
{
    return htmlspecialchars($cadena, ENT_QUOTES);
}

/**
 * Busca una película a partir de su título.
 * @param  PDO    $pdo    Conexión con la Base de datos.
 * @param  string $titulo Titulo de la película
 * @return array          Array de las filas de la película encontrada.
 */
function buscarPelicula(PDO $pdo, string $titulo): array
{
    $sent = $pdo->prepare("SELECT titulo, anyo, sinopsis, nombre
                    AS genero
                  FROM peliculas p
                  JOIN generos g
                    ON p.genero_id = g.id
                 WHERE lower(titulo) LIKE lower(:titulo)");
    $sent->execute([':titulo' =>  "%$titulo%"]);

    if ($sent->rowCount() === 0) {
        throw new Exception('No existe la película');
    }

    return $sent->fetchAll();
}


function mostrarResultados(array $consulta)
{
    ?>
    <br />
    <table border="1" align='center'>
        <thead>
            <th>Título</th>
            <th>Año</th>
            <th>Sinopsis</th>
            <th>Género</th>
            <th>Operaciones</th>
        </thead>
        <tbody>
            <?php foreach ($consulta as $filas): ?>
                <tr>
                    <td><?= h($filas['titulo'])?></td>
                    <td><?= h($filas['anyo'])?></td>
                    <td><?= h($filas['sinopsis'])?></td>
                    <td><?= h($filas['genero'])?></td>
                    <td><a href='borrar.php'>Borrar</a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php
}

function mostrarErrores(Exception $e)
{
    ?>
        <h3><?= $e->getMessage()?></h3>
        <a href="index.php">Volver</a>
    <?php
}
