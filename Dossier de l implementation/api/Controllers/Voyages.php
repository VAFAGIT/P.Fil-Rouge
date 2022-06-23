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
        //  var_dump($data);
        //  die();
        $acc = $this->Voyage->create($data);
        if ($acc) {
           
            echo json_encode(true);
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

    public function update($id)
    {
        header('Content-Type: application/json');
        $this->loadModel('Voyage');
        $data = json_decode(file_get_contents("php://input"));

        $acc = $this->Voyage->update($data,$id);
        if ($acc) {

            echo json_encode(true);
        } else {

            echo json_encode(array('status' => 'error'));
        }
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        $this->loadModel('Voyage');
        // $data = json_decode(file_get_contents("php://input"));

        $acc = $this->Voyage->delete($id);
        if ($acc) {
            echo json_encode('success');
        } else {
            echo json_encode('error');
        }
    }
    
    public function getall()
    {
        header('Content-Type: application/json');
        $this->loadModel('Voyage');
       
        $acc = $this->Voyage->getAll();
       
        if ($acc) {
            echo json_encode($acc);
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function find($id)
    {
        header('Content-Type: application/json');
        $this->loadModel('Voyage');
        $this->LoadModel('Voyage');
        $result = $this->Voyage->getOne($id);
        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(['status', 'error']);
        }
    
    
    }
}
