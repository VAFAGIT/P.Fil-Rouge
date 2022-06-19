<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
// header('Access-Control-Allow-Headers: *');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

http_response_code(200);

class Users extends Controller
{
    /**
     * 
     *
     * @return void
     */

   
    public function create()
    {

       

        $data = json_decode(file_get_contents("php://input"));

        
        $this->loadModel('User');
        $status = $this->User->create($data);
       
        if ($status) {
         
            echo json_encode([http_response_code(200)]);
        } else {

            echo json_encode([http_response_code(500), "Error"]);
        }
    }

    public function login()
    {

        $data = json_decode(file_get_contents("php://input"));


        $this->loadModel('User');
        $result = $this->User->get($data);

        if ($result) {
            if($result[0]['role']==0){
                echo json_encode(['message'=>'success . is user','data'=>0]);
            }
            else{
                echo json_encode(['message'=>'success . is admin','data'=>1]);
            }
            
            
        } else {
            echo json_encode([http_response_code(500), "Not found"]);
        }

    }
}
