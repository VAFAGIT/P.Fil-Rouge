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
         echo json_encode(true);
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

   

    public function update($id)
    {
        header('Content-Type: application/json');
        $this->loadModel('Activite');
        $data = json_decode(file_get_contents("php://input"));
      
        
        $acc = $this->Activite->update($data,$id);
      
        if ($acc) {

            echo json_encode(true);
        } else {

            echo json_encode(false);
        }
    }

    public function delete($id)
    {
        header('Content-Type: application/json');
        $this->loadModel('Activite');
        // $data = json_decode(file_get_contents("php://input"));

        $acc = $this->Activite->delete($id);
        if ($acc) {
            echo json_encode('success');
        } else {
            echo json_encode('error');
        }
    }
    
    public function getallActiv($id)
    {
        header('Content-Type: application/json');
        $this->loadModel('Activite');
       
        $acc = $this->Activite->getallActiv($id);

        if ($acc) {
            echo json_encode($acc);
        } else {
            echo json_encode(array('status' => 'error'));
        }
    }

    public function getOneActiv($id)
    {   
        $this->LoadModel('Activite');
        $result = $this->Activite->getOne($id);
        if ($result) {
            echo json_encode($result);
        } else {
            echo json_encode(['status', 'error']);
        }
    
    
    }

}
