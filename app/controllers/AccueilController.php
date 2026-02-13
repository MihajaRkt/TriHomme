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
        // $currentUser = $_SESSION['user'] ?? null;

        if ($admin != NULL) {
            if ($user['id_User'] == $admin[0]['id_User']) {
                $categorie = new CategorieModel($pdo);
                $categories = $categorie->getNumberCategories();
                $nombreUtilisateurs = count($users);

                Flight::render('backoffice/backoffice-categorie', [
                    'currentUser' => $user,
                    'liste_categorie' => $categories,
                    'nombre_utilisateurs' => $nombreUtilisateurs,
                    'baseUrl' => Flight::get('flight.base_url'),
                ]);
            } else {
                Flight::render('frontoffice/accueil', [
                    'currentUser' => $user,
                    'liste' => $objet,
                    'users' => $users,
                    'baseUrl' => Flight::get('flight.base_url'),
                ]);
            }
        } else {
            Flight::render('frontoffice/accueil', [
                'currentUser' => $user,
                'liste' => $objet,
                'users' => $users,
                'baseUrl' => Flight::get('flight.base_url'),
            ]);
        }
    }

    public function autreProfil($id_user, $id_profil){
        $pdo = Flight::db();
        $usermodel = new UserModel($pdo);
        $user = $usermodel->getUserById($id_profil);
        $userme= $usermodel->getUserById($id_user);

        $objetmodel = new ObjetModel($pdo);
        $objets = $objetmodel->getAllObjetbyUser($id_profil); 

        Flight::render('frontoffice/autre-profil', [
            'currentUser' => $userme,
            'user' => $user,
            'objets' => $objets,
            'baseUrl' => Flight::get('flight.base_url'),
        ]);
    }

}