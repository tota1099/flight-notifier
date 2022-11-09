<?php

namespace App\data\usecases;

use App\domain\usecases\AddNotifierLog;
use App\data\interfaces\AddNotifierLogRepository;
use App\domain\models\NotifierLog;

class DbAddNotifierLog implements AddNotifierLog {

  public function __construct(
    public AddNotifierLogRepository $repository
  ) {}

  public function add(NotifierLog $notifierLog) :bool {
    return $this->repository->add($notifierLog);
  }
}