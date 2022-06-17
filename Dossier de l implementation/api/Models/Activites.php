<?php

class Activites extends Model
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
        $query = 'INSERT INTO ' . $this->table . ' SET  name = :name, o_rder = :o_rder, description = :description ';
        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(':name', $data->name);
        $stmt->bindParam(':ID_voyage', $data->ID_voyage);
        $stmt->bindParam(':o_rder', $data->o_rder);
        $stmt->bindParam(':description', $data->description);

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
        $query = ' UPDATE ' . $this->table . ' SET name = :name, ID_voyage = :ID_voyage, o_rder = :o_rder,  description = :description  WHERE id = :ID ';
        // die(var_dump($data->Reference));

        $stmt = $this->_connexion->prepare($query);

        $stmt->bindParam(':name', $data->name);
        $stmt->bindParam(':ID_voyage', $data->ID_voyage);
        $stmt->bindParam(':o_rder', $data->o_rder);
        $stmt->bindParam(':description', $data->description);

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
