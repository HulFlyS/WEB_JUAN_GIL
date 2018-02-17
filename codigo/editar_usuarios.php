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
    <?php if (isset($_SESSION["user"])&&($_SESSION["tipo"])=='admin' ) {
               include("../codigo/cabeceras/admin.php");
             } else {
               include("../codigo/cabeceras/usuario.php");
           }
     ?>

     <?php if (!isset($_POST["id_miembros"])) : ?>

       <?php

         $connection = new mysqli("localhost", "root", "Admin2015", "web",3316);
         $connection->set_charset("uft8");

         if ($connection->connect_errno) {
             printf("Connection failed: %s\n", $connection->connect_error);
             exit();
         }

         $c1="SELECT * from miembros where id_miembros='".$_GET["id"]."'";

         if ($result = $connection->query($c1))  {

           $obj = $result->fetch_object();

           if ($result->num_rows==0) {
             echo "No existe el usuario";
             exit();
           }

           $id = $obj->id_miembros;
           $user = $obj->user;
           $pass = $obj->pass;
           $mail = $obj->mail;
           $tipo = $obj->tipo;

         } else {
           echo "No se han recuperado los datos del usuario";
           exit();
         }

       ?>

     <div class="container">
       <div class="row mt-6 justify-content-center mt-5">
         <div class="col-sm-7 col-md-4 bg-secondary">
          <form method="post">
            <p>Editar datos del usuario:<br></p>
            <p>Usuario:<br><input value='<?php echo $user; ?>' type="text" name="user" required></p>
            <p>Contraseña:<br><input type="password" name="pass" required></p>
            <p>Email:<br><input value='<?php echo $mail; ?>' type="text" name="mail" required></p>
            <p>Tipo:<br><input value='<?php echo $tipo; ?>' type="text" name="tipo" required></p>
            <input type="hidden" name="id_miembros" value='<?php echo $id; ?>'>
            <p><input type="submit"  class="btn btn-primary" value="Editar"></p>
          </form>
        </div>
      </div>
    </div>

  <?php else: ?>

    <?php
    $id = $_POST["id_miembros"];
    $user = $_POST["user"];
    $pass = md5($_POST["pass"]);
    $mail = $_POST["mail"];
    $tipo = $_POST["tipo"];

    $connection = new mysqli("localhost", "root", "Admin2015", "web",3316);
    $connection->set_charset("uft8");

    if ($connection->connect_errno) {
        printf("Connection failed: %s\n", $connection->connect_error);
        exit();
    }

    $c2="UPDATE miembros SET user='$user', pass='$pass', mail='$mail', tipo='$tipo'
    WHERE id_miembros='$id'";

    echo $c2;
    if ($result = $connection->query($c2)) {
      echo "Datos actualizados";
    } else {
      echo "Error al actualizar los datos";
    }

    ?>

  <?php endif ?>




  </body>
