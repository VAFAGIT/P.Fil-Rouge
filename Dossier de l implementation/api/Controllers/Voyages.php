<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST,UPDATE,DELETE,GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');




class Voyages extends Controller
{
    // 
    public function index()
    {

        $this->loadModel('Voyage');
        $voyage = $this->Voyage->getAll();
        echo json_encode($voyage);
        $this->render('index', compact('voyage'));
    }

    public function addVoyage()
    {
        header('Content-Type: application/json');
        $this->loadModel('Voyage');
        $data = json_decode(file_get_contents("php://input"));

        $acc = $this->Voyage->create($data);
        if ($acc) {
           
            echo json_encode(['success']);
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function findVoyage()
    {
        header('Content-Type: application/json');
        $this->loadModel('Voyage');
        $data = json_decode(file_get_contents("php://input"));

        
        $result = $this->Voyage->find($data);
        if ($result) {
            echo json_encode(['success', $result]);
        } else {
            echo json_encode(['status', 'error']);
        }
    }

    public function update()
    {
        header('Content-Type: application/json');
        $this->loadModel('Voyage');
        $data = json_decode(file_get_contents("php://input"));

        $acc = $this->Voyage->update($data);
        if ($acc) {

            echo json_encode('success');
        } else {

            echo json_encode(array('status' => 'error'));
        }
    }

    public function delete()
    {
        header('Content-Type: application/json');
        $this->loadModel('Voyage');
        $data = json_decode(file_get_contents("php://input"));

        $acc = $this->Voyage->delete($data);
        if ($acc) {
            echo json_encode('success');
        } else {
            echo json_encode('error');
        }
    }
    
    public function get()
    {
        header('Content-Type: application/json');
        $this->loadModel('Voyage');
        $data = json_decode(file_get_contents("php://input"));
       
        $acc = $this->Voyage->get($data);

        if ($acc) {
            echo json_encode($acc);
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function find()
    {
        header('Content-Type: application/json');
        $this->loadModel('Voyage');
        $data = json_decode(file_get_contents("php://input"));

        $this->LoadModel('Voyage');
        $result = $this->Voyage->getOne($data);
        if ($result) {
            echo json_encode(['success', $result]);
        } else {
            echo json_encode(['status', 'error']);
        }
    
    
    }
}
