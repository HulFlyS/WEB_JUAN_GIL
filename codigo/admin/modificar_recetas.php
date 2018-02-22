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
    <?php if (isset($_SESSION["user"])&&($_SESSION["tipo"])=='admin') {
               include("../cabeceras/admin.php");
             }
          elseif (isset($_SESSION["user"])&&($_SESSION["tipo"])=='usuario')  {
               include("../cabeceras/usuario.php");
           } else {
             include("../cabeceras/no_usuario.php");
           }
     ?>

     <?php

             $connection = new mysqli("localhost", "root", "Admin2015", "web",3316);
             $connection->set_charset("uft8");

             if ($connection->connect_errno) {
                 printf("Connection failed: %s\n", $connection->connect_error);
                 exit();
             }

               $consulta="SELECT * FROM recetas";
             if ($result = $connection->query($consulta)) {
             ?>
             <div class="container">
                 <table class="table">
                   <thead>
                     <tr>
                       <th scope="col">Título</th>
                       <th scope="col">Texto</th>
                       <th scope="col">Tiempo</th>
                       <th scope="col">Nivel</th>
                       <th scope="col">Imagen</th>
                       <th scope="col">Editar</th>
                       <th scope="col">Borrar</th>
                     </tr>
                   </thead>
              </div>

             <?php
                 echo "<a class='btn btn-primary mt-3 mb-3' href='añadir_recetas.php'>Añadir Receta</a>";
                 while($obj = $result->fetch_object()) {

                     echo "<tbody>
                             <tr>
                             <th scope='row'>$obj->titulo</th>
                             <th scope='row'>$obj->texto</th>
                             <th scope='row'>$obj->tiempo</th>
                             <th scope='row'>$obj->nivel</th>
                             <th scope='row'>$obj->imagen</th>
                             <td><a href='editar_recetas.php?id=$obj->id_recetas'><img class='img-responsive' width='25px' alt='Responsive image' src='../../imagenes/lapiz.png'></a></td>
                             <td><a href='borrar_recetas.php?id=$obj->id_recetas'><img class='img-responsive' width='25px' alt='Responsive image' src='../../imagenes/papelera.png'></a></td>
                           </tr>
                           ";
                 }
                 echo "</tbody>";

                 $result->close();
                 unset($obj);
                 unset($connection);
             }
           ?>
     </table>
</body>
