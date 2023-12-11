<?php

require_once("core/core.php");

class UserModel{

    protected $con;

    public function __construct()
    {
        $this->con = new Conectar();
    }

    public function findAllUser(){
        $conexion =  $this->con->con();
        $sql= "SELECT * FROM usuario";
        $stm = $conexion->prepare($sql);
        if(!$stm->execute()){
            throw new Exception("error de consulta");
           }else{
            return $stm->fetchAll(PDO::FETCH_OBJ); 
           }
    }

}


?>