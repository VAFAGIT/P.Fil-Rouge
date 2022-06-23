<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: *');
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
                
        $user = $this->loadModel('User');
        $status = $this->User->create($data);
       
        if ($status) {
            echo json_encode([http_response_code(200)]);
        } else {
            echo 'false';

            // echo json_encode([http_response_code(500), "Error"]);
        }
    }

    public function login()
    {

        $data = json_decode(file_get_contents("php://input"));


        $this->loadModel('User');
        $result = $this->User->get($data);
        // echo json_encode($data);
        // return;

        if ($result) {
            if($result[0]['role']==0){
                
                echo json_encode(['message'=>'success is user','role'=>0,'result'=>$result]);
            }
            else{
                echo json_encode(['message'=>'success is admin','role'=>1,'result'=>$result]);
            }
            
            
        } else {
            echo json_encode(["message"=>"Not found",'result'=>0]);
        }

    }
}
