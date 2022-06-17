<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST,UPDATE,DELETE,GET');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');




class Activites extends Controller
{

    public function index()
    {

        $this->loadModel('Activites');
        $activites = $this->Activites->getAll();
        echo json_encode($activites);
        die();
        $this->render('index', compact('activites'));
    }

    public function addActivites()
    {
        header('Content-Type: application/json');
        $this->loadModel('Activites');
        $data = json_decode(file_get_contents("php://input"));
        $acc = $this->Activites->create($data);
        if ($acc) {
            $activites = $this->Activites->get($data->ID);;

            echo json_encode(['success', $activites]);
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function findActivites($o_rder)
    {
        $this->loadModel('Activites');
        $result = $this->Activites->find($o_rder);
        if ($result) {
            echo json_encode(['success', $result]);
        } else {
            echo json_encode(['status', 'error']);
        }
    }

    public function update($id)
    {
        header('Content-Type: application/json');
        $this->loadModel('Activites');
        $data = json_decode(file_get_contents("php://input"));

        $acc = $this->Activites->update($data, $id);
        // die(var_dump($acc ));
        if ($acc) {

            echo json_encode('success');
        } else {

            echo json_encode(array('status' => 'error'));
        }
    }

    public function delete($id)
    {
        $this->loadModel('Activites');

        $acc = $this->Activites->delete($id);
        if ($acc) {
            echo json_encode('success');
        } else {
            echo json_encode('error');
        }
    }
    
    public function get($id)
    {
        $this->loadModel('Activites');
        $acc = $this->Activites->get($id);

        if ($acc) {
            echo json_encode($acc);
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function find($id)
    {   
        $this->LoadModel('Activites');
        $result = $this->Activites->getOne($id);
        if ($result) {
            echo json_encode(['success', $result]);
        } else {
            echo json_encode(['status', 'error']);
        }
    
    
    }

}
