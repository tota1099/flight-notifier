<?php

namespace App\infra\database\sqlite\repositories;

use App\domain\models\NotifierLog;
use App\data\interfaces\AddNotifierLogRepository;
use App\infra\database\sqlite\helpers\SqliteHelper;

class NotifierLogRepository extends SqliteHelper implements AddNotifierLogRepository {
  public function add(NotifierLog $log):bool {
    $sql = 'INSERT INTO flight_notifier_log(flight_number, date) VALUES(:flight_number, :date)';
    $stmt = ($this->connect())->prepare($sql);
    $stmt->bindValue(':flight_number', $log->flightNumber);
    $stmt->bindValue(':date', $log->date);
    $stmt->execute();

    return $this->pdo->lastInsertId();

  }
}