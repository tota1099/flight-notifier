<?php

namespace App\presentation\interfaces;

use App\presentation\interfaces\HttpRequest;
use App\presentation\interfaces\HttpResponse;

interface Controller {
  public function handle(HttpRequest $request): HttpResponse;
}