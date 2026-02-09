<?php

namespace app\models;

use Flight;
use PDO;

class LoginModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function verifier_user($email, $mdp)
    {
        $sql = "select * from Users where email=:email and mdp=:mdp";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':email' => $email,
            ':mdp' => $mdp
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_user($username, $email, $mdp)
    {
        $sql = "INSERT INTO Users (username, email, mdp) VALUES (:username, :email, :mdp)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':mdp' => $mdp
        ]);
        return $this->db->lastInsertId();
    }
}