<?php

namespace app\controllers;

use Flight;

class CategorieController
{

    public function insertCategorie() {
        //mamorona variable data de iny no atsofoka any anaty modele
    }
    
    public function redirectInsert()
    {
        Flight::render('create-categorie', [
            'baseUrl' => Flight::get('flight.base_url'),
        ]);
    }
}
