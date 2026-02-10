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
        return $stmt ->fetchAll(PDO::FETCH_ASSOC);
    }
    
}