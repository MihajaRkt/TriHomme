<?php

namespace app\models;

use Flight;
use PDO;

class UserModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function verifier_user($email, $mdp)
    {
        $sql = "select * from User where mail_User=:email and pwd_User=:mdp";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':email' => $email,
            ':mdp' => $mdp
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insert_user($username, $email, $mdp)
    {
        $sql = "INSERT INTO User (nom_User, mail_User, pwd_User) VALUES (:username, :email, :mdp)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':username' => $username,
            ':email' => $email,
            ':mdp' => $mdp
        ]);
        return $this->db->lastInsertId();
    }

    public function getAdmin()
    {
        $sql = "SELECT * FROM User WHERE isAdmin = true";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}