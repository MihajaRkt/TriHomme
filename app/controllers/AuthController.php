<?php
namespace app\controllers;

use app\models\UserModel;
use app\services\UserService;
use app\services\Validator;

use Flight;
use Throwable;


class AuthController
{

  public static function showLogin()
  {
    $user = new UserModel(Flight::db());
    $admins = $user->getAdmin();
    $admin = !empty($admins) ? $admins[0] : null;

    Flight::render('index', [
      'values' => ['mail' => ''],
      'errors' => ['mail' => '', 'password' => '', '_global' => ''],
      'admin' => $admin,
      'baseUrl' => Flight::get('flight.base_url'),
    ]);
  }

  public static function postLogin()
  {
    try {
      $pdo = Flight::db();
      $req = Flight::request();
      $userModel = new UserModel($pdo);

      $email = $req->data->mail ?? '';
      $password = $req->data->password ?? '';

      $admins = $userModel->getAdmin();
      $admin = !empty($admins) ? $admins[0] : null;

      if (empty($email) || empty($password)) {
        Flight::render('index', [
          'values' => ['mail' => $email],
          'errors' => [
            'mail' => empty($email) ? 'Email requis.' : '',
            'password' => empty($password) ? 'Mot de passe requis.' : '',
            '_global' => ''
          ],
          'admin' => $admin,
          'baseUrl' => Flight::get('flight.base_url'),
        ]);
        return;
      }

      $user = $userModel->verifier_user($email, $password);

      if ($user) {
        $_SESSION['user'] = $user;
        $id_user = $user['id_User'];
        Flight::redirect('/accueil/' . $id_user);
      } else {
        Flight::render('index', [
          'values' => ['mail' => $email],
          'errors' => [
            'mail' => '',
            'password' => '',
            '_global' => 'Email ou mot de passe incorrect.'
          ],
          'admin' => $admin,
          'baseUrl' => Flight::get('flight.base_url'),
        ]);
      }
    } catch (Throwable $e) {
      Flight::render('index', [
        'values' => ['mail' => $email ?? ''],
        'errors' => [
          'mail' => '',
          'password' => '',
          '_global' => 'Erreur serveur lors de la connexion.'
        ],
        'admin' => null,
        'baseUrl' => Flight::get('flight.base_url'),
      ]);
    }
  }

  public static function showRegister()
  {
    Flight::render('register', [
      'values' => ['nom' => '', 'email' => ''],
      'errors' => ['nom' => '', 'email' => '', 'password' => '', 'confirm_password' => ''],
      'success' => false,
      'baseUrl' => Flight::get('flight.base_url'),
    ]);
  }

  public static function validateRegisterAjax()
  {
    header('Content-Type: application/json; charset=utf-8');

    try {
      $pdo  = Flight::db();

      $req = Flight::request();

      $input = [
        'nom' => $req->data->nom,
        'email' => $req->data->email,
        'password' => $req->data->password,
        'confirm_password' => $req->data->confirm_password,
      ];

      $res = Validator::validateRegister($input);

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

  public static function validateLoginAjax()
  {
    header('Content-Type: application/json; charset=utf-8');

    try {
      $pdo = Flight::db();
      $req = Flight::request();

      $input = [
        'mail' => $req->data->mail ?? '',
        'password' => $req->data->password ?? '',
      ];

      $errors = [];
      $values = $input;

      if (empty($input['mail'])) {
        $errors['mail'] = 'Email requis.';
      }
      if (empty($input['password'])) {
        $errors['password'] = 'Mot de passe requis.';
      }

      if (!empty($errors)) {
        Flight::json([
          'ok' => false,
          'errors' => $errors,
          'values' => $values,
        ]);
        return;
      }

      $userModel = new UserModel($pdo);
      $user = $userModel->verifier_user($input['mail'], $input['password']);

      if (!$user) {
        Flight::json([
          'ok' => false,
          'errors' => ['_global' => 'Email ou mot de passe incorrect.'],
          'values' => $values,
        ]);
      } else {
        Flight::json([
          'ok' => true,
          'errors' => [],
          'values' => $values,
        ]);
      }
    } catch (Throwable $e) {
      http_response_code(500);
      Flight::json([
        'ok' => false,
        'errors' => ['_global' => 'Erreur serveur lors de la validation.'],
        'values' => []
      ]);
    }
  }

  public static function postRegister()
  {
    $pdo  = Flight::db();

    $req = Flight::request();

    $input = [
      'nom' => $req->data->nom,
      'email' => $req->data->email,
      'password' => $req->data->password,
      'confirm_password' => $req->data->confirm_password,
    ];

    $res = Validator::validateRegister($input);

    if ($res['ok']) {
      $svc = new UserService(new UserModel($pdo));
      $user = $svc->register($res['values'], (string)$input['password']);
      $_SESSION['user'] = $user;
      $id_user = $user['id_User'] ?? null;
      if ($id_user) {
        Flight::redirect('/accueil/' . $id_user);
      } else {
        Flight::redirect('/accueil');
      }
      return;
    }

    Flight::render('register', [
      'values' => $res['values'],
      'errors' => $res['errors'],
      'success' => false,
      'baseUrl' => Flight::get('flight.base_url'),
    ]);
  }

  public static function logout()
  {
    // session_destroy();
    Flight::redirect('/');
  }
}
