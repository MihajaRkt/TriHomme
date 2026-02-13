<?php

namespace app\models;

use Flight;
use PDO;

class CategorieModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAllCategories()
    {
        $stmt = $this->db->prepare("SELECT * FROM Categorie");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getCategorieById($id_categorie)
    {
        $stmt = $this->db->prepare("SELECT * FROM Categorie WHERE id_Categorie = ?");
        $stmt->execute([$id_categorie]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function saveCategorie($data)
    {
        $stmt = $this->db->prepare("INSERT INTO Categorie (libelle) VALUES (?)");
        $stmt->execute([$data['nom_categorie']]);
    }
    
    public function updateCategorie($data)
    {
        $stmt = $this->db->prepare("UPDATE Categorie SET libelle = ? WHERE id_Categorie = ?");
        $stmt->execute([$data['nouveau_nom'], $data['id_categorie']]);
    }
    
    public function deleteCategorie($id_categorie)
    {
        $stmt = $this->db->prepare("DELETE FROM Categorie WHERE id_Categorie = ?");
        $stmt->execute([$id_categorie]);
    }

    public function getNumberCategories()
    {
        $cat = $this->getAllCategories();
        $result = array();
        foreach ($cat as $c) {
            $stmt = $this->db->prepare("select count(Objet.id_Categorie) nombre, Categorie.libelle nom_categorie
                from Categorie join Objet on Objet.id_Categorie = Categorie.id_Categorie
                where Objet.id_Categorie = ?");

            $stmt->execute([$c['id_Categorie']]);
            $val = $stmt->fetch(PDO::FETCH_ASSOC);
            $result[] = [
                'id_categorie' => $c['id_Categorie'],
                'nom' => $c['libelle'],
                'nombre' => $val['nombre'],
            ];
        }
        return $result;
    }
}