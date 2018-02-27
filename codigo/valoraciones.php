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
    <?php if (isset($_SESSION["user"])) :?>

      <?php if (isset($_SESSION["user"])&&($_SESSION["tipo"])=='admin') {
        include("../codigo/cabeceras/admin.php");
      } elseif (isset($_SESSION["user"])&&($_SESSION["tipo"])=='usuario') {
                include("../codigo/cabeceras/usuario.php");
            } else {
                include("../codigo/cabeceras/no_usuario.php");
            }
       ?>

        <?php
            if (isset($_POST["texto"])) {
                $connection = new mysqli("localhost", "root", "Admin2015", "web", 3316);
                if ($connection->connect_errno) {
                    printf("Connection failed: %s\n", $connection->connect_error);
                    exit();
                }

                $consulta="INSERT INTO valoraciones values(NULL,'".$_POST['puntuacion']."','".$_POST['texto']."','".$_GET['id']."','".$_SESSION['idm']."');";
                echo $consulta;
                if ($result = $connection->query($consulta)) {
                    header("Location: recetas.php");
                } else {
                    echo "Wrong Query";
                }
            }
        ?>

       <div class="container">
        <div class="row mt-6 justify-content-center pt-5">
          <div class="col-sm-7 col-md-4 bg-secondary">
            <form method="post">
              <p>Introduce aquí tú Valoración</p>
              <p>Puntuación (entre 0 y 5)<br><input name="puntuacion" required></p>
              <p>Comentario<br><textarea name="texto" required></textarea></p>
              <p><input type="submit"  class="btn btn-primary" value="Añadir Valoración"></p>
            </form>
          </div>
        </div>
      </div>

      <?php else: ?>
        <h1>TIENES QUE ESTAR REGISTRADO PARA AGREGAR VALORACIONES</h1>
      <?php endif ?>
</body>
