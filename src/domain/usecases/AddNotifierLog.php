<?php

namespace App\domain\usecases;

use App\domain\models\NotifierLog;

interface AddNotifierLog {
  public function add(NotifierLog $notifierLog) :bool {}
}