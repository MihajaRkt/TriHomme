<?php

namespace app\controllers;

use app\models\ObjetModel;
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
}