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
        $sql = "select * from Objet";
        $stmt = $this->db->query($sql);
        return $stmt->fetch();
    }
}