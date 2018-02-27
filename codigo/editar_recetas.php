<?php if (!isset($_SESSION)) {
    session_start();
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
  </head>
  <body>
    <?php if (isset($_SESSION["user"])&&($_SESSION["tipo"])=='admin')  :?>

      <?php if (isset($_SESSION["user"])&&($_SESSION["tipo"])=='admin') {
        include("../codigo/cabeceras/admin.php");
      } elseif (isset($_SESSION["user"])&&($_SESSION["tipo"])=='usuario') {
                include("../codigo/cabeceras/usuario.php");
            } else {
                include("../codigo/cabeceras/no_usuario.php");
            }
       ?>

     <?php if (!isset($_POST["id_recetas"])) : ?>

       <?php

         $connection = new mysqli("localhost", "root", "Admin2015", "web", 3316);
         $connection->set_charset("uft8");

         if ($connection->connect_errno) {
             printf("Connection failed: %s\n", $connection->connect_error);
             exit();
         }

         $c1="SELECT * from recetas where id_recetas='".$_GET["id"]."'";

         if ($result = $connection->query($c1)) {
             $obj = $result->fetch_object();

             if ($result->num_rows==0) {
                 echo "No existe la receta";
                 exit();
             }

             $id = $obj->id_recetas;
             $titulo = $obj->titulo;
             $texto = $obj->texto;
             $tiempo = $obj->tiempo;
             $nivel = $obj->nivel;
         } else {
             echo "No se han recuperado los datos del usuario";
             exit();
         }

       ?>

     <div class="container">
       <div class="row mt-6 justify-content-center mt-5">
         <div class="col-sm-7 col-md-4 bg-secondary">
          <form method="post">
            <p>Editar Receta<br></p>
            <p>Título:<br><input value='<?php echo $titulo; ?>' type="text" name="titulo" required></p>
            <p>Texto:<br><textarea value='<?php echo $texto; ?>' name="texto" required></textarea></p>
            <p>Tiempo:<br><input value='<?php echo $tiempo; ?>' type="time" name="tiempo" required></p>
            <p>Nivel:<br><input value='<?php echo $nivel; ?>' type="enum" name="nivel" required></p>
            <input type="hidden" name="id_recetas" value='<?php echo $id; ?>'>
            <p><input type="submit"  class="btn btn-primary" value="Editar"></p>
          </form>
        </div>
      </div>
    </div>

  <?php else: ?>

    <?php
    $ide = $_POST["id_recetas"];
    $titulo = $_POST["titulo"];
    $texto = $_POST["texto"];
    $tiempo = $_POST["tiempo"];
    $nivel = $_POST["nivel"];

    $connection = new mysqli("localhost", "root", "Admin2015", "web", 3316);
    $connection->set_charset("uft8");

    if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $connection->connect_error);
        exit();
    }

    $c2="UPDATE recetas SET titulo='$titulo', texto='$texto', tiempo='$tiempo', nivel='$nivel'
    WHERE id_recetas='$ide'";

    if ($result = $connection->query($c2)) {
        header("Location: modificar_recetas.php");
    } else {
        echo "Error al actualizar los datos";
    }

    $result->close();
    unset($obj);
    unset($connection);

    ?>

  <?php endif ?>

    <?php else: ?>
      <h1>NO TIENES PERMISOS PARA ACCEDER AQUI</h1>
    <?php endif ?>

  </body>
