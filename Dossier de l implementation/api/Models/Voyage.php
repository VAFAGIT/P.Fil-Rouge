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
        $query = 'INSERT INTO ' . $this->table . ' SET  date_D = :date_D, durée = :durée, seats = :seats, price = :price ';
        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(':date_D', $data->date_D);
        $stmt->bindParam(':durée', $data->durée);
        $stmt->bindParam(':seats', $data->seats);
        $stmt->bindParam(':price', $data->price);

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

    public function update($data, $id)
    {
        $query = ' UPDATE ' . $this->table . ' SET date_D = :date_D, durée = :durée, seats = :seats,  price = :price  WHERE id = :ID ';
        // die(var_dump($data->Reference));

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(':date_D', $data->date_D);
        $stmt->bindParam(':durée', $data->durée);
        $stmt->bindParam(':seats', $data->seats);
        $stmt->bindParam(':price', $data->price);

        $stmt->bindParam(':ID', $id);

        // die(var_dump($data->DateConsult));

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

    public function get($id)
    {
        // die($Reference);
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id =:ID ORDER BY name DESC';
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':ID', $id);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

}
