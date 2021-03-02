<?php

class TechnicianDB {
    private $db;


    public function __construct(){
        $dsn = 'mysql:host=localhost;dbname=tech_support';
        $username = 'ts_user';
        $password = 'pa55word';
        $this->db = new Database($dsn, $username, $password);
    }

    public function get_technicians(){
        $pdo = $this->db->getPDO();
        $query = 'SELECT * FROM technicians
                ORDER BY lastName';
        $statement = $pdo->prepare($query);
        $statement->execute();
        $techniciansArray = $statement->fetchAll();
        $statement->closeCursor();
        $technicians = array();
        foreach ($techniciansArray as $techArray){
            $techID = $techArray['techID'];
            $firstName = $techArray['firstName'];
            $lastName = $techArray['lastName'];
            $email = $techArray['email'];
            $phone = $techArray['phone'];
            $password = $techArray['password'];

            $technician = new Technician($techID, $firstName, $lastName, $email, $phone, $password);
            $technicians[] = $technician;
        }

        return $technicians;
    }

    public function get_technician($tech_ID){
        $pdo = $this->db->getPDO();
        $query = 'SELECT * FROM technicians
                WHERE techID = :tech_ID';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':tech_ID', $tech_ID);
        $statement->execute();
        $techArray = $statement->fetch();
        $statement->closeCursor();

        $techID = $techArray['techID'];
        $firstName = $techArray['firstName'];
        $lastName = $techArray['lastName'];
        $email = $techArray['email'];
        $phone = $techArray['phone'];
        $password = $techArray['password'];

        $technician = new Technician($techID, $firstName, $lastName, $email, $phone, $password);
        

        return $technician;
    }

    public function delete_technician($tech_ID){
        $pdo = $this->db->getPDO();
        $query = 'DELETE FROM technicians
              WHERE techID = :tech_ID';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':tech_ID', $tech_ID);
        $statement->execute();
        $statement->closeCursor();
    }

    public function add_technician($technician){
        $pdo = $this->db->getPDO();
        $query = 'INSERT INTO technicians
                 (firstName, lastName, email, phone, password)
              VALUES
                 (:firstName, :lastName, :email, :phone, :password)';
        $statement = $pdo->prepare($query);
        $statement->bindValue(':firstName', $technician->getFirstName());
        $statement->bindValue(':lastName', $technician->getLastName());
        $statement->bindValue(':email', $technician->getEmail());
        $statement->bindValue(':phone', $technician->getPhone());
        $statement->bindValue(':password', $technician->getPassword());
        $statement->execute();
        $statement->closeCursor();
    }
}



?>