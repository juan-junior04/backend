<?php

header("Access-Control-Allow-Origin: http://localhost:4200"); // Reemplaza con la URL de tu aplicación Angular
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");

    if ($_SERVER["REQUEST_METHOD"] === "GET") {
        try{
            require_once("userControl/EventControl.php");
            $eventControl = new EventControl();
            $eventControl->findAll();
        }catch (Exception $e) {
            $response = array("error" => $e->getMessage());
            http_response_code($e->getCode());
            echo json_encode($response);
        }
    }

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $data = file_get_contents("php://input");
            $obj = json_decode($data);
            try{
                require_once("userControl/EventControl.php");
                $eventControl = new EventControl();
                $eventControl->save($obj);
            }catch (Exception $e) {
                $response = array("error" => $e->getMessage());
                http_response_code($e->getCode());
                echo json_encode($response);
            }
         }

         if ($_SERVER["REQUEST_METHOD"] === "PATCH") {
            $data = file_get_contents("php://input");
            $obj = json_decode($data);
            try{
                require_once("userControl/EventControl.php");
                $eventControl = new EventControl();
                $eventControl->update($obj);
            }catch (Exception $e) {
                $response = array("error" => $e->getMessage());
                http_response_code($e->getCode());
                echo json_encode($response);
            }
         }

         if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
            $data = file_get_contents("php://input");
            $obj = json_decode($data);
            try{
                require_once("userControl/EventControl.php");
                $eventControl = new EventControl();
                $eventControl->delete($obj->id);
            }catch (Exception $e) {
                $response = array("error" => $e->getMessage());
                http_response_code($e->getCode());
                echo json_encode($response);
            }
         }




        
        



?>