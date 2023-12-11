<?php



require_once("core/core.php");

Class InformeModel{

    protected $con;

    public function __construct(){
        $this->con  = new Conectar();

    }

    

    public function findAllInforme(){
        $conexion =  $this->con->con();
        $sql = "SELECT * FROM informe";
        $stm =  $conexion->prepare($sql);
        if(!$stm->execute()){
         throw new Exception("error de consulta");
        }else{
         return $stm->fetchAll(PDO::FETCH_OBJ); //retornando datos
        }
     }

     public function saveInforme($informe):void{
        $conexion = $this->con->con();

        $sql = "INSERT INTO informe(fecha,
        nombre_labor, 
        cantidad, 
        instrumento, 
        observacion,imagen) 
        values(:fecha,
        :nombre_labor ,
        :cantidad ,
        :instrumento ,
        :observacion,:imagen)";

        $stm = $conexion->prepare($sql);
        $stm->bindParam(":fecha", $informe->fecha);
        $stm->bindParam(":nombre_labor", $informe->nombre_labor);
        $stm->bindParam(":cantidad", $informe->cantidad);
        $stm->bindParam(":instrumento", $informe->instrumento);
        $stm->bindParam(":observacion", $informe->observacion);
        $stm->bindParam(":imagen", $informe->imagen);
        if(!$stm->execute())
        {   
            
            throw new Exception("Error al insertar datos");
        }
    }
    public function updateInforme($informe){

        $conexion =  $this->con->con();

        $idexist = $this->verificarExistencia($informe->id);

        if (!$idexist) {
            throw new Exception("El registro con ID " . $informe->id . " no existe en la base de datos.");
        }

        $sql = "UPDATE informe Set fecha = :fecha,
        nombre_labor= :nombre_labor ,
        cantidad = :cantidad , 
        instrumento= :instrumento ,
        observacion = :observacion 
         WHERE id = :id";

        $stm = $conexion->prepare($sql);
        $stm->bindParam(":id",$informe->id);
        $stm->bindParam(":fecha",$informe->fecha);
        $stm->bindParam(":nombre_labor",$informe->nombre_labor);
        $stm->bindParam(":cantidad",$informe->cantidad);
        $stm->bindParam(":instrumento",$informe->instrumento);
        $stm->bindParam(":observacion",$informe->observacion);


        if (!$stm->execute()) {
            throw new Exception("Error al preparar la consulta SQL.");
        }

    }

    


    public function deleteInforme($id){
        $conexion = $this->con->con();

        $idexist = $this->verificarExistencia($id);

        if (!$idexist) {
            throw new Exception("El registro con ID " . $id . " no existe en la base de datos.");
        }

        $sql = "DELETE FROM informe WHERE id= :id";
        $stm = $conexion->prepare($sql);
        $stm->bindParam(":id",$id);
        
        if(!$stm->execute())
        {
            throw new Exception("Error al eliminar datos");
        }
        
    }

    private function verificarExistencia($id) {
        $conexion =  $this->con->con();
        $sql = "SELECT COUNT(*) FROM informe WHERE id = :id";
        $stm = $conexion->prepare($sql);
        $stm->bindParam(":id", $id);
        $stm->execute();
        $count = $stm->fetchColumn();
        return ($count > 0);
    }

    public function findByFecha($fecha) {
    try {
        $conexion = $this->con->con();
        $sql = "SELECT * FROM informe WHERE fecha = :fecha";
        $stm = $conexion->prepare($sql);
        $stm->bindParam(":fecha", $fecha, PDO::PARAM_STR);

        if (!$stm->execute()) {
            $errorInfo = $stm->errorInfo();
            throw new Exception("Error de consulta: " . $errorInfo[2]);
        } else {
            return $stm->fetchAll(PDO::FETCH_OBJ);
        }
    } catch (Exception $e) {
        throw $e;
    }
}

    
    
    
}



?>