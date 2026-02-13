<?php

namespace app\models;

use Flight;
use PDO;

class ObjetModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllObjet()
    {
        $sql= "SELECT Objet.*, User.*, Categorie.*, Categorie.libelle as cat_lib, Objet.libelle as obj_lib
        FROM Objet join User on Objet.id_proprietaire = User.id_User 
        join Categorie on Categorie.id_categorie = Objet.id_categorie";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getObjetbyId($idObjet)
    {
        $sql= "SELECT Objet.*, User.*, Categorie.*, Categorie.libelle as cat_lib, Objet.libelle as obj_lib
        FROM Objet join User on Objet.id_proprietaire = User.id_User 
        join Categorie on Categorie.id_categorie = Objet.id_categorie
        where Objet.id_Objet = :objet";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['objet' => $idObjet]);
        return $stmt ->fetch(PDO::FETCH_ASSOC);
    }

    public function getMyObject($id_User){
        $sql = "SELECT  Objet.libelle as libelle,
        Objet.prix as prix, Categorie.libelle as categorie, Objet.descriptions as descriptions,
        Categorie.libelle as categorie, Objet.id_Objet as id_Objet
        FROM Objet JOIN Categorie 
        ON Objet.id_Categorie = Categorie.id_Categorie 
        WHERE id_Proprietaire = $id_User";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt ->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllObjetbyUser($id_profil){
        $sql= "SELECT Objet.*, User.*, Categorie.*, Categorie.libelle as cat_lib, Objet.libelle as obj_lib
        FROM Objet join User on Objet.id_proprietaire = User.id_User 
        join Categorie on Categorie.id_categorie = Objet.id_categorie
        where Objet.id_proprietaire = :id_profil";

        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id_profil' => $id_profil]);
        return $stmt ->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getMainInfoObjet($id_Objet){
        $sql = "SELECT User.nom_User as nom_User, Objet.libelle as libelle,
        Objet.prix as prix, Categorie.libelle as categorie, Objet.descriptions as descriptions
         FROM Objet
        JOIN User ON Objet.id_Proprietaire = User.id_User
        JOIN Categorie ON Categorie.id_Categorie = Objet.id_Categorie
         WHERE id_Objet= $id_Objet ";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt ->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getFilleInfoObjet($id_Objet){
        $sql = "SELECT * FROM Objet_fille WHERE id_Objet = $id_Objet";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt ->fetchAll(PDO::FETCH_ASSOC);
    }
}