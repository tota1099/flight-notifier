<?php

namespace App\config;

use Dotenv\Dotenv;

class Config {
  static function init() {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();
  }
}

date_default_timezone_set('America/Sao_Paulo');
