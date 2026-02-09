<?php

namespace app\controllers;

use app\models\LoginModel;
use Flight;

class LoginController
{
    public function login()
    {
        $email = Flight::request()->data->email;
        $mdp = Flight::request()->data->mdp;

        $loginModel = new LoginModel(Flight::db());
        $user = $loginModel->verifier_user($email, $mdp);

        if ($user) {
            Flight::json(['success' => true, 'user' => $user]);
        } else {
            Flight::json(['success' => false, 'message' => 'Invalid email or password']);
        }
    }

    public function register()
    {
        $username = Flight::request()->data->username;
        $email = Flight::request()->data->email;
        $mdp = Flight::request()->data->mdp;

        $loginModel = new LoginModel(Flight::db());
        $userId = $loginModel->insert_user($username, $email, $mdp);

        Flight::render('accueil', [
            'userId' => $userId,
            'username' => $username,
            'email' => $email,
            'mdp' => $mdp,
            'baseUrl' => Flight::get('flight.base_url')
        ]);
    }
}
