<?php
// use PDOFINAL\Conexion;
session_start();

function mensaje($texto) {
    $_SESSION['mensaje'] = $texto;
    header('Location:televisores.php');
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

$conexion=new Conexion();
$llave=$conexion->getLlave();
$televisor=new Televisores($llave);
$dato=$televisor->borrarArchivoImagen($id);
if(!(is_numeric($dato))){
    unlink($dato);
}
$televisor->delete($id);   
$llave=null;
mensaje("Televisor Borrada con exito!!!");