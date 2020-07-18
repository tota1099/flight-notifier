<?php

namespace App\presentation\interfaces;

interface Notifier {
  public function notify(String $message): bool;
}
