<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Insertat una película nueva</title>
  </head>
  <body>
    <?php
    require 'auxiliar.php';

    $titulo = trim(filter_input(INPUT_GET, 'titulo'));
    $anyo = trim(filter_input(INPUT_GET, 'anyo', FILTER_VALIDATE_INT));
    $sinopsis = trim(filter_input(INPUT_GET, 'sinopsis'));
    $genero_id = trim(filter_input(INPUT_GET, 'genero_id', FILTER_VALIDATE_INT));
    $pdo = conectar();

    var_dump($titulo);
    var_dump($anyo);
    var_dump($sinopsis);
    var_dump($genero_id);

    if (!empty($_GET)) {
      try {
        comprobarTitulo($titulo);
        comprobarAnyo($anyo);

        comprobarGenero($pdo, $genero_id);
      } catch (Exception $e) {
        mostrarErrores($e);
      }
    }

    ?>

    <form class="" action="insertar.php" method="get">
      <div class="">
        <label for="titulo">Título:* </label>
        <input type="text" name="titulo" id='titulo'>
      </div><br>

      <div class="">
        <label for="anyo">Año: </label>
        <input type="text" name="anyo" id='anyo' >
      </div><br>

      <div class="">
        <label for="sinopsis">Sinopsis: </label><br>
        <textarea name="sinopsis" id='sinopsis' rows="8" cols="80"></textarea>
      </div><br>


      <div class="">
        <label >Género:* </label>
        <select class="" name="genero_id">
          <option value="1">Acción</option>
          <option value="2">Terror</option>
          <option value="3">Suspense</option>
          <option value="4">Animación</option>
          <option value="5">Comedia</option>
        </select>
      </div><br>

      <input type="submit" value="Insertar">
    </form>

  </body>
</html>
