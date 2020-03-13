<?php
// use PDOFINAL\Conexion;
session_start();

function mensaje($texto) {
    $_SESSION['mensaje'] = $texto;
    header('Location:televisores.php');
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
//recupero el ide de la plataforma
$id=$_POST['id'];
//tenfo que borrar la plataforma y la imagen si no es default.php
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