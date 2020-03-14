<?php
// namespace PDOFINAL;
// use \;
class Televisores
{

    private $conexion;
    private $id;
    private $tipo;
    private $pulgadas;
    private $imagen;
    private $precio;
    private $descripcion;
    private $marca;



    public function __construct()
    {
        $numeroArg = func_num_args();
        if ($numeroArg == 1) {
            $this->setConexion(func_get_arg(0));
        }
    }

    public function setConexion($con)
    {
        $this->conexion = $con;
    }


    public function create($t, $p, $i, $pr, $d, $m)
    {
        $insertar = "insert into televisores(tipo, pulgadas, imagen, precio, descripcion, marca) values(:t,:p,:i,:pr,:d,:m)";
        $stmt = $this->conexion->prepare($insertar);
        try {
            $stmt->execute([
                ':t' => $t,
                ':p' => $p,
                ':i' => $i,
                ':pr' => $pr,
                ':d' => $d,
                ':m' => $m
            ]);
        } catch (PDOException $ex) {
            die("Error al guardar los televisores " . $ex->getMessage());
        }
    }


    public function getTotalRegistros()
    {
        $consulta = "select * from televisores";
        try {

            $televisores = $this->conexion->query($consulta);
        } catch (PDOException $ex) {
            die("Error al recuperar las plataformas!!!" . $ex->getMessage());
        }

        return $televisores->rowCount();
    }


    public function read($inf, $pag)
    {

        $consulta = "select * from televisores order by id limit $inf,$pag";
        try {
            $televisores = $this->conexion->query($consulta);
        } catch (PDOException $ex) {
            die("Error al recuperar las plataformas!!!" . $ex->getMessage());
        }

        return $televisores;
    }


    public function update()
    {
        if (func_num_args() == 7) {
            $id = func_get_arg(0);
            $tipo = func_get_arg(1);
            $pulgadas = func_get_arg(2);
            $imagen = func_get_arg(3);
            $precio = func_get_arg(4);
            $descripcion = func_get_arg(5);
            $marca = func_get_arg(6);

            $update = "update televisores set tipo=:t,pulgadas=:p, imagen=:i, precio=:p,descripcion=:d, marca=:m where id=:cod";
            $ima = true;
        } else {
            $id = func_get_arg(0);
            $tipo = func_get_arg(1);
            $pulgadas = func_get_arg(2);
            $precio = func_get_arg(3);
            $descripcion = func_get_arg(4);
            $marca = func_get_arg(5);
            $update = "update televisores set tipo=:t,pulgadas=:p, precio=:p,descripcion=:d, marca=:m where id=:cod";
            $ima = false;
        }
        $stmt = $this->conexion->prepare($update);
        try {
            if ($ima) {
                $stmt->execute([
                    ':t' => $tipo,
                    ':p' => $pulgadas,
                    ':i' => $imagen,
                    ':p' => $precio,
                    ':d' => $descripcion,
                    ':m' => $marca,
                    ':cod' => $id
                ]);
            } else {
                $stmt->execute([
                    ':t' => $tipo,
                    ':p' => $pulgadas,
                    ':p' => $precio,
                    ':d' => $descripcion,
                    ':m' => $marca,
                    ':cod' => $id
                ]);
            }
        } catch (PDOException $ex) {
            die("Error al actualizar: " . $ex->getMessage());
        }
    }

    public function delete($id)
    {
        $del = "delete from televisores where id=:cod";
        $stmt = $this->conexion->prepare($del);
        try {
            $stmt->execute([
                ':cod' => $id
            ]);
        } catch (PDOException $ex) {
            die("Error al borrar Televisor " . $ex->getMessage());
        }
    }


    public function borrarArchivoImagen($id)
    {
        $consulta = "select imagen from televisores where id=:cod";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([
                ':cod' => $id
            ]);
        } catch (PDOException $ex) {
            die($ex->getMessage());
        }
        $fila = $stmt->fetch(PDO::FETCH_OBJ);
        $miImagen = $fila->imagen;


        if (basename($miImagen) != 'default.jpg') {
            return $miImagen;
        }
        return 1;
    }

    public function verTelevisor($id)
    {
        $consulta = "select tipo,pulgadas,imagen,precio,descripcion,marca from televisores where id=:cod";
        $stmt = $this->conexion->prepare($consulta);
        try {
            $stmt->execute([
                ':cod' => $id
            ]);
        } catch (PDOException $ex) {
            die("Error al recuperar una plataforma!!! " . $ex->getMessage());
        }
        $fila = $stmt->fetch(PDO::FETCH_OBJ);
        return $fila;
    }
}
