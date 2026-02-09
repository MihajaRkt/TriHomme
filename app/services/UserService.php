<?php

namespace app\services;

use app\models\UserModel;

class UserService {
  private $repo;
  public function __construct(UserModel $repo) { $this->repo = $repo; }

  public function register(array $values, $plainPassword) {
    $hash = password_hash((string)$plainPassword, PASSWORD_DEFAULT);
    return $this->repo->create(
      $values['nom'], $values['mail'], $hash
    );
  }

  public function login($mail, $plainPassword) {
    $user = $this->repo->findByMail($mail);
    if (!$user || !password_verify($plainPassword, $user['pwd_User'])) {
      return null;
    }
    return $user;
  }
}
