<?php

namespace app\services;

use app\models\UserModel;

class UserService {
  private $repo;
  public function __construct(UserModel $repo) { $this->repo = $repo; }

  public function register(array $values, $plainPassword) {
    $hash = password_hash((string)$plainPassword, PASSWORD_DEFAULT);
    return $this->repo->create(
      $values['nom'], $values['prenom'], $values['email'], $hash, $values['telephone']
    );
  }

  public function login($email, $plainPassword) {
    $user = $this->repo->findByEmail($email);
    if (!$user || !password_verify($plainPassword, $user['password_hash'])) {
      return null;
    }
    return $user;
  }
}
