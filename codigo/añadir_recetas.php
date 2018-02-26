<?php if (!isset($_SESSION)){
  session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web</title>
    <link rel="stylesheet" type="text/css" href=" ">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
  </head>
  <body>
    <?php if (isset($_SESSION["user"])&&($_SESSION["tipo"])=='admin' )  :?>

    <?php

        $connection = new mysqli("localhost", "root", "Admin2015", "web", 3316);
        if ($connection->connect_errno) {
            printf("Connection failed: %s\n", $connection->connect_error);
            exit();
        }
        if (isset($_POST["user"])) {


        $consulta="INSERT INTO recetas values(NULL,'".$_POST['titulo']."','".$_POST['texto']."','".$_POST['tiempo']."','".$_POST['nivel']."','".$_POST['imagen']."');";
        if ($result = $connection->query($consulta)) {
          header("Location: usuarios.php");
            if ($result->num_rows===0) {
                echo "Usuario inválido";
              }
          } else {
            echo "Wrong Query";
          }
        $receta=$connection->insert_id;



      }
    ?>

    <?php if (isset($_SESSION["user"])&&($_SESSION["tipo"])=='admin') {
               include("../codigo/cabeceras/admin.php");
             }
          elseif (isset($_SESSION["user"])&&($_SESSION["tipo"])=='usuario')  {
               include("../codigo/cabeceras/usuario.php");
           } else {
             include("../codigo/cabeceras/no_usuario.php");
           }
     ?>

    <div class="container">
     <div class="row mt-2 mb-5 justify-content-center pt-5">
       <div class="col-sm-8 col-md-8 bg-secondary pt-2">
         <form action="añadir_usuarios.php" method="post">
           <p>Titulo<br><input name="titulo" required></p>
           <p>Texto<br><textarea name="texto" type="text" required></textarea></p>
           <p>Tiempo<br><input name="tiempo" type="time" required></p>
           <p>nivel<br><input name="tiempo" type="enum" required></p>
           <p>Imagen<br><input name="imagen" type="file" required></p>
           <table class="table-succes">
             <thead>
               <tr>
                 <th scope="col">Ingredientes</th>
                 <th scope="col">Cantidad</th>
                 <th><input class="btn btn-primary" value="+"></th>
               </tr>
               <tr>
                 <th scope="col">
           <?php
             echo "<select name='id_ingredientes'>";

             $c2="SELECT * FROM ingredientes ORDER BY nombre";

             if ($result2=$connection->query($c2)) {

               while($obj2=$result2->fetch_object()) {
                 echo "<option value='".$obj2->id_ingredientes."'>";
                 echo $obj2->nombre;
                 echo "</option>";

               }
             } else {
               echo "NO SE HA PODIDO RECUPERAR DATOS";
             }
             echo "</select>";
           ?></th>
              <th><input name="cantidad" required></p></th>
            </thead>
          </table>
           <p><input type="submit"  class="btn btn-primary" value="Añadir Receta"></p>
         </form>
       </div>
     </div>
   </div>

    <?php else: ?>
      <h1>NO TIENES PERMISOS PARA ACCEDER AQUI</h1>
    <?php endif ?>

  </body>
</html>
