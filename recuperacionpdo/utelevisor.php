<?php

// use PDOFINAL\Conexion;
session_start();
function errorP($texto) {
    $_SESSION['errorp'] = $texto;
    header("Location:mtelevisor.php?id=");
    die();
}

function mensaje($texto) {
    $_SESSION['mensaje'] = $texto;
    header('Location:televisores.php?id=$id');
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

$id=$_POST['id'];

$tipo = trim($_POST['tipo']);
$pulgadas = trim($_POST['pulgadas']);
$precio = trim($_POST['precio']);
$descripcion = trim($_POST['descripcion']);
$marca = trim($_POST['marca']);

if (strlen($tipo) == 0 || strlen($descripcion) == 0 || strlen($marca) == 0) {
    errorP("El campo tipo, descripcion o marca no pueden estar vacios");
}

$conexion=new Conexion();
$llave = $conexion->getLlave();
$televisor= new Televisores($llave);
$datos=$televisor->borrarArchivoImagen($id);
if (empty($_FILES['imagen']['tmp_name'])) {
    $imagen=false;
}
else{
    $permitidos = ['image/png', 'image/jpeg', 'image/gif', 'image/bmp', 'image/tiff'];
    if (!in_array($_FILES['imagen']['type'], $permitidos)) {
        errorP("El archivo de imagen debe ser una IMAGEN!!!!!", $id);
    }
  
    $idm = time();
    $nombreImagen = "img/televisores/" . $idm . '_' . $_FILES['imagen']['name'];

    move_uploaded_file($_FILES['imagen']['tmp_name'], $nombreImagen);

    if(!is_numeric($datos)){
        unlink($datos);
    }
    $imagen=true;
} 

if($imagen){
    $televisor->update($id, $tipo,$pulgadas, $nombreImagen,$precio,$descripcion,$marca);
}
else{
    $televisor->update($id, $tipo,$pulgadas,$precio,$descripcion,$marca);
}
$llave=null;
mensaje("Televisor actualizada con exito.");

