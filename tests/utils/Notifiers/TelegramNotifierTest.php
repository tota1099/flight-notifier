<?php

namespace Tests\utils\Notifiers;

use PHPUnit\Framework\TestCase;
use App\utils\Notifiers\TelegramNotifierAdapterException;
use App\utils\Notifiers\TelegramNotifierAdapter;

class TelegramNotifierTest extends TestCase {

  public function testItWithEmptyMessage() {
    $this->expectException(TelegramNotifierAdapterException::class);
    $this->expectExceptionMessage('Message param is required!');
    TelegramNotifierAdapter::buildNotifyUrl();
  }
}