<?php

namespace app\controllers;

use app\models\ObjetModel;
use app\models\EchangeModel;
use app\models\UserModel;
use Flight;

class EchangeController
{
    public function proposerEchange($id_User, $id_autre, $id_objet){
        $pdo = Flight::db();
        $objetmodel = new ObjetModel($pdo);
        $liste = $objetmodel->getAllObjetbyUser($id_User);
        $liste2 = $objetmodel->getAllObjetbyUser($id_autre);
        $objet = $objetmodel->getObjetbyId($id_objet);

        $userModel= new UserModel($pdo);
        $user = $userModel->getUserById($id_User);
        $user2 = $userModel->getUserById($id_autre);

        Flight::render('frontoffice/demande-echange', 
        ['liste' => $liste,
        'demande' => $liste2,
        'objet' => $objet,
        'currentUser' => $user,
        'user' => $user2,
        'baseUrl' => Flight::get('flight.base_url'),
        ]);
    }
    
    public function listeDemande($id_user)
    {
        $echange = new EchangeModel(Flight::db());
        $liste = $echange->getRequets($id_user);

        $user = new UserModel(Flight::db());
        $current = $user->getUserById($id_user);

        Flight::render(
            'frontoffice/gestion-demande',
            [
                'currentUser' => $current,
                'listeDemande' => $liste,
                'baseUrl' => Flight::get('flight.base_url'),
            ]
        );
    }

    public function accept($id_echange) {
        $echange = new EchangeModel(Flight::db());
        $echange->acceptEchange($id_echange);
    }

    public function reject($id_echange) {
        $echange = new EchangeModel(Flight::db());
        $echange->rejectEchange($id_echange);
    }
}