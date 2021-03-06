<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header('Location:index.php');
    die();
}

function generarToken()
{
    return bin2hex(random_bytes(32 / 2));
}
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
    require 'class/Usuarios.php';
    if (isset($_SESSION['usuario'])) {
        echo "<div class='text-center mt-3'>";
        echo "<form name='cerrar' action='cerrarSesion.php' method='POST' style='display:inline;'>";

        echo "<input type='submit' class='btn btn-danger' value='Cerrar Sesion'>\n";
        echo "</form>&nbsp;";
        echo "</div>";
    }


    ?>
    <h3 class='text-center mt-3'>Crear Televisor</h3>
    <?php
    if (isset($_SESSION['errorp'])) {
        echo "<div class='container text-danger'>";
        echo $_SESSION['errorp'];
        $_SESSION['errorp'] = null;
        echo "</div>";
    }
    ?>
    <div class="container mt-4" style='border: white 4px groove; padding: 8px'>
        <form name='uno' method='POST' enctype="multipart/form-data" action='storet.php'>
            <input type='hidden' name='token' value='<?php echo $_SESSION['token']; ?>' />
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Tipo" name='tipo' required />
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Pulgadas" name='pulgadas' required />
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Precio" name='precio' required />
                </div>
                <div class="col">
                    <input type="text" class="form-control" placeholder="Descripcion" name='descripcion' required />
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" placeholder="Marca" name='marca' required />
                </div>
                <div class="col">
                    <label for="im"><b>Imagen:&nbsp;</b></label>
                    <input type="file" name='imagen' id='im' />
                </div>
            </div>

            <div class="form-row mt-4">
                <div class="col">
                    <input type='submit' value='Crear' class='btn btn-success' />&nbsp;
                    <input type='reset' value='Limpiar' class='btn btn-warning' />&nbsp;
                    <a href='televisores.php' class='btn btn-info'>Volver</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>