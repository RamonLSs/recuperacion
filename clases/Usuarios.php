<?php

class Usuarios{
    private $conexion;
    private $id;
    private $mail;
    private $pass;

    public function __construct()
    {
        $numParam = func_num_args();
        if($numParam == 1){
            $this->ponerConexion(func_get_arg(0));
        }
        if($numParam == 2){
            $this->mail = func_get_arg(0);
            $this->pass = func_get_arg(1);
        }
    }

    public function ponerConexion($con){
        $this->conexion = $con;
    }

    public function validar($cor, $pass){
        $passCifrada = openssl_digest($pass, "sha224",false);
        $consulta = "select * from usuario where mail=:cor and pass=:pass";
        $stmt = $this->conexion->prepare($consulta);
        try{
            $stmt->execute([
                ':cor'=>$cor,
                'pass'=>$passCifrada
            ]);
        }catch(PDOException $ex){
            die("Error en validar usuarios, mensaje=".$ex->getMessage());
        }
        if($stmt->rowCount() == 0){
            return 0;
        }else{
            $datos = $stmt->fetch(PDO::FETCH_OBJ);
            $devolver = [$datos->mail, $datos->pass];
            $stmt = null;
            return $devolver;
        }
    }

    public function pintarCabecera()
    {
        echo "<div class='text-right' style='border: white 4px groove;'>";
        echo "<form name='cerrar' action='cerrarSesion.php' method='POST' style='display:inline;'>\n";
        echo "<b>Email:</b> " . $this->mail . "&nbsp|&nbsp;\n";
        echo "<b>Perfil:</b> " . $this->perfil . "&nbsp|&nbsp;\n";
       
        echo "<input type='hidden' name='token' value='{$_SESSION['token']}' />\n";
        echo "<input type='submit' class='btn btn-danger' value='Cerrar Session'>\n";
        echo "</form>&nbsp;";
        echo "<form name='mp' action='mperfil.php' method='POST' style='white-space:nowrap; display:inline'>";
        echo "<input type='hidden' name='token' value='{$_SESSION['token']}' />\n";
        echo "<input type='hidden' name='mail' value='{$this->mail}' />\n";
        echo "<input type='submit' value='Perfil' class='btn btn-warning' />\n";
        echo "</form>";
        echo "</div>";
    }

    
}