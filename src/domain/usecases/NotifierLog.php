<?php

namespace App\domain\usecases;

class NotifierLog {
  public function __construct(
    public int $id,
    public int $flightNumber,
    public String $date
  )
  {}
}