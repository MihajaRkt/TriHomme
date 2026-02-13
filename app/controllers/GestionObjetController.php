<?php

namespace app\controllers;

use app\models\ObjetModel;
use Flight;

class GestionObjetController
{
    public function afficherMesObjets($id_User){
        $pdo = Flight::db();
        $objetmodel = new ObjetModel($pdo);
        $liste = $objetmodel->getMyObject($id_User);
        Flight::render('frontoffice/gestion-objet', ['objets' => $liste]);
    }
}
