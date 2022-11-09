<?php

namespace App\infra\database\sqlite\helpers;

class SqliteHelper {

  private $pdo;

  public function connect():bool {
    if ($this->pdo == null) {
      $this->pdo = new \PDO("sqlite:" . 'db/phpsqlite.db');
    }
    return $this->pdo;
  }
}