<?php

namespace app\models;

use Flight;
use PDO;

class EchangeModel
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getRequets($id_user)
    {
        $sql = "SELECT Echanges.idEchange, u1.nom_User, ob1.libelle libEnvoyeur, ob2.libelle libReceveur FROM Echanges ec
            join User u1 on u1.id_User = ec.idEnvoyeur
            join Objet ob1 on ob1.id_Objet = ec.idObjetEnvoyeur
            join Objet ob2 on ob2.id_Objet = ec.idObjetReceveur
            WHERE idReceveur = :id and status is NULL";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id_user]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function acceptEchange($id_echange)
    {
        $sql = "update Echanges set statut = 1 where idEchange = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id_echange]);
    }

        public function rejectEchange($id_echange)
    {
        $sql = "update Echanges set statut = 0 where idEchange = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':id' => $id_echange]);
    }


}