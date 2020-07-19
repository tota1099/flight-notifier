<?php

namespace App\config;

use Dotenv\Dotenv;

class Config {
  static function init() {
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();
  }
}
