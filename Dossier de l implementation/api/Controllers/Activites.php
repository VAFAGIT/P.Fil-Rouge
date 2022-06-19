<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST,UPDATE,DELETE,GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');




class Activites extends Controller
{

    public function index()
    {

        $this->loadModel('Activite');
        $activite = $this->Activite->getAll();
        echo json_encode($activite);
        $this->render('index', compact('activite'));
    }

    public function addActivites()
    {
        header('Content-Type: application/json');
        $this->loadModel('Activite');
        $data = json_decode(file_get_contents("php://input"));
        $acc = $this->Activite->create($data);

        if ($acc) {
         echo json_encode(['success']);
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    // public function findActivite($o_rder)
    // {
    //     $this->loadModel('Activite');
    //     $result = $this->Activite->find($o_rder);
    //     if ($result) {
    //         echo json_encode(['success', $result]);
    //     } else {
    //         echo json_encode(['status', 'error']);
    //     }
    // }

    public function update()
    {
        header('Content-Type: application/json');
        $this->loadModel('Activite');
        $data = json_decode(file_get_contents("php://input"));

        $acc = $this->Activite->update($data);
      
        if ($acc) {

            echo json_encode('success');
        } else {

            echo json_encode(array('status' => 'error'));
        }
    }

    public function delete()
    {
        header('Content-Type: application/json');
        $this->loadModel('Activite');
        $data = json_decode(file_get_contents("php://input"));

        $acc = $this->Activite->delete($data);
        if ($acc) {
            echo json_encode('success');
        } else {
            echo json_encode('error');
        }
    }
    
    public function get()
    {
        header('Content-Type: application/json');
        $this->loadModel('Activite');
        $data = json_decode(file_get_contents("php://input"));
        $acc = $this->Activite->get($data);

        if ($acc) {
            echo json_encode($acc);
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function find($id)
    {   
        $this->LoadModel('Activite');
        $result = $this->Activite->getOne($id);
        if ($result) {
            echo json_encode(['success', $result]);
        } else {
            echo json_encode(['status', 'error']);
        }
    
    
    }

}
