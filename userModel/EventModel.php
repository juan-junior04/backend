<?php



require_once("core/core.php");

Class EventModel{

    protected $con;

    public function __construct(){
        $this->con  = new Conectar();

    }

    public function findAll(){
       $conexion =  $this->con->con();
       $sql = "SELECT * FROM evento";
       $stm =  $conexion->prepare($sql);
       if(!$stm->execute()){
        throw new Exception("error de consulta");
       }else{
        return $stm->fetchAll(PDO::FETCH_OBJ); //retornando datos
       }
    }


    public function save($evento):void{
        $conexion = $this->con->con();

        $sql = "INSERT INTO evento(nombre_empresa,
        email , 
        telefono , 
        nit_empresa ,
        direccion , 
        observacion , 
        inicio , 
        finalizar) 
        values(:nombre_empresa,
        :email , :telefono ,
        :nit_empresa ,
        :direccion,
        :observacion,
        :inicio,:finalizar)";

        $stm = $conexion->prepare($sql);
        $stm->bindParam(":nombre_empresa", $evento->nombre_empresa);
        $stm->bindParam(":email", $evento->email);
        $stm->bindParam(":telefono", $evento->telefono);
        $stm->bindParam(":nit_empresa", $evento->nit_empresa);
        $stm->bindParam(":direccion", $evento->direccion);
        $stm->bindParam(":observacion", $evento->observacion);
        $stm->bindParam(":inicio", $evento->inicio);
        $stm->bindParam(":finalizar", $evento->finalizar);

        if(!$stm->execute())
        {   
            
            throw new Exception("Error al insertar datos");
            
        }
            
       
       
    }

    public function update($usuario){

        $conexion =  $this->con->con();

        $idexist = $this->verificarExistencia($usuario->id);

        if (!$idexist) {
            throw new Exception("El registro con ID " . $usuario->id . " no existe en la base de datos.");
        }
        
        $sql = "UPDATE evento Set nombre_empresa = :nombre_empresa,
        email= :email ,
        telefono = :telefono , 
        nit_empresa= :nit_empresa ,
        direccion = :direccion , observacion = :observacion , 
        inicio = :inicio , 
        finalizar = :finalizar WHERE id = :id";

       
        $stm = $conexion->prepare($sql);
        $stm->bindParam(":id",$usuario->id);
        $stm->bindParam(":nombre_empresa",$usuario->nombre_empresa);
        $stm->bindParam(":email",$usuario->email);
        $stm->bindParam(":telefono",$usuario->telefono);
        $stm->bindParam(":nit_empresa",$usuario->nit_empresa);
        $stm->bindParam(":direccion",$usuario->direccion);
        $stm->bindParam(":observacion",$usuario->observacion);
        $stm->bindParam(":inicio",$usuario->inicio);
        $stm->bindParam(":finalizar",$usuario->finalizar);

        if (!$stm->execute()) {
            throw new Exception("Error al preparar la consulta SQL.");
        }

    }

    private function verificarExistencia($id) {
        $conexion =  $this->con->con();
        $sql = "SELECT COUNT(*) FROM evento WHERE id = :id";
        $stm = $conexion->prepare($sql);
        $stm->bindParam(":id", $id);
        $stm->execute();
        $count = $stm->fetchColumn();
        return ($count > 0);
    }

    public function delete($id){
        $conexion = $this->con->con();
        $exitsId = $this->verificarExistencia($id);
        if(!$exitsId){
            
            throw new Exception("El registro con ID " . $id . " no existe en la base de datos.");
        }

        $sql = "DELETE FROM evento WHERE id= :id";
        $stm = $conexion->prepare($sql);
        $stm->bindParam(":id",$id);

        if(!$stm->execute())
        {
            throw new Exception("Error al insertar datos");
        }
        
    }
}

?>