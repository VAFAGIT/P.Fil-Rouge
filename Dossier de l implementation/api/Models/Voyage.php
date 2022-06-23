<?php

class Voyage extends Model
{
    public function __construct()
    {
        $this->table = 'voyage';

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
        // var_dump($data);
        // die();
        $query = "INSERT INTO  $this->table (date_D,duration,seats,price,id_users)VALUES(:date_D,:duration,:seats,:price,:id_users)";
        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(':date_D', $data->date_D);
        $stmt->bindParam(':duration', $data->duration);
        $stmt->bindParam(':seats', $data->seats);
        $stmt->bindParam(':price', $data->price);
        $stmt->bindParam(':id_users', $data->id_users);

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

    public function update($data,$id)
    {
        $query = ' UPDATE ' . $this->table . ' SET date_D = :date_D, duration = :duration, seats = :seats,  price = :price  WHERE id = :id ';
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':date_D', $data->date_D);
        $stmt->bindParam(':duration', $data->duration);
        $stmt->bindParam(':seats', $data->seats);
        $stmt->bindParam(':price', $data->price);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return true;

        } else {

            return false;
        }
    }

    public function delete($id)
    {
       
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
        $id=$data->id;

        $query = 'SELECT * FROM ' . $this->table . ' WHERE id =:id ORDER BY name DESC';
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':id', $id);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

}
