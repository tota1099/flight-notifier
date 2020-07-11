<?php

namespace App\main\factories;

use App\utils\Requests\CurlRequest;
use App\utils\Requests\RequestsInterface;

class RequestFactory {
  public static function createRequest(): RequestsInterface
  {
    return new CurlRequest();
  }
}