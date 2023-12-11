<?php
require_once("userModel/UserModel.php");   

class UserControl{

    protected $user;

    public function __construct()
    {
        $this->user = new UserModel();
    }


    public function findAllUser(){
        try{
            $get = $this->user->findAllUser();
            $response = $get;
            http_response_code(200);
            echo json_encode($response);

        }catch(Exception $e){

            $response = array("error" => $e->getMessage());
            echo json_encode($response);
            http_response_code(400);
        }
    }

}
?>