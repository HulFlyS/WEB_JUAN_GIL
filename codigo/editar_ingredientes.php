<?php if (!isset($_SESSION)){
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
    <?php if (isset($_SESSION["user"])&&($_SESSION["tipo"])=='admin' )  :?>

      <?php if (isset($_SESSION["user"])&&($_SESSION["tipo"])=='admin') {
                 include("../codigo/cabeceras/admin.php");
               }
            elseif (isset($_SESSION["user"])&&($_SESSION["tipo"])=='usuario')  {
                 include("../codigo/cabeceras/usuario.php");
             } else {
               include("../codigo/cabeceras/no_usuario.php");
             }
       ?>

     <?php if (!isset($_POST["id_ingredientes"])) : ?>

       <?php

         $connection = new mysqli("localhost", "root", "Admin2015", "web",3316);
         $connection->set_charset("uft8");

         if ($connection->connect_errno) {
             printf("Connection failed: %s\n", $connection->connect_error);
             exit();
         }

         $c1="SELECT * from ingredientes where id_ingredientes='".$_GET["ing"]."'";

         if ($result = $connection->query($c1))  {

           $obj = $result->fetch_object();

           if ($result->num_rows==0) {
             echo "No existe el ingrediente";
             exit();
           }

           $cod = $obj->id_ingredientes;
           $nom = $obj->nombre;

         } else {
           echo "No se han recuperar los datos del ingrediente";
           exit();
         }

       ?>

     <div class="container">
       <div class="row mt-6 justify-content-center mt-5">
         <div class="col-sm-7 col-md-4 bg-secondary">
          <form method="post">
            <p>Editar Ingrediente:<br></p>
            <p>Ingrediente:<br>
            <input value='<?php echo $nom; ?>' type="text" name="nombre" required></p>
            <input type="hidden" name="id_ingredientes" value='<?php echo $cod; ?>'>
            <p><input type="submit"  class="btn btn-primary" value="Editar"></p>
          </form>
        </div>
      </div>
    </div>

  <?php else: ?>

    <?php
    $cod = $_POST["id_ingredientes"];
    $nom = $_POST["nombre"];

    $connection = new mysqli("localhost", "root", "Admin2015", "web",3316);
    $connection->set_charset("uft8");

    if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $connection->connect_error);
        exit();
    }

    $c2="UPDATE ingredientes SET nombre='$nom'
    WHERE id_ingredientes='$cod'";

    echo $c2;
    if ($result = $connection->query($c2)) {
      header("Location: ingredientes.php");
    } else {
      echo "Error al actualizar el ingrediente";
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
