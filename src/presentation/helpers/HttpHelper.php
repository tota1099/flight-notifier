<?php

namespace App\presentation\helpers;

use App\presentation\interfaces\HttpResponse;

class BadRequest implements HttpResponse {
  private String $body;

  public function __construct(String $body) {
    $this->body = $body;
  }

  public function getBody(): ?string
  {
      return $this->body;
  }

  public function getCode(): int {
    return 400;
  }
}

class Ok implements HttpResponse {

  public function getBody(): ?string
  {
      return null;
  }

  public function getCode(): int {
    return 200;
  }
}

function badRequest(\Exception $exception): HttpResponse {
  return new BadRequest($exception->getMessage());
}

function ok(): HttpResponse {
  return new Ok();
}