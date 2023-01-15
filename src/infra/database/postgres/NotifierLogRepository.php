<?php

namespace App\infra\database\postgres;

use App\domain\usecases\AddNotifierLog;
use App\domain\usecases\NotifierLog;
use App\infra\database\postgres\helpers\PostgresHelper;
use App\data\interfaces\NotifierLogRepositoryInterface;

class NotifierLogRepository implements NotifierLogRepositoryInterface {
  public function add(AddNotifierLog $addNotifierLog) : NotifierLog {
    $postgresHelper = new PostgresHelper();
    $sql = "INSERT INTO notifier_log (flight_number, date) VALUES (?,?)";
    $logId = $postgresHelper->insert($sql, [
      $addNotifierLog->flight->flightNumber,
      $addNotifierLog->date
    ]);

    return new NotifierLog($logId, $addNotifierLog->flight->flightNumber, $addNotifierLog->date);
  }

  public function getById(int $id) : NotifierLog {
    $postgresHelper = new PostgresHelper();
    $sql = "SELECT flight_number, date FROM notifier_log WHERE id = ?";

    $log = $postgresHelper->fetch($sql, [
      $id
    ]);

    return new NotifierLog($id, $log["flight_number"], $log["date"]);
  }
}