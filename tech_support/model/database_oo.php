<?php

class Database {
    private $dsn;
    private $username;
    private $password;
    private $db;

    public function __construct($dsn, $username, $password){
        $this->dsn = $dsn;
        $this->username = $username;
        $this->password = $password;
        try {
            $this->db = new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            include('../errors/database_error.php');
            exit();
        }
    }

    public function getPDO(){
        return $this->db;
    }
}




?>