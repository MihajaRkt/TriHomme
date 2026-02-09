<?php
namespace app\services;

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

  public static function validateRegister(array $input, UserRepository $repo = null)
  {
    $errors = [
      'nom' => '',
      'prenom' => '',
      'email' => '',
      'password' => '',
      'confirm_password' => '',
      'telephone' => ''
    ];

    $values = [
      'nom' => trim((string)($input['nom'] ?? '')),
      'prenom' => trim((string)($input['prenom'] ?? '')),
      'email' => trim((string)($input['email'] ?? '')),
      'telephone' => self::normalizeTelephone($input['telephone'] ?? ''),
    ];

    $password = (string)($input['password'] ?? '');
    $confirm  = (string)($input['confirm_password'] ?? '');

    if (mb_strlen($values['nom']) < 2) $errors['nom'] = "Le nom doit contenir au moins 2 caractères.";
    if (mb_strlen($values['prenom']) < 2) $errors['prenom'] = "Le prénom doit contenir au moins 2 caractères.";

    if ($values['email'] === '') $errors['email'] = "L'email est obligatoire.";
    elseif (!filter_var($values['email'], FILTER_VALIDATE_EMAIL))
      $errors['email'] = "L'email n'est pas valide (ex: nom@domaine.com).";

    if (strlen($password) < 8) $errors['password'] = "Le mot de passe doit contenir au moins 8 caractères.";

    if (strlen($confirm) < 8) $errors['confirm_password'] = "Veuillez confirmer le mot de passe (min 8 caractères).";
    elseif ($password !== $confirm) {
      $errors['confirm_password'] = "Les mots de passe ne correspondent pas.";
      if ($errors['password'] === '') $errors['password'] = "Vérifiez le mot de passe et sa confirmation.";
    }

    $tel = $values['telephone'];
    if (strlen($tel) < 8 || strlen($tel) > 15) $errors['telephone'] = "Le téléphone doit contenir entre 8 et 15 chiffres.";
    elseif (!preg_match('/^[0-9]+$/', $tel)) $errors['telephone'] = "Le téléphone ne doit contenir que des chiffres.";
    // elseif (!num_malagasy_check($tel)) $errors['telephone'] = "Le téléphone est incompatible en malagasy";

    if ($repo && $errors['email'] === '' && $repo->emailExists($values['email'])) {
      $errors['email'] = "Cet email est déjà utilisé.";
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
}
