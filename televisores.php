<?php
session_start();

function generarToken(){
    return bin2hex(random_bytes(32 / 2));
}

if(!isset($_SESSION['perfil'])){
    header('Location:index.php');
    die();
}

spl_autoload_register(function($nombre){
    require './clases/'.$nombre.'.php';
});
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Televisores</title>
</head>
<body>
    <!-- <?php
    $_SESSION['token'] = generarToken();
    if(isset($_SESSION['perfil'])){
        $usuario = new Usuarios($_SESSION['perfil'],$_SESSION['mail']);
        $usuario->pintarCabecera();
    }
    ?> -->
    <h3 class="text text-center mt-3">Televisiores en Stock</h3>
    <?php
        if($_SESSION['perfil'] == 'admin'){
            echo "<div class='container mt-2'>";
            echo "<a href='ctelevisor.php' class='btn btn-info'>Crear Televisor</a>";
            echo "<div>";
        }
    ?>
    </div>
    <div class="container mt-3">
        <?php
            if(isset($_SESSION['mensaje'])){
                echo "<div class='container text-danger'>";
                echo $_SESSION['mensaje'];
                $_SESSION['mensaje'] = null;
                echo "</div>";
            }
        ?>
<table class="table table-striped table-dark">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Tipo</th>
            <th scope="col">Pulgadas</th>
            <th scope="col">Precio</th>
            <th scope="col">Desripcion</th>
            <th scope="col">Marca</th>
            <th scope="col">Imagen</th>
            <?php
            if($_SESSION['perfil'] == 'admin'){
                echo "<th scope='col'>Acciones</th>";
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <?php
            $miConexion = new Conexion();
            $llave = $miConexion->getLLave();
            $lTelevisores = new Televisores($llave);

            $paginacion = 3;
            $total=$lTelevisores->getTotalRegistros();
            $npaginas = ceil($total/$paginacion);
            
            if(isset($_GET['pag'])){
                $inf = ($_GET['pag']-1)*$paginacion;
                $televisores = $lTelevisores->read($inf, $paginacion);
            }else{
                $televisores = $lTelevisores->read(0, $paginacion);
            }
        
            foreach($televisores as $item){
                echo "<tr>";
                echo "<td>{$item[0]}</td>";
                echo "<td>{$item[1]}</td>";
                echo "<td>{$item[2]}</td>";
                echo "<td>{$item[3]}</td>";
                echo "<td>{$item[4]}</td>";
                echo "<td>{$item[5]}</td>";
                echo "<td><img src='{$item[6]}' width='80px /></td>";
                if($_SESSION['perfil'] == 'admin'){
                    echo "<td>";
                    echo "<form name = 'br' action= 'delete.php' method='POST' >";
                    echo "<input type='hidden' value='{$_SESSION['token']}' name='token' />";
                    echo "<input type ='hidden' name='id' value='{$item[0]}' />";
                    echo "<a href='mtelevisor.php?id={$item[0]}' class='btn btn-info'>Modificar</a>";
                    echo "&nbsp;&nbsp;<input type='submit' value='Borrar' class='btn btn-danger' />";
                    echo "</form>";
                    echo "</td>";
                    }
                    echo "</tr>";
                }
                $llave = null;
        ?>
    </tbody>
</table>
<?php
    for($i = 1; $i<= $npaginas; $i++){
        if($i!=$npaginas){
            echo "<a href=televisores.php?pag=$i style='text-decoration:none'>|&nbsp;$i&nbsp;</a>";
        }else{
            echo "<a href=televisores.php?pag=$i style='text-decoration:none'>|&nbsp;$i&nbsp;|</a>";
        }
    }
?>
    </div>
</body>
</html>