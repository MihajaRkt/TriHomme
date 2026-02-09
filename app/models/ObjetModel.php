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
        $stmt = $this->db->prepare("SELECT * FROM Objet");
        $stmt->execute();
        return $stmt ->fetchAll(PDO::FETCH_ASSOC);
    }
}