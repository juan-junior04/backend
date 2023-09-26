<?php
require_once("userModel/EventModel.php");   
Class UserControl{

    protected $evento;


    public function __construct(){
        $this->evento = new EventModel();
    }


    public function findAll(){
        try{
            $get = $this->evento->findAll();
            $response = array("response" => $get);
            http_response_code(200);
            echo json_encode($response);

        }catch(Exception $e){

            $response = array("error" => $e->getMessage());
            echo json_encode($response);
            http_response_code(400);
        }
       

    }

    public function save($evento):void{
        try{
            $get = $this->evento->save($evento);
            $response = array("response" => "creado");
            echo json_encode($response);
            http_response_code(200);
        }catch(Exception $e){
            $response = array("error" => $e->getMessage());
            echo json_encode($response);
            http_response_code(400);

        }
    }

    public function update($evento):void{
        try{
            $get = $this->evento->update($evento);
            $response = array("response" => "actualizado");
            echo json_encode($response);
            http_response_code(200);
        }catch(Exception $e){
            $response = array("error" => $e->getMessage());
            echo json_encode($response);
            http_response_code(400);

        }
    }

    public function delete($evento):void{
        try{
            $get = $this->evento->delete($evento);
            $response = array("response" => "eliminado");
            echo json_encode($response);
            http_response_code(200);
        }catch(Exception $e){
            $response = array("error" => $e->getMessage());
            echo json_encode($response);
            http_response_code(400);

        }
    }






}



?>