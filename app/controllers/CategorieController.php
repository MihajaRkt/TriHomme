<?php

namespace app\controllers;

use app\models\CategorieModel;
use app\models\UserModel;
use Flight;

class CategorieController
{
    public function insertCategoriee()
    {
        //mamorona variable data de iny no atsofoka any anaty modele
        $data = ['nom_categorie' => Flight::request()->data->nom_categorie];
        $categorie = new CategorieModel(Flight::db());
        $categorie->saveCategorie($data);
        $categories = $categorie->getNumberCategories();

        Flight::render('backoffice-categorie', [
            'liste_categorie' => $categories,
            'baseUrl' => Flight::get('flight.base_url'),
        ]);
    }

    public function redirectInsert()
    {
        Flight::render('create-categorie', [
            'baseUrl' => Flight::get('flight.base_url'),
        ]);
    }
    
    public function showEditCategorie($id_categorie)
    {
        $categorie = new CategorieModel(Flight::db());
        $categorieData = $categorie->getCategorieById($id_categorie);
        
        if (!$categorieData) {
            Flight::render('edit-categorie', [
                'error' => 'Catégorie introuvable',
                'categorie' => [],
                'baseUrl' => Flight::get('flight.base_url'),
            ]);
            return;
        }
        
        Flight::render('edit-categorie', [
            'categorie' => $categorieData,
            'baseUrl' => Flight::get('flight.base_url'),
        ]);
    }
    
    public function updateCategorie() {
        $data = [
            'id_categorie' => Flight::request()->data->id_categorie,
            'nouveau_nom' => Flight::request()->data->nouveau_nom
        ];
        $categorie = new CategorieModel(Flight::db());
        $categorie->updateCategorie($data);
        $this->BOredirect($categorie->getNumberCategories());
    }

    public function removeCategorie($id_categorie)
    {
        $categorie = new CategorieModel(Flight::db());
        $categorie->deleteCategorie($id_categorie);
        $this->BOredirect($categorie->getNumberCategories());
    }

    public function BOredirect($categories)
    {
        $pdo = Flight::db();

        $user = new UserModel($pdo);
        $users = $user->getAllUsers();
        $nombreUtilisateurs = count($users);
        $admin = $user->getAdmin()[0];

        Flight::render('backoffice-categorie', [
            'currentUser' => $admin,
            'liste_categorie' => $categories,
            'nombre_utilisateurs' => $nombreUtilisateurs,
            'baseUrl' => Flight::get('flight.base_url'),
        ]);
    }
}
