<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST,UPDATE,DELETE,GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');




class Reviews extends Controller
{

    public function index()
    {

        $this->loadModel('Review');
        $Review = $this->Review->getAll();
        echo json_encode($Review);
        die();
        $this->render('index', compact('Review'));
    }
    
    public function UpdateStatus()
    {
        header('Content-Type: application/json');
        $this->loadModel('Review');
        $data = json_decode(file_get_contents("php://input"));
        $acc = $this->Review->update($data);
        if ($acc) {
            echo json_encode($acc);
        } 
    }
    public function createR()
    {
        header('Content-Type: application/json');
        $this->loadModel('Review');
        $data = json_decode(file_get_contents("php://input"));

        $acc = $this->Review->create($data);
        if ($acc) {
            echo json_encode('success');
        } else {
            echo json_encode('error');
        }
    }
    
    public function getAdmin()
    {
        header('Content-Type: application/json');
        $this->loadModel('Reservation');
        $data = json_decode(file_get_contents("php://input"));
        
        $this->loadModel('Reservation');
        $acc = $this->Reservation->getAdmin($data);
        
        
        if ($acc) {
            echo json_encode($acc);
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function getUser()
    {
        header('Content-Type: application/json');
        $this->loadModel('Reservation');
        $data = json_decode(file_get_contents("php://input"));
        
        $this->loadModel('Reservation');
        $acc = $this->Reservation->getUser($data);

        if ($acc) {
            echo json_encode($acc);
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

   
}
