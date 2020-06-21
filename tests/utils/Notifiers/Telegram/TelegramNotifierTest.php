<?php

namespace Tests\utils\Notifiers\Telegram;

require_once dirname(__DIR__) . '/../../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\utils\Notifiers\Telegram\TelegramNotifierException;
use App\utils\Notifiers\Telegram\TelegramNotifier;

class TelegramNotifierTest extends TestCase {

  public function testItWithEmptyMessage() {
    $this->expectException(TelegramNotifierException::class);
    $this->expectExceptionMessage('Message param is required!');
    TelegramNotifier::buildNotifyUrl();
  }
}