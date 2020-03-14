<?php
// namespace PDOFINAL;

class Usuarios
{

    private $conexion;
    private $id;
    private $email;
    private $pass;

    public function __construct()
    {
      
        $numParam = func_num_args();
        if ($numParam == 1) {
            
            $this->ponerConexion(func_get_arg(0));
        }
        if ($numParam == 3) {
            $this->id = func_get_arg(0);
            $this->email = func_get_arg(1);
            
        }
    }

    public function ponerConexion($con)
    {
        $this->conexion = $con;
    }

 
    public function validar($ema, $pass)
    {
      
        $consulta = "select * from usuarios where email=:ema and pass=:pass";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([
                ':ema' => $ema,
                ':pass' => $pass
            ]);
        } catch (PDOException $ex) {
            die("Error en validar usuarios, mensaje=" . $ex->getMessage());
        }
        if ($stmt->rowCount() == 0) {
            
            return 0;
        } else {
            
            $datos = $stmt->fetch(PDO::FETCH_OBJ);
            $devolver = [$datos->email];
            $stmt = null;

            return $devolver;
          

        }
    }
    
}  