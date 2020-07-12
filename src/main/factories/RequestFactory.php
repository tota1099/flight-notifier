<?php

namespace App\main\factories;

use App\infra\Requests\CurlRequestAdapter;
use App\presentation\interfaces\Requests;

class RequestFactory {
  public static function createRequest(): Requests
  {
    return new CurlRequestAdapter();
  }
}