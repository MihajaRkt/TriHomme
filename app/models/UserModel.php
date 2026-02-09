<?php

namespace app\models;

use Flight;
use PDO;

class UserModel
{
  private $pdo;
  public function __construct(PDO $pdo)
  {
    $this->pdo = $pdo;
  }

  public function mailExists($mail)
  {
    $st = $this->pdo->prepare("SELECT 1 FROM User WHERE mail_User=? LIMIT 1");
    $st->execute([(string)$mail]);
    return (bool)$st->fetchColumn();
  }

  public function create($nom, $mail, $hash)
  {
    $st = $this->pdo->prepare("
      INSERT INTO User(nom_User, mail_User, pwd_User)
      VALUES(?,?,?)
    ");
    $st->execute([(string)$nom, (string)$mail, (string)$hash]);
    return $this->pdo->lastInsertId();
  }

  public function findByMail($mail)
  {
    $st = $this->pdo->prepare("SELECT id_User, nom_User, mail_User, pwd_User FROM User WHERE mail_User=? LIMIT 1");
    $st->execute([(string)$mail]);
    return $st->fetch(PDO::FETCH_ASSOC);
  }
}
