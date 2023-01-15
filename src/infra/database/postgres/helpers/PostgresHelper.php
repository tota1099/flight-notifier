<?php

namespace App\infra\database\postgres\helpers;

class PostgresHelper {
  private ?\PDO $database;

  private function connect() {
    $this->database = new \PDO($_ENV['DATABASE_URI'], $_ENV['DATABASE_USER'], $_ENV['DATABASE_PASSWORD']);
  }

  private function disconnect() {
    $this->database = null;
  }

  public function fetch($sql, $params = []) : Array|bool {
    $this->connect();
    $stmt= $this->getDataBase()->prepare($sql);
    $stmt->execute($params);
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    $this->disconnect();
    return $result;
  }

  public function insert($sql, $params = []) {
    $this->connect();
    $stmt= $this->getDataBase()->prepare($sql);
    $stmt->execute($params);
    $lastId = $this->getDataBase()->lastInsertId();
    $this->disconnect();
    return $lastId;
  }

  public function getDataBase() {
    return $this->database;
  }
}