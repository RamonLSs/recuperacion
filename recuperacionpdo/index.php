<?php
session_start();
spl_autoload_register(function ($nombre) {
  require './class/' . $nombre . '.php';
});
// require_once 'vendor/autoload.php';
function generarToken()
{
  return bin2hex(random_bytes(32 / 2));
}
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Televisores</title>
  <style type="text/css">
    body {
      margin: 0;
      padding: 0;
      font-family: 'Roboto', sans-serif !important;
    }

    section {
      margin: 0 auto;
      width: 150%;
      height: 100vh;
      box-sizing: border-box;
      padding: 60px;
    }

    .card {
      position: relative;
      max-width: 300px;
      height: auto;
      background: linear-gradient(-45deg, #fe0847, #feae3f);
      border-radius: 15px;
      margin: 0 auto;
      padding: 40px 20px;
      box-shadow: 0 10px 15px rgba(0, 0, 0, .1);
      transition: .5s;
    }

    .col-sm-4:nth-child(1) .card,
    .col-sm-4:nth-child(1) .card .title .fa {
      background: linear-gradient(-45deg, #f403d1, #64b5f6);

    }

    .title h2 {
      position: relative;
      margin: 20px 0 0;
      padding: 0;
      color: #fff;
      font-size: 28px;
      z-index: 2;
    }

    .option ul {
      margin: 0;
      padding: 0;
    }

    .option ul li {
      margin: 0 0 10px;
      padding: 0;
      list-style: none;
      color: #fff;
      font-size: 16px;
    }

    .card a {
      position: relative;
      z-index: 2;
      background: #fff;
      color: black;
      width: 150px;
      height: 40px;
      line-height: 40px;
      border-radius: 40px;
      display: block;
      text-align: center;
      margin: 20px auto 0;
      font-size: 16px;
      cursor: pointer;
      box-shadow: 0 5px 10px rgba(0, 0, 0, .1);

    }
  </style>
</head>

<body style="background-color: grey">
<h3 class="text-center mt-3 text-warning display-4">Recuperacion PDO</h3>
  <?php
  $_SESSION['token'] = generarToken();
  if (isset($_SESSION['usuario'])) {
    echo "<div class='text-center mt-3'>";
    echo "<form name='cerrar' action='cerrarSesion.php' method='POST' style='display:inline;'>";
    echo "<input type='hidden' name='token' value='{$_SESSION['token']}' />\n";
    echo "<input type='submit' class='btn btn-danger' value='Cerrar Session'>\n";
    echo "</form>&nbsp;";
    echo "</div>";
  }
  ?>
  <div class="container mt-4 text-center">
    <a href="login.php" class="btn btn-info">Login</a>&nbsp;
    <?php
    if (isset($_SESSION['usuario'])) {
      echo "<a href='televisores.php' class='btn btn-info'>Ver Televisores</a>&nbsp;";
    }
    ?>
  </div>
  <section>
    <div class="container-fluid">
      <div class="container">
        <div class="row">
          <div class="col-sm-4">
            <div class="card text-center">
              <div class="title">
                <h2>Televisores</h2>
              </div>
              <br>
              <div class="option">
                <ul>
                  <li> <i class="fa fa-check" aria-hidden="true"></i> Tipo </li>
                  <li> <i class="fa fa-check" aria-hidden="true"></i> Pulgadas </li>
                  <li> <i class="fa fa-check" aria-hidden="true"></i> Imagen </li>
                  <li> <i class="fa fa-check" aria-hidden="true"></i> Precio </li>
                  <li> <i class="fa fa-check" aria-hidden="true"></i> Descripcion </li>
                  <li> <i class="fa fa-check" aria-hidden="true"></i> Marca </li>
                </ul>
              </div>
              <?php
              if (isset($_SESSION['usuario'])) {
                echo "<a href='televisores.php' class='btn btn-info'>Ir a Televisores</a>&nbsp;";
              }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</body>

</html>