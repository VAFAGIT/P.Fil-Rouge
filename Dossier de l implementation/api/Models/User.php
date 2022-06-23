<?php

class User extends Model
{

    public function __construct()
    {
        $this->table = 'users';

        $this->getConnection();
    }

    /**
     * Retourne un article en fonction de son slug

     */

    public function findId(string $slug)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE `id`='" . $slug . "'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function chekEmail($email)
    {
        $sql = "SELECT * FROM " . $this->table . " WHERE `email`='" . $email . "'";
        $query = $this->_connexion->prepare($sql);
        $query->execute();
        if ($query->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function create($data)
    {
        
    //   print_r($data);
    //   die;
    //  var_dump($data);
    // die();

        $chekEmail = $this->chekEmail($data->email);
        if ($chekEmail) {
            return false;
        }

        $query = "INSERT INTO  $this->table (fullname,password,email)VALUES(:fullname,:password,:email)";
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':fullname', $data->fullname);
        $stmt->bindParam(':email', $data->email);
        $stmt->bindParam(':password', $data->password);

       if($stmt->execute()){
           return 1;
       }
       else{
        return 0;
       }
   
    }

    public function get($data)
    {
        // print_r($data);
        // die;


        $sql = "SELECT * FROM   $this->table  WHERE email=:email AND password = :password ";
        $stmt = $this->_connexion->prepare($sql);

        $stmt->bindParam(':email', $data->email);
        $stmt->bindParam(':password', $data->password);
        $stmt->execute();
        $results=$stmt->fetchAll(PDO::FETCH_ASSOC);
  
        if (!empty($results)) {
            return $results;
        } else {
            return false;
        }
    }

    
}
