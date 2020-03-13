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

//si no soy admin no puedo entrar
if (!isset($_SESSION['usuario'])) {
    //die("No estoy validado!!!");
    header('Location:index.php');
    die();
}
//Protegemos el formulario de ataques csrf
if (!(isset($_SESSION['token']) && isset($_POST['token'])) || $_SESSION['token'] != $_POST['token']) {
    header('Location:index.php');
    die();
}
//Autoload de las clases
spl_autoload_register(function($nombre) {
    require './class/' . $nombre . '.php';
});

$id=$_POST['id'];
//cogemos los datos del formulario, comprobamos que el nombre no este vacio
$tipo = trim($_POST['tipo']);
$pulgadas = trim($_POST['pulgadas']);
$precio = trim($_POST['precio']);
$descripcion = trim($_POST['descripcion']);
$marca = trim($_POST['marca']);

if (strlen($tipo) == 0 || strlen($descripcion) == 0 || strlen($marca) == 0) {
    errorP("El campo tipo, descripcion o marca no pueden estar vacios");
}
//Si no hemos elegido ninguna imagen dejamos la que tiene
//en otro caso la guardaremos
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
    //si todo esta bien lo guado fisicamente con un nombre unico
    //y lo insertamoes en la bbdd
    $idm = time();
    $nombreImagen = "img/televisores/" . $idm . '_' . $_FILES['imagen']['name'];
    //  die($nombreImagen);
    move_uploaded_file($_FILES['imagen']['tmp_name'], $nombreImagen);
    //debemos borrar la imagen antigua recuperamos el nombre de la imagen y la borramos si no es la default
    if(!is_numeric($datos)){
        unlink($datos);
    }
    $imagen=true;
} 
//ahora hacemos el update propiamente dicho
if($imagen){
    $televisor->update($id, $tipo,$pulgadas, $nombreImagen,$precio,$descripcion,$marca);
}
else{
    $televisor->update($id, $tipo,$pulgadas,$precio,$descripcion,$marca);
}
$llave=null;
mensaje("Televisor actualizada con exito.");

