<?php

namespace app\controllers;

use app\models\ObjetModel;
use app\models\UserModel;
use Flight;

class AccueilController {
    public function list()
    {
        $pdo = Flight::db();
        $objetmodel = new ObjetModel($pdo);
        $usermodel = new UserModel($pdo);

        $objet = $objetmodel->getAllObjet();
        $users = $usermodel->getAllUsers();
        $currentUser = $_SESSION['user'] ?? null;

        Flight::render('accueil', [
            'liste' => $objet,
            'users' => $users,
            'currentUser' => $currentUser,
            'baseUrl' => Flight::get('flight.base_url'),
        ]);
    }
}
