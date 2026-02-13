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
        Flight::render('frontoffice/gestion-objet', 
        ['objets' => $liste, 'id_User'=> $id_User,
        'baseUrl' => Flight::get('flight.base_url')]);
    }

    public function afficherFicheObjet($id_Objet){
        $pdo = Flight::db();
        $objetmodel = new ObjetModel($pdo);
        $infoMain = $objetmodel->getMainInfoObjet($id_Objet);
        $infoFille = $objetmodel->getFilleInfoObjet($id_Objet);
        Flight::render('frontoffice/fiche-produit', 
        ['main' => $infoMain[0],
         'fille' => $infoFille,
         'baseUrl' => Flight::get('flight.base_url')]);
    }
    public function afficherFormulaireAdd(){
        Flight::render('frontoffice/addform-objet', ['baseUrl' => Flight::get('flight.base_url')]);
    }
}
