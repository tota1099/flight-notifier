<?php

namespace App\utils\Notifiers;

use App\presentation\interfaces\Notifier;
use App\presentation\interfaces\Requests;

class MailNotifierAdapter implements Notifier {

    public function notify(String $message): bool {
      mail("renan.porto1099@gmail.com","My subject", $message);
      return true;
    }
}