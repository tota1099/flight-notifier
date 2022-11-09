<?php

namespace App\utils\Notifiers;

use App\presentation\interfaces\Notifier;
use App\presentation\interfaces\Requests;

class MailNotifierAdapter implements Notifier {

    public function notify(String $message): bool {
      if(empty($message)) {
        throw new NotifierAdapterException('Message param is required!', 400);
      }

      mail("renan.porto1099@gmail.com","My subject", $message);
      return true;
    }
}