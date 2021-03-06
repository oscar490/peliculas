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
    $sent = $pdo->prepare("SELECT p.id, p.titulo, p.anyo, p.sinopsis, g.nombre
                               AS genero
                             FROM peliculas p
                             JOIN generos g
                               ON p.genero_id = g.id
                            WHERE lower(titulo) LIKE lower(:titulo)");
    $sent->execute([':titulo' =>  "%$titulo%"]);

    return $sent->fetchAll();
}

function comprobarParametro($parametro)
{
    if ($parametro === null) {
        throw new Exception('Parámetro incorrecto');
    }
}

function comprobarPelicula(PDO $pdo, int $id): array
{

    $sent = $pdo->prepare("SELECT *
                     FROM peliculas
                    WHERE id = :id");

    $sent->execute([':id'=>$id]);

    if ($sent->rowCount() === 0) {
        throw new Exception('La Película no existe');
    }

    return $sent->fetch();

}

function borrarPelicula(PDO $pdo, $id)
{
  $sent = $pdo->prepare("DELETE FROM peliculas
                               WHERE id = :id");

  return $sent->execute([':id'=>$id]);

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
            <?php foreach ($consulta as $filas):?>
                <tr>
                    <td><?= h($filas['titulo'])?></td>
                    <td><?= h($filas['anyo'])?></td>
                    <td><?= h($filas['sinopsis'])?></td>
                    <td><?= h($filas['genero'])?></td>
                    <td>
                        <form action="hacer_borrado.php" method="post">
                            <input type="hidden" name="id" value="<?= $filas['id']?>">
                            <input type="submit"  value="Borrar">
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php
}

function mostrarErrores(Exception $e)
{
    ?>
        <h3>Error: <?= $e->getMessage()?></h3>
        <a href="index.php">Volver</a>
    <?php
}
