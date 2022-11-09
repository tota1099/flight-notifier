<?php

namespace App\infra\database\sqlite\repositories;

use App\domain\models\NotifierLog;
use App\data\interfaces\AddNotifierLogRepository;
use App\data\interfaces\GetNotifierLogRepository;
use App\infra\database\sqlite\helpers\SqliteHelper;

class NotifierLogRepository extends SqliteHelper implements AddNotifierLogRepository, GetNotifierLogRepository {
  public function add(NotifierLog $log) :bool {
    $sql = 'INSERT INTO flight_notifier_log(flight_number, date) VALUES(:flight_number, :date)';
    $stmt = ($this->connect())->prepare($sql);
    $stmt->bindValue(':flight_number', $log->flight_number);
    $stmt->bindValue(':date', $log->date);
    $stmt->execute();

    return ($this->connect())->lastInsertId();

  }

  public function getByDateAndFlightNumber(String $date, String $flight_number) :bool {
    $sql = 'SELECT id FROM flight_notifier_log WHERE flight_number = :flight_number AND date = :date';
    $stmt = ($this->connect())->prepare($sql);
    $stmt->bindValue(':flight_number', $flight_number);
    $stmt->bindValue(':date', $date);
    $stmt->execute();

    return $stmt->fetchColumn() > 0;
  }
}