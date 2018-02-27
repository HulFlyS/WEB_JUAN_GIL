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
    <?php if (isset($_SESSION["user"])&&($_SESSION["tipo"])=='admin') {
      include("../codigo/cabeceras/admin.php");
    } elseif (isset($_SESSION["user"])&&($_SESSION["tipo"])=='usuario') {
              include("../codigo/cabeceras/usuario.php");
          } else {
              include("../codigo/cabeceras/no_usuario.php");
          }
     ?>

     <?php

             $connection = new mysqli("localhost", "root", "Admin2015", "web", 3316);
             $connection->set_charset("uft8");

             if ($connection->connect_errno) {
                 printf("Connection failed: %s\n", $connection->connect_error);
                 exit();
             }

               $consulta="SELECT m.user, r.titulo, v.texto, v.puntuacion FROM recetas r JOIN valoraciones v
               ON r.id_recetas = v.id_recetas JOIN miembros m
               ON v.id_miembros = m.id_miembros";

             if ($result = $connection->query($consulta)) {
                 ?>
             <div class="container">
                 <table class="table">
                   <thead>
                     <tr>
                       <th scope="col">Usuario</th>
                       <th scope="col">Receta</th>
                       <th scope="col">Texto</th>
                       <th scope="col">Puntuacion</th>
                     </tr>
                   </thead>
              </div>

             <?php
                 while ($obj = $result->fetch_object()) {
                     echo "<tbody>
                             <tr>
                             <th scope='row'>$obj->user</th>
                             <th scope='row'>$obj->titulo</th>
                             <th scope='row'>$obj->texto</th>
                             <th scope='row'>$obj->puntuacion</th>
                          </tr>";
                 }
                 echo "</tbody>";

                 $result->close();
                 unset($obj);
                 unset($connection);
             }
           ?>
     </table>
</body>
