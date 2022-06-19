<?php

class Reservation extends Model
{
    public function __construct()
    {
        $this->table = 'reservation';

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
        $sql = "SELECT * FROM   $this->table  WHERE id_travel=:id_travel AND id_users = :id_users ";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindParam(':id_travel', $data->id_travel);
        $stmt->bindParam(':id_users', $data->id_users);
        $stmt->execute();
        $foundUser=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if ($foundUser) {
            return ' already booked';
        }

        $sql = "SELECT seats FROM voyage WHERE id=:id_travel ";
        $stmt = $this->_connexion->prepare($sql);
        $stmt->bindParam(':id_travel', $data->id_travel);
        $stmt->execute();
        $seats=$stmt->fetch(PDO::FETCH_ASSOC);
        if ($foundUser) {
            return 'no seats available';
        }

        if(!$foundUser && $seats['seats']!=0){
            $newSeats=$seats['seats']-1;
            $query = ' UPDATE voyage SET seats = :seats  WHERE id = :id ';
            $stmt = $this->_connexion->prepare($query);
            $stmt->bindParam(':seats', $newSeats);
            $stmt->bindParam(':id', $data->id_travel);
            $stmt->execute();
         

            $query = "INSERT INTO  $this->table ( id_travel , id_users )VALUES( :id_travel , :id_users)";
            $stmt = $this->_connexion->prepare($query);
            $stmt->bindParam(':id_travel', $data->id_travel);
            $stmt->bindParam(':id_users', $data->id_users);
    
            if ($stmt->execute()) {
                return 'everything went good ';
            } else {
                return 'something went wrong';
            }

        } 
        else {
            return 'first condition doesnt work ';
        }

       
    }
    public function delete($data)
    {

        $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':id', $data->id);
        if ($stmt->execute()) {
            return true;
        } 
        else {
            return false;
        }
    }

    public function getAdmin($data)
    {
        $query = "SELECT voyage.* , reservation.* FROM reservation JOIN voyage ON reservation.id_users = voyage.id_users AND reservation.id_users = :id_users ";
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':id_users', $data->id_users);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    public function getUser($data)
    {
        
        $query = "SELECT voyage.* , reservation.* FROM reservation JOIN voyage ON reservation.id_users = :id_users";
        $stmt = $this->_connexion->prepare($query);
        $stmt->bindParam(':id_users', $data->id_users);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

}
