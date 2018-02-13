<?php
  session_start();
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

    <?php
        if (isset($_POST["user"])) {
          $connection = new mysqli("localhost", "root", "Admin2015", "web", 3316);
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }

        $consulta="INSERT INTO miembros values(NULL,'".$_POST['user']."',md5('".$_POST['pass']."'),'".$_POST['mail']."','usuario');";
        if ($result = $connection->query($consulta)) {
          echo "Has sido registrado con éxito";
            if ($result->num_rows===0) {
                echo "LOGIN INVALIDO";
              }
          } else {
            echo "Wrong Query";
          }
      }
    ?>

    <?php if (isset($_SESSION["user"])&&($_SESSION["tipo"])=='admin') {
               include("../codigo/cabeceras/admin.php");
             } else {
               include("../codigo/cabeceras/usuario.php");
           }
     ?>

    <div class="container">
     <div class="row mt-6 justify-content-center">
       <div class="col-sm-7 col-md-4 bg-primary">
         <form action="registro.php" method="post">
           <p>Usuario<br><input name="user" required></p>
           <p>Contraseña<br><input name="pass" type="password" required></p>
           <p>Email<br><input name="mail" required></p>
           <p><input type="submit"  class="btn btn-warning" value="Registrarse"></p>
         </form>
       </div>
     </div>
   </div>
  </body>
</html>
