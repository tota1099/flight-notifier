<?php

namespace App\main\factories;

use App\domain\usecases\AddNotifierLog;
use App\data\usecases\DbAddNotifierLog;
use App\infra\database\sqlite\repositories\NotifierLogRepository;

class AddNotifierLogFactory {
  public static function createAddNotifierLog(): AddNotifierLog
  {
    return new DbAddNotifierLog(new NotifierLogRepository());
  }
}