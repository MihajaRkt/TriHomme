<?php
namespace app\services;

use app\models\UserModel;

class UserService {
  private $repo;
  public function __construct(UserModel $repo) { $this->repo = $repo; }

  public function register(array $values, $plainPassword) {
    $hash = password_hash((string)$plainPassword, PASSWORD_DEFAULT);
    $id = $this->repo->insert_user(
      $values['nom'], $values['email'], $hash
    );
    return $this->repo->getUserById($id);
  }
}
