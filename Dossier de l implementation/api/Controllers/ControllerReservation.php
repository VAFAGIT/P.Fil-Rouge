<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST,UPDATE,DELETE,GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');




class Reservation extends Controller
{

    public function index()
    {

        $this->loadModel('Reservation');
        $reservation = $this->Reservation->getAll();
        echo json_encode($reservation);
        die();
        $this->render('index', compact('reservation'));
    }
    
    public function addReservation()
    {
        header('Content-Type: application/json');
        $this->loadModel('Reservation');
        $data = json_decode(file_get_contents("php://input"));
        $acc = $this->Reservation->create($data);
        if ($acc) {
            $reservation = $this->Reservation->get($data->ID);;

            echo json_encode(['success', $reservation]);
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function findReservations($id)
    {
        $this->loadModel('Reservation');
        $result = $this->Reservation->find($id);
        if ($result) {
            echo json_encode(['success', $result]);
        } else {
            echo json_encode(['status', 'error']);
        }
    }

    public function update($id)
    {
        header('Content-Type: application/json');
        $this->loadModel('Reservation');
        $data = json_decode(file_get_contents("php://input"));

        $acc = $this->Reservation->update($data, $id);
        // die(var_dump($acc ));
        if ($acc) {

            echo json_encode('success');
        } else {

            echo json_encode(array('status' => 'error'));
        }
    }

    public function delete($id)
    {
        $this->loadModel('Reservation');

        $acc = $this->Reservation->delete($id);
        if ($acc) {
            echo json_encode('success');
        } else {
            echo json_encode('error');
        }
    }
    
    public function get($id)
    {
        $this->loadModel('Reservation');
        $acc = $this->Reservation->get($id);

        if ($acc) {
            echo json_encode($acc);
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function find($id)
    {
        
        $this->LoadModel('Reservation');
        $result = $this->Reservation->getOne($id);
        if ($result) {
            echo json_encode(['success', $result]);
        } else {
            echo json_encode(['status', 'error']);
        }
    
    
    }
}
