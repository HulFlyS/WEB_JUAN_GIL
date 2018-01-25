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
    <div class="container">
      <div class="row">
        <div class="col-md-8">
          <h1>RECETAS FÁCILES</h1>
        </div>
        <div class="col-md-2">
          <a href="login.php" class=" btn btn-primary">Login</a>
        </div>
        <div class="col-md-2">
          <a href="registro.php" class="btn btn-warning">Registro</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-3">
          <a href="layout.php" class="text-justify">Inicio</a>
        </div>
        <div class="col-md-3">
          <a href="recetas.php" class="text-justify">Recetas</a>
        </div>
        <div class="col-md-3">
          <a href="informacion.php" class="text-justify">Información</a>
        </div>
        <div class="col-md-3">
          <a href="contacto.php" class="text-justify">Contacto</a>
        </div>
    </div>
  </div>
    <?php
        if (isset($_POST["user"])) {
          $connection = new mysqli("localhost", "root", "Admin2015", "web", 3316);
          if ($connection->connect_errno) {
              printf("Connection failed: %s\n", $connection->connect_error);
              exit();
          }
        $consulta="select * from miembros where
        user='".$_POST["user"]."' and pass=md5('".$_POST["pass"]."');";
        if ($result = $connection->query($consulta)) {
            if ($result->num_rows===0) {
                echo "LOGIN INVALIDO";
              } else {
                $_SESSION["user"]=$_POST["user"];
                $_SESSION["language"]="es";

                header("Location: layout.php");
              }
          } else {
            echo "Wrong Query";
          }
      }
    ?>
    <form action="login.php" method="post">
      <p>Usuario<br><input name="user" required></p>
      <p>Contraseña<br><input name="pass" type="password" required></p>
      <p><input type="submit" value="Log In"></p>
    </form>
  </body>
</html>
