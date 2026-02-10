<?php

namespace app\controllers;

use app\models\CategorieModel;
use Flight;

class CategorieController
{
    public function insertCategoriee() {
        //mamorona variable data de iny no atsofoka any anaty modele

        $data = [];
        $categorie = new CategorieModel(Flight::db());
        $categorie->saveCategorie($data);
        Flight::redirect('');
    }
    
    public function redirectInsert()
    {
        Flight::render('create-categorie', [
            'baseUrl' => Flight::get('flight.base_url'),
        ]);
    }
}
