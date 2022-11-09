<?php

namespace App\infra\database\sqlite\helpers;

class SqliteHelper {

  private $pdo;

  public function connect() :\PDO {
    if ($this->pdo == null) {
      $this->pdo = new \PDO("sqlite:" . './phpnotifier.db');
    }
    return $this->pdo;
  }
}