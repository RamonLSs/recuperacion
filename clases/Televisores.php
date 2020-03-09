<?php

class Televisores {
    private $llave;
    private $id;
    private $tipo;
    private $pulgadas;
    private $imagen;
    private $precio;
    private $descripcion;
    private $marca;


    public function __construct(){
        $num = func_num_args();
        if($num == 1){
            $this->llave = func_get_arg(0);
        }
        if($num == 7){
            $this->llave=func_get_arg(0);
            $this->tipo=func_get_arg(1);
            $this->pulgadas=func_get_arg(2);
            $this->imagen=func_get_arg(3);
            $this->precio=func_get_arg(4);
            $this->descripcion=func_get_arg(5);
            $this->marca=func_get_arg(7);
        }
    }


    public function read($inf, $pag){
        $consulta = "select * from televisores order by id limit $inf,$pag";
       
        try{
           $televisores = $this->llave->query($consulta);
        }catch(PDOException $ex){
            die("Error al recuperar los televisores: ".$ex);
        }
        
        return $televisores;
    }




    public function edit(){
        $edit = "update televisores set tipo=:t, pulgadas:=p, imagen=:i, precio=:pr, descripcion=:d, marca=:m";
        $stmt = $this->llave->prepare($edit);
        try{
            $stmt->execute([
                ':t'=>$this->tipo,
                ':p'=>$this->pulgadas,
                ':i'=>$this->imagen,
                ':pr'=>$this->precio,
                ':d'=>$this->descripcion,
                ':m'=>$this->marca,
            ]);
        }catch(PDOException $ex){
            die("Error al editar el televisor: ". $ex);
        }
    }



    public function delete(){
        $borrar = "delete from televisores where id=:id";
        $stmt=$this->llave->prepare($borrar);
        try{
            $stmt->exectute([
                ':id'=>$this->id
            ]);
        }catch(PDOException $ex){
            die("Error al borrar televisor: ".$ex);
        }
    }


    public function create(){
        $crear = "insert into televisores(tipo,pulgadas,imagen,precio,descripcion,marca) values(:t,:p,:i,:pr,:d,:m)";
        $stmt = $this->llave->prepare($crear);
        try{
            $stmt->execute([
                ':t'=>$this->tipo,
                ':p'=>$this->pulgadas,
                ':i'=>$this->imagen,
                ':pr'=>$this->precio,
                ':d'=>$this->descripcion,
                ':m'=>$this->marca,
            ]);
        }catch(PDOException $ex){
            die("Error al crear el televisor: ".$ex);
        }
    }

    public function getTotalRegistros(){
        $consulta = "select * from televisores";
        try{
            $televisores = $this->llave->query($consulta);
        }catch(PDOException $ex){
            die("Error al recuperar los televisores ".$ex->getMessage());
        }
        return $televisores->rowCount();
    }

}