<?php

namespace app\controllers;

use app\models\ObjetModel;
use Flight;

class AccueilController {
    public function list()
    {
        $objetmodel = new ObjetModel(Flight::db());
        $objet = $objetmodel->getAllObjet();
        $data = ['liste'=>$objet];
        Flight::render('accueil', $data);
    }
}
