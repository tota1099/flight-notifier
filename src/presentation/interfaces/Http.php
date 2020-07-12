<?php

namespace App\presentation\interfaces;

interface HttpRequest {
  public function getBody(): String;
}

interface HttpResponse {
  public function getBody(): String;
  public function getCode(): Int;
}