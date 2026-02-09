<?php
namespace app\services;

use app\models\UserModel;

class Validator
{

  public static function normalizeTelephone($tel)
  {
    return preg_replace('/\s+/', '', trim((string)$tel));
  }

  function num_malagasy_check($numero)
  {
    $expReguliere = "^(+\261|0) ([]?3) ([2-4]|7|8){1} ([]?[0-9]){2} ([]?[0-9]){3} ([]?[0-9]){2}$";
    return  preg_match($expReguliere, $numero);
  }

  public static function validateRegister(array $input, UserModel $repo = null)
  {
    $errors = [
      'nom' => '',
      'mail' => '',
      'password' => '',
      'confirm_password' => '',
    ];

    $values = [
      'nom' => trim((string)($input['nom'] ?? '')),
      'mail' => trim((string)($input['mail'] ?? '')),
    ];

    $password = (string)($input['password'] ?? '');
    $confirm  = (string)($input['confirm_password'] ?? '');

    if (mb_strlen($values['nom']) < 2) $errors['nom'] = "Le nom doit contenir au moins 2 caractères.";

    if ($values['mail'] === '') $errors['mail'] = "L'email est obligatoire.";
    elseif (!filter_var($values['mail'], FILTER_VALIDATE_EMAIL))
      $errors['mail'] = "L'email n'est pas valide (ex: nom@domaine.com).";

    if (strlen($password) < 8) $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères.";

    if (strlen($confirm) < 8) $errors['confirm_password'] = "Veuillez confirmer le mot de passe (min 8 caractères).";
    elseif ($password !== $confirm) {
      $errors['confirm_password'] = "Les mots de passe ne correspondent pas.";
      if ($errors['password'] === '') $errors['password'] = "Vérifiez le mot de passe et sa confirmation.";
    }

    if ($repo && $errors['mail'] === '' && $repo->mailExists($values['mail'])) {
      $errors['mail'] = "Cet email est déjà utilisé.";
    }

    $ok = true;
    foreach ($errors as $m) {
      if ($m !== '') {
        $ok = false;
        break;
      }
    }

    return ['ok' => $ok, 'errors' => $errors, 'values' => $values];
  }

  public static function validateLogin(array $input)
  {
    $errors = [
      'mail' => '',
      'password' => ''
    ];

    $values = [
      'mail' => trim((string)($input['mail'] ?? '')),
      'password' => (string)($input['password'] ?? ''),
    ];

    if ($values['mail'] === '') $errors['mail'] = "L'email est obligatoire.";
    elseif (!filter_var($values['mail'], FILTER_VALIDATE_EMAIL))
      $errors['mail'] = "L'email n'est pas valide.";

    if (strlen($values['password']) < 1) $errors['password'] = "Le mot de passe est obligatoire.";

    $ok = true;
    foreach ($errors as $m) {
      if ($m !== '') {
        $ok = false;
        break;
      }
    }

    return ['ok' => $ok, 'errors' => $errors, 'values' => $values];
  }
}
