<?php

session_start();
if(!isset($_SESSION['usuario'])){
    header('Location:index.php');
}

function generarToken(){
    return bin2hex(random_bytes(32/2));
}

spl_autoload_register(function($nombre){
    require './class/'.$nombre.'.php';
});
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Ver Televisor</title>
</head>
<body style="background-color:grey">
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
<h3 class='text-center mt-3'>Ver Televisor</h3>
<?php
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
    <div class="card text-white bg-info mt-5 mx-auto" style="max-width: 48rem;">
        <div class="card-header text-center"><b><?php echo $marca.', '.$descripcion?></b></div>
        <div class="card-body" style="font-size:1.1 em">
        <form name='uno' method='POST' enctype="multipart/form-data" action='utelevisor.php'>
            <input type='hidden' name='token' value='<?php echo $_SESSION['token']; ?>' />
            <input type='hidden' name='id' value='<?php echo $id ?>' />
            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" value='<?php echo $tipo ?>' name='tipo' readonly/>
                </div>
                <div class="col">
                    <input type="text" class="form-control" value='<?php echo $pulgadas ?>' name='pulgadas' readonly />
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" value='<?php echo $precio ?>' name='precio' readonly />
                </div>
                <div class="col">
                    <input type="text" class="form-control" value='<?php echo $descripcion ?>' name='descripcion' readonly />
                </div>
            </div>

            <div class="form-row">
                <div class="col">
                    <input type="text" class="form-control" value='<?php echo $marca ?>' name='marca' readonly />
                </div>
                <div class="col">
                    <label for="im"><b>Imagen:&nbsp;</b></label>
                    <img src='<?php echo $imagen; ?>' width='100px' />
                    
                </div>
        </div>
            <div class="form-row mt-4">
                <div class="col">
                 
                    <a href='televisores.php' class='btn btn-warning'>Volver</a>
                </div>
            </div>
    </div>
    </form>
    </div>
        
    </div>
</body>
</html>