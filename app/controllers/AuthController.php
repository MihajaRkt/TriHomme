<?php
namespace app\controllers;

use app\models\UserModel;
use app\services\Validator;
use app\services\UserService;
use Throwable;
use Flight;

class AuthController {

  public static function showRegister() {
    Flight::render('auth/register', [
      'values' => ['nom'=>'','mail'=>''],
      'errors' => ['nom'=>'','mail'=>'','password'=>'','confirm_password'=>''],
      'success' => false
    ]);
  }

  public static function showLogin() {
    Flight::render('auth/login', [
      'values' => ['mail'=>''],
      'errors' => ['mail'=>'','password'=>''],
      'success' => false
    ]);
  }

  public static function validateRegisterAjax() {
    header('Content-Type: application/json; charset=utf-8');

    try {
      $pdo  = Flight::db();
      $repo = new UserModel($pdo);

      $req = Flight::request();

      $input = [
        'nom' => $req->data->nom,
        'mail' => $req->data->mail,
        'password' => $req->data->password,
        'confirm_password' => $req->data->confirm_password,
      ];

      $res = Validator::validateRegister($input, $repo);

      Flight::json([
        'ok' => $res['ok'],
        'errors' => $res['errors'],
        'values' => $res['values'],
      ]);
    } catch (Throwable $e) {
      http_response_code(500);
      Flight::json([
        'ok' => false,
        'errors' => ['_global' => 'Erreur serveur lors de la validation.'],
        'values' => []
      ]);
    }
  }

  public static function validateLoginAjax() {
    header('Content-Type: application/json; charset=utf-8');

    try {
      $req = Flight::request();

      $input = [
        'mail' => $req->data->mail,
        'password' => $req->data->password,
      ];

      $res = Validator::validateLogin($input);

      Flight::json([
        'ok' => $res['ok'],
        'errors' => $res['errors'],
        'values' => $res['values'],
      ]);
    } catch (Throwable $e) {
      http_response_code(500);
      Flight::json([
        'ok' => false,
        'errors' => ['_global' => 'Erreur serveur lors de la validation.'],
        'values' => []
      ]);
    }
  }

  public static function postRegister() {
    $pdo  = Flight::db();
    $repo = new UserModel($pdo);
    $svc  = new UserService($repo);

    $req = Flight::request();

    $input = [
      'nom' => $req->data->nom,
      'mail' => $req->data->mail,
      'password' => $req->data->password,
      'confirm_password' => $req->data->confirm_password,
    ];

    $res = Validator::validateRegister($input, $repo);

    if ($res['ok']) {
      $svc->register($res['values'], (string)$input['password']);
      Flight::render('auth/register', [
        'values' => ['nom'=>'','mail'=>''],
        'errors' => ['nom'=>'','mail'=>'','password'=>'','confirm_password'=>''],
        'success' => true
      ]);
      return;
    }

    Flight::render('auth/register', [
      'values' => $res['values'],
      'errors' => $res['errors'],
      'success' => false
    ]);
  }

  public static function postLogin() {
    $pdo  = Flight::db();
    $repo = new UserModel($pdo);
    $svc  = new UserService($repo);

    $req = Flight::request();

    $input = [
      'mail' => $req->data->mail,
      'password' => $req->data->password,
    ];

    $res = Validator::validateLogin($input);

    if ($res['ok']) {
      $user = $svc->login($res['values']['mail'], $input['password']);
      if ($user) {
        // Démarrer la session et stocker l'utilisateur
        session_start();
        $_SESSION['user'] = $user;
        Flight::redirect('/index'); // Rediriger vers la page d'accueil ou dashboard
        return;
      } else {
        $res['errors']['_global'] = 'Email ou mot de passe incorrect.';
        $res['ok'] = false;
      }
    }

    Flight::render('auth/login', [
      'values' => $res['values'],
      'errors' => $res['errors'],
      'success' => false
    ]);
  }
}
