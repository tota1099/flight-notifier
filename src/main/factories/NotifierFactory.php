<?php

namespace App\main\factories;

use App\presentation\interfaces\Notifier;
use App\utils\Notifiers\TelegramNotifierAdapter;

class NotifierFactory {
  public static function createNotifier(): Notifier
  {
    $request = RequestFactory::createRequest();
    $telegramChatId = $_ENV['TELEGRAM_CHAT_ID'];
    $telegramTokenId = $_ENV['TELEGRAM_TOKEN_ID'];
    return new TelegramNotifierAdapter($request, $telegramChatId, $telegramTokenId);
  }
}