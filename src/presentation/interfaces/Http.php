<?php

namespace App\presentation\interfaces;

interface HttpRequest {
  public function getBody(): String;
}

interface HttpResponse {
  public function getBody(): ?string;
  public function getCode(): Int;
}