<?php

namespace app\controllers;

use app\models\EchangeModel;
use app\models\UserModel;
use Flight;

class EchangeController
{
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