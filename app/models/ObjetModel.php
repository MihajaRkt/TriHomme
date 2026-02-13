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

    public function getMyObject($id_User){
        $sql = "SELECT * FROM Objet JOIN Categorie 
        ON Objet.id_Categorie = Categorie.id_Categorie 
        WHERE id_Proprietaire = $id_User";

        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt ->fetchAll(PDO::FETCH_ASSOC);
    }
}