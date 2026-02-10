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
        $sql = "SELECT * FROM User WHERE mail_User = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user && $user['pwd_User'] === $mdp) {
            return $user;
        }
        return false;
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

    public function getUserById($id)
    {
        $sql = "SELECT * FROM User WHERE id_User = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers()
    {
        $sql = "SELECT id_User, nom_User, mail_User, isAdmin FROM User";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAdmin()
    {
        $sql = "SELECT * FROM User WHERE isAdmin = true";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}