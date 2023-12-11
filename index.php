<?php

include("core/core.php");

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers: Content-Type');

// Manejar la solicitud OPTIONS para las solicitudes pre-vuelo
if ($_SERVER["REQUEST_METHOD"] === "OPTIONS") {
    http_response_code(200);
    exit();
}


    if ($_SERVER["REQUEST_METHOD"] === "GET") {
       

        if (isset($_GET['action'])) {
            if ($_GET['action'] === 'findAll') {
                require_once("userControl/EventControl.php");
                $eventControl = new EventControl();
                $eventControl->findAll();
            } elseif ($_GET['action'] === 'findAllInforme') {
                require_once("userControl/InformeControl.php");
                $informeControl = new InformeControl();
                $informeControl->findAllInforme();
            }elseif ($_GET['action'] === 'findAllUser') {
                require_once("userControl/UserControl.php");
                $informeControl = new UserControl();
                $informeControl->findAllUser();
            }elseif ($_GET['action'] === 'findByFecha') {
                require_once("userControl/InformeControl.php");
                $fechaBuscada = new InformeControl();
                $fecha = $_GET['fecha']; // Obtener la fecha de la URL
                $fechaBuscada->findByFecha($fecha);
            }
            
             
        }
    }
    
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $data = file_get_contents("php://input");
        $obj = json_decode($data);
    
        if (isset($_GET['action'])) {
            if ($_GET['action'] === 'save') {
                require_once("userControl/EventControl.php");
                $eventControl = new EventControl();
                $eventControl->save($obj);
            } elseif ($_GET['action'] === 'saveInforme') {
                require_once("userControl/InformeControl.php");
                $informeControl = new InformeControl();
                $informeControl->saveInforme($obj);
            } else {
                
                http_response_code(400); 
                echo json_encode(array("error" => "Acción no válida."));
            }
        } else {
            
            http_response_code(400);
            echo json_encode(array("error" => "Acción no válida."));
        }
    }
    
    if ($_SERVER["REQUEST_METHOD"] === "PUT") {
        $data = file_get_contents("php://input");
        $obj = json_decode($data);
    
        if (isset($_GET['action'])) {
            if ($_GET['action'] === 'update') {
                require_once("userControl/EventControl.php");
                $eventControl = new EventControl();
                $eventControl->update($obj);
            } elseif ($_GET['action'] === 'updateInforme') {
                require_once("userControl/InformeControl.php");
                $informeControl = new InformeControl();
                $informeControl->updateInforme($obj);
            } else {
                
                http_response_code(400); 
                echo json_encode(array("error" => "Acción no válida."));
            }
        } else {
            
            http_response_code(400);
            echo json_encode(array("error" => "Acción no válida."));
        }
    }

    if ($_SERVER["REQUEST_METHOD"] === "DELETE") {
        $data = file_get_contents("php://input");
        $obj = json_decode($data);
    
        if (isset($_GET['action'])) {
            if ($_GET['action'] === 'delete') {
                require_once("userControl/EventControl.php");
                $eventControl = new EventControl();
                $eventControl->delete($obj->id);
            } elseif ($_GET['action'] === 'deleteInforme') {
                require_once("userControl/InformeControl.php");
                $informeControl = new InformeControl();
                $informeControl->deleteInforme($obj->id);
            } else {
                
                http_response_code(400); 
                echo json_encode(array("error" => "Acción no válida."));
            }
        } else {
            
            http_response_code(400);
            echo json_encode(array("error" => "Acción no válida."));
        }
    }
    
    
    







        
        



?>