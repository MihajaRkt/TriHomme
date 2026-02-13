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
        $this->BOredirect();
    }

    public function redirectInsert()
    {
        Flight::render('backoffice/create-categorie', [
            'baseUrl' => Flight::get('flight.base_url'),
        ]);
    }

    public function showEditCategorie($id_categorie)
    {
        $categorie = new CategorieModel(Flight::db());
        $categorieData = $categorie->getCategorieById($id_categorie);

        if (!$categorieData) {
            Flight::render('backoffice/edit-categorie', [
                'error' => 'Catégorie introuvable',
                'categorie' => [],
                'baseUrl' => Flight::get('flight.base_url'),
            ]);
            return;
        }

        Flight::render('backoffice/edit-categorie', [
            'categorie' => $categorieData,
            'baseUrl' => Flight::get('flight.base_url'),
        ]);
    }

    public function updateCategorie()
    {
        $data = [
            'id_categorie' => Flight::request()->data->id_categorie,
            'nouveau_nom' => Flight::request()->data->nouveau_nom
        ];
        $categorie = new CategorieModel(Flight::db());
        $categorie->updateCategorie($data);
        $this->BOredirect();
    }

    public function removeCategorie($id_categorie)
    {
        $categorie = new CategorieModel(Flight::db());
        $categorie->deleteCategorie($id_categorie);
        $this->BOredirect();
    }

    public function BOredirect()
    {
        $admin = new UserModel(Flight::db());
        $id = $admin->getAdmin()[0];
        Flight::redirect('/accueil/' . $id['id_User']);
    }
}
