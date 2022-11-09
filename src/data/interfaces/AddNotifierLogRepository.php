<?php

namespace App\data\interfaces;

use App\domain\models\NotifierLog;

interface AddNotifierLogRepository {
  public function add(NotifierLog $log) :bool;
}