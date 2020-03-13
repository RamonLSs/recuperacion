<?php
    session_start();
    require_once 'vendor/autoload.php';
    function generarToken(){
        return bin2hex(random_bytes(32/2));
    }
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Televisores</title>
  </head>
  <body style="background-color: grey">
  <?php
        $_SESSION['token'] = generarToken();
        if (isset($_SESSION['usuario'])) {
          echo "<div class='text-center mt-3'>";
          echo "<form name='cerrar' action='cerrarSesion.php' method='POST' style='display:inline;'>";
          
          echo "<input type='submit' class='btn btn-danger' value='Cerrar Sesion'>\n";
          echo "</form>&nbsp;";
         echo "</div>";

    
        }
        ?>
      <h3 class="text-center mt-3">Televisores</h3>
      <div class="container mt-4 text-center">
          <a href="login.php" class="btn btn-info">Login</a>&nbsp;

          <?php
            if(isset($_SESSION['usuario'])){
                echo "<a href='televisores.php' class='btn btn-info'>Ver Televisores</a>&nbsp;";
            }
            
          ?>
      </div>
  </body>
</html>