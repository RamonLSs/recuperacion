<?php
// use PDOFINAL\Conexion;
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location:index.php');
    die();
}

function generarToken()
{
    return bin2hex(random_bytes(32 / 2));
}
spl_autoload_register(function ($nombre) {
    require './class/' . $nombre . '.php';
});
?>
<!doctype html>
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
    <h3 class='text-center mt-3'>Modificar Televisor</h3>
    <?php
    if (isset($_SESSION['errorp'])) {
        echo "<div class='container text-danger'>";
        echo $_SESSION['errorp'];
        $_SESSION['errorp'] = null;
        echo "</div>";
    }

    $conexion = new Conexion();
    $llave = $conexion->getLlave();

    $televisor = new Televisores($llave);
    $id = $_GET['id'];
    $fila = $televisor->verTelevisor($id);

    $tipo = $fila->tipo;
    $pulgadas = $fila->pulgadas;
    $imagen = $fila->imagen;
    $precio = $fila->precio;
    $descripcion = $fila->descripcion;
    $marca = $fila->marca;

    ?>
    <div class="container mt-4" style='border: white 4px groove; padding: 8px'>
        <form name='uno' method='POST' enctype="multipart/form-data" action='utelevisor.php'>
            <input type='hidden' name='token' value='<?php echo $_SESSION['token']; ?>' />
            <input type='hidden' name='id' value='<?php echo $id ?>' />
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" value='<?php echo $tipo ?>' name='tipo' required />
                </div>
                <div class="col">
                    <input type="text" class="form-control" value='<?php echo $pulgadas ?>' name='pulgadas' required />
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" value='<?php echo $precio ?>' name='precio' required />
                </div>
                <div class="col">
                    <input type="text" class="form-control" value='<?php echo $descripcion ?>' name='descripcion' required />
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" value='<?php echo $marca ?>' name='marca' required />
                </div>
                <div class="col">
                    <label for="im"><b>Imagen:&nbsp;</b></label>
                    <img src='<?php echo $imagen; ?>' width='100px' />
                    <input type="file" name='imagen' id='im' />
                </div>
        </div>
            <div class="form-row mt-4">
                <div class="col">
                    <input type='submit' value='Modificar' class='btn btn-success' />&nbsp;
                    <a href='televisores.php' class='btn btn-info'>Volver</a>
                </div>
            </div>
    </div>
    </form>
    </div>
</body>

</html>