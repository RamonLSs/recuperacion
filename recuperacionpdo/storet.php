<?php
// use PDOFINAL\Conexion;
session_start();

function errorP($texto) {
    $_SESSION['errorp'] = $texto;
    header('Location:ctelevisores.php');
    die();
}


if (!isset($_SESSION['usuario'])) {
   
    header('Location:index.php');
    die();
}

if (!(isset($_SESSION['token']) && isset($_POST['token'])) || $_SESSION['token'] != $_POST['token']) {
    header('Location:index.php');
    die();
}

spl_autoload_register(function($nombre) {
    require './class/' . $nombre . '.php';
});

$tipo = trim($_POST['tipo']);
$pulgadas = trim($_POST['pulgadas']);
$precio = trim($_POST['precio']);
$descripcion = trim($_POST['descripcion']);
$marca = trim($_POST['marca']);

if (strlen($tipo) == 0 || strlen($descripcion) == 0 || strlen($marca) == 0) {
    errorP("El campo tipo, descripcion o marca no pueden estar vacios");
}

if (empty($_FILES['imagen']['tmp_name'])) {
    $nombreImagen = "img/televisores/default.jpg";
} 
else {
  
    $permitidos = ['image/png', 'image/jpeg', 'image/gif', 'image/bmp', 'image/tiff'];
    if (!in_array($_FILES['imagen']['type'], $permitidos)) {
        errorP("El archivo de imagen debe ser una IMAGEN!!!!!");
    }
  
    $id = time();
    $nombreImagen = "img/televisores/" . $id . '_' . $_FILES['imagen']['name'];
    
    move_uploaded_file($_FILES['imagen']['tmp_name'], $nombreImagen);
}

$conexion=new Conexion();
$llave=$conexion->getLlave();
$televisor=new Televisores($llave);
$televisor->create($tipo,$pulgadas,$nombreImagen,$precio,$descripcion,$marca);
$llave=null;
$_SESSION['mensaje']="Televisor creado correctamente.";
header('Location:televisores.php');

    