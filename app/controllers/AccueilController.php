<?php

namespace app\controllers;

use app\models\ObjetModel;
use app\models\UserModel;
use app\models\CategorieModel;
use Flight;

class AccueilController
{
    public function list($id_user)
    {
        $pdo = Flight::db();
        $objetmodel = new ObjetModel($pdo);
        $usermodel = new UserModel($pdo);

        $user = $usermodel->getUserById($id_user);
        $admin = $usermodel->getAdmin();

        $objet = $objetmodel->getAllObjet();
        $users = $usermodel->getAllUsers();
        $currentUser = $_SESSION['user'] ?? null;

        if ($user['id_User'] == $admin['id_User']) {
            $categories = new CategorieModel($pdo);
            Flight::render('backoffice-categorie', [
                'liste_categorie' => $categories,
                'baseUrl' => Flight::get('flight.base_url'),
            ]);
        } else {
            Flight::render('accueil', [
                'currentUser' => $user,
                'liste' => $objet,
                'users' => $users,
                'baseUrl' => Flight::get('flight.base_url'),
            ]);
        }
    }
}
