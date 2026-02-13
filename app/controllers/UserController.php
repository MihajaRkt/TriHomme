<?php

namespace app\controllers;

use app\models\UserModel;
use Flight;

class UserController
{

    public function getAdmin()
    {
        $UserModel = new UserModel(Flight::db());
        $admins = $UserModel->getAdmin();

        Flight::render('login', [
            'admins' => $admins,
            'baseUrl' => Flight::get('flight.base_url')
        ]);
    }

    public function listUsers($iduser)
    {
        $UserModel = new UserModel(Flight::db());
        $users = $UserModel->getUsersExceptCurrent($iduser);

        $user = $UserModel->getUserById($iduser);
        Flight::render('frontoffice/utilisateurs', [
            'users' => $users,
            'currentUser' => $user,
            'baseUrl' => Flight::get('flight.base_url')
        ]);
    }

    public function login()
    {
        $email = Flight::request()->data->email;
        $mdp = Flight::request()->data->mdp;

        $UserModel = new UserModel(Flight::db());
        $user = $UserModel->verifier_user($email, $mdp);

        Flight::render('accueil', [
            'user' => $user,
            'baseUrl' => Flight::get('flight.base_url')
        ]);
    }

    public function register()
    {
        $username = Flight::request()->data->username;
        $email = Flight::request()->data->email;
        $mdp = Flight::request()->data->mdp;

        $UserModel = new UserModel(Flight::db());
        $userId = $UserModel->insert_user($username, $email, $mdp);

        Flight::render('accueil', [
            'userId' => $userId,
            'username' => $username,
            'email' => $email,
            'mdp' => $mdp,
            'baseUrl' => Flight::get('flight.base_url')
        ]);
    }
}
