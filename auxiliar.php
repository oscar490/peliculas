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
