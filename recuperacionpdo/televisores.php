<?php
// use PDOFINAL\Conexion;
// use PDOFINAL\Televisores;
session_start();

function generarToken() {
    return bin2hex(random_bytes(32 / 2));
}

if (!isset($_SESSION['usuario'])) {
    header('Location:index.php');
    die();
}
spl_autoload_register(function($nombre){
    require './class/'.$nombre.'.php';
});


if(isset($_SESSION['contador'])) 
{ 
  $_SESSION['contador'] = $_SESSION['contador'] + 1; 
  $mensaje = 'Número de visitas: ' . $_SESSION['contador']; 
} 
else 
{ 
  $_SESSION['contador'] = 1; 
  $mensaje = 'Bienvenido, has entrado por primera vez'; 
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
        if (isset($_SESSION['usuario'])) {
            echo "<div class='text-center mt-3'>";
            echo "<form name='cerrar' action='cerrarSesion.php' method='POST' style='display:inline;'>";
            echo "<div class='alert alert-primary' role='alert'>";
        echo "<a href='#' class='alert-link mb-5'>".$mensaje."</a>";
        echo "</div>";
            echo "<input type='submit' class='btn btn-danger' value='Cerrar Sesion'>\n";
            echo "</form>&nbsp;";
           echo "</div>";
  
      
          }
        ?>
        
        <h3 class="text text-center mt-3">Televisores Disponibles</h3>
        <?php
            if($_SESSION['usuario']){
                echo "<div class='container mt-2'>";
                echo "<a href='ctelevisores.php' class='btn btn-info'>Crear Televisores</a>";
                echo "</div>";
            }
         ?>
        </div>
        <div class="container mt-3">
             <?php
            if(isset($_SESSION['mensaje'])){
                echo "<div class='container text-danger'>";
                echo $_SESSION['mensaje'];
                $_SESSION['mensaje']=null;
                echo "</div>";
            }
        ?>
            <table class="table table-striped table-dark">
                <thead>
                    <tr>
                        <th scope=col>Ver</th>
                        <th scope="col">ID</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Pulgadas</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Marca</th>
                        <?php
                        if($_SESSION['usuario']){
                        echo "<th scope='col'>Acciones</th>";
                        }
                                ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $miConexion=new Conexion();
                        $llave=$miConexion->getLlave();
                        $losTelevisores=new Televisores($llave);
                       
                       
                        $paginacion=4; 
                        $total=$losTelevisores->getTotalRegistros(); 
                        $npaginas=ceil($total/$paginacion);
                        if(isset($_GET['pag'])){
                            $inf=($_GET['pag']-1)*$paginacion;
                            $televisores=$losTelevisores->read($inf,$paginacion); 
                        }
                        else{
                           $televisores=$losTelevisores->read(0, $paginacion); 
                        }
                         
                        
                        foreach($televisores as $item){
                            echo "<tr>";
                            echo "<td><a href='vtelevisor.php?id={$item[0]}' class='btn btn-secondary'</a>Ver Televisor</td>";
                            echo "<td>{$item[0]}</td>";
                            echo "<td>{$item[1]}</td>";
                            echo "<td>{$item[2]}</td>";
                            echo "<td><img src='{$item[3]}' width='80px' /></td>";
                            echo "<td>{$item[4]}</td>";
                            echo "<td>{$item[5]}</td>";
                            echo "<td>{$item[6]}</td>";
                            if($_SESSION['usuario']){
                            echo "<td>";
                            echo "<form name='br' action='delete.php' method='POST' >";
                            echo "<input type='hidden' value='{$_SESSION['token']}' name='token' />";
                            echo "<input type='hidden' name='id' value='{$item[0]}' />";
                            echo "<a href='mtelevisor.php?id={$item[0]}' class='btn btn-info'>Modificar</a>";
                            echo "&nbsp;&nbsp;<input type='submit' value='Borrar' class='btn btn-danger' />";
                            echo "</form>";
                            echo "</td>";
                            }
                            echo "</tr>";
                            
                        }
                        $llave=null;
                        
                    ?>
                   
                </tbody>
            </table>
            <?php
                
                for($i=1; $i<=$npaginas; $i++){
                    if($i!=$npaginas){
                        echo "<a href=televisores.php?pag=$i style='text-decoration:none'>|&nbsp;$i&nbsp;</a>";
                    }
                    else{
                        echo "<a href=televisores.php?pag=$i style='text-decoration:none'>|&nbsp;$i&nbsp;|</a>";
                    }
                }
            ?>
            
        </div>
    </body>
</html>