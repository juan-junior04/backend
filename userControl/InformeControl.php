<?php

require_once("userModel/InformeModel.php");   
Class InformeControl{

    protected $informe;


    public function __construct(){
        $this->informe = new InformeModel();
    }


  

    public function findAllInforme(){
        try{
            $get = $this->informe->findAllInforme();
            $response = $get;
            http_response_code(200);
            echo json_encode($response);

        }catch(Exception $e){

            $response = array("error" => $e->getMessage());
            echo json_encode($response);
            http_response_code(400);
        }
    }

    public function saveInforme($informe):void{
        try{
            $get = $this->informe->saveInforme($informe);
            $response = array("response" => "creado");
            echo json_encode($response);
            http_response_code(200);
        }catch(Exception $e){
            $response = array("error" => $e->getMessage());
            echo json_encode($response);
            http_response_code(400);

        }
    }


    public function updateInforme($informe):void{
        try{
            $get = $this->informe->updateInforme($informe);
            $response = array("response" => "actualizado");
            echo json_encode($response);
            http_response_code(200);
        }catch(Exception $e){
            $response = array("error" => $e->getMessage());
            echo json_encode($response);
            http_response_code(400);

        }
    }

    public function deleteInforme($informe):void{
        try{
            $get = $this->informe->deleteInforme($informe);
            $valor = $informe;
            $response = array("response" => $valor);
            echo json_encode($response);
            http_response_code(200);
        }catch(Exception $e){
            $response = array("error" => $e->getMessage());
            echo json_encode($response);
            http_response_code(400);

        }
    }

   public function findByFecha($fecha) {
    try {

        $resultados = $this->informe->findByFecha($fecha);
        $response = array("response" => $resultados);
        echo json_encode($response);
        http_response_code(200);

    } catch (Exception $e) {
        $errorResponse = array("error" => $e->getMessage());
        echo json_encode($errorResponse);
        http_response_code(400);
  
    }
}

    }
    
    
    

   





?>