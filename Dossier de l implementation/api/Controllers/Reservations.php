<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST,UPDATE,DELETE,GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');




class Reservations extends Controller
{

    public function index()
    {

        $this->loadModel('Reservation');
        $reservation = $this->Reservation->getAll();
        echo json_encode($reservation);
        $this->render('index', compact('reservation'));
    }
    
    public function addReservation()
    {
        header('Content-Type: application/json');
        $this->loadModel('Reservation');
        $data = json_decode(file_get_contents("php://input"));
        // print_r($data);
        // die;
        $acc = $this->Reservation->create($data);
        if ($acc) {
            echo json_encode($acc);
        } 
    }
    public function delete()
    {
        header('Content-Type: application/json');
        $this->loadModel('Reservation');
        $data = json_decode(file_get_contents("php://input"));

        $acc = $this->Reservation->delete($data);
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
