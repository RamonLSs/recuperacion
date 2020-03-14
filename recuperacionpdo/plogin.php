<?php
// use PDOFINAL\Conexion;
    session_start();
    
    spl_autoload_register(function($nombre){
        require './class/'.$nombre.'.php';
        
    });
    function fmensaje($texto){
        $_SESSION['msg']=$texto;
        header('Location:login.php');
        die();
    }
 
    if (!(isset($_SESSION['token']) && isset($_POST['token'])) || $_SESSION['token'] != $_POST['token']) {
        fmensaje("Error de Token !! Ataque CSRF detectado!!!");
    }
  
    $email=trim($_POST['email']);
    $pass=trim($_POST['pass']);
    if(strlen($email)==0 || strlen($pass)==0){
        fmensaje("El email y la contraseña NO pueden ser solo espacios en blanco!!!");
    }
    $conexion=new Conexion();
    $llave=$conexion->getLlave();
    $usuario =new Usuarios($llave);
    $resultado=$usuario->validar($email, $pass);
    $_SESSION['usuario'] = $resultado;
    if(is_numeric($resultado)){
        fmensaje("Error de validacion, revise credenciales!!!");
        $llave=null;
    }
    else{
      
        $_SESSION['email']=$resultado['email'];
        $_SESSION['pass']=$resultado['pass'];
        
       
        $llave=null;
        header('Location:index.php');
    }    