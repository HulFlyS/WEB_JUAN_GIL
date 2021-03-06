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
    <?php if (isset($_SESSION["user"])&&($_SESSION["tipo"])=='admin') :?>

    <div class="container">
      <div class="row bg-dark">
        <div class="col-md-7">
          <h2 class='text-white mt-3'>RECETAS FÁCILES</h2>
        </div>
        <div class="col-md-5">

          <?php
          if (isset($_SESSION['user'])) {
              echo "<h4 class='text-white mt-2'>Estás logueado como $_SESSION[user]</h4>";
              echo "<a class='btn btn-primary' href='../codigo/cerrar_sesion.php'>Cerrar Sesión</a>";
          } else {
              echo "<h4 class='text-white mt-2'>No estás conectado, logueate o registrate</h4>";
              echo "<a class='btn btn-primary mr-5' href='../codigo/login.php'>Iniciar Sesión  </a>";
              echo "<a class='btn btn-warning' href='../codigo/registro.php'>Registrate</a>";
          }
           ?>
      </div>
    </div>
      <div class="row bg-dark pt-3 pb-2">
        <div class="col-md-2">
          <a href="../codigo/inicio.php" class="text-justify">Inicio</a>
        </div>
        <div class="col-md-2">
          <a href="../codigo/recetas.php" class="text-justify">Recetas</a>
        </div>
        <div class="col-md-2">
          <a href="../codigo/modificar_recetas.php" class="text-justify">Modificar Recetas</a>
        </div>
        <div class="col-md-2">
          <a href="../codigo/modificar_valoraciones.php" class="text-justify">Valoraciones</a>
        </div>
        <div class="col-md-2">
          <a href="../codigo/ingredientes.php" class="text-justify">Ingredientes</a>
        </div>
        <div class="col-md-1">
          <a href="../codigo/usuarios.php" class="text-justify">Usuarios</a>
        </div>
        <div class="col-md-1">
          <a href="../codigo/contacto.php" class="text-justify">Contacto</a>
        </div>
    </div>
  </div>
  <?php else: ?>
    <h1>NO TIENES PERMISOS PARA ACCEDER AQUI</h1>
  <?php endif ?>
</body>
