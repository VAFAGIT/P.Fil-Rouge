<?php

class Activite extends Model
{
    public function __construct()
    {
        $this->table = 'activites';

        $this->getConnection();
    }

    /**
     * Retourne un article en fonction de son slug
     *
     * @param string $slug
     * @return void
     */


    public function create($data)
    {
        // print_r($data);
        // die;
        $query = "INSERT INTO  $this->table (`name`,`id_travel`,`Order`,`description`)VALUES(:name,:id_travel,:Order,:description)";
        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(':name',$data->name);
        $stmt->bindParam(':id_travel',$data->id_travel);
        $stmt->bindParam(':Order',$data->Order);
        $stmt->bindParam(':description',$data->description);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function find($DateConsult)
    {
        $sql = "SELECT o_rder FROM " . $this->table . " WHERE `DateConsult`='" . $DateConsult . "'";
        $query = $this->_connexion->prepare($sql);

        if ($query->execute()) {
            return  $query->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function update($data)
    {
        // print_r($data);
        // die;

        $query = " UPDATE   $this->table SET `name` = :name , `id_travel` = :id_travel , `Order` = :Order ,`description` = :Desc  WHERE `id` = :id " ;

        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':name', $data->name);
        $stmt->bindParam(':id_travel', $data->id_travel);
        $stmt->bindParam(':Order', $data->Order);
        $stmt->bindParam(':Desc', $data->description);
        $stmt->bindParam(':id', $data->id);
        $result=$stmt->execute();
      
        if ( $result) {
            return true;

        } else {
            return false;
        }
    }

    public function delete($data)
    {
        $id=$data->id;
        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;
        } 
        else {
            return false;
        }
    }

    public function get($data)
    {
  
        $query= "SELECT * FROM   $this->table  WHERE id_travel=:id ";
        //  = 'SELECT * FROM ' . $this->table . ' WHERE id =:ID ORDER BY name DESC';
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':id', $data->id_travel);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

}
