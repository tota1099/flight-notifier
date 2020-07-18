<?php

namespace Tests\utils\Notifiers;

use App\presentation\interfaces\Requests;
use PHPUnit\Framework\TestCase;
use App\utils\Notifiers\TelegramNotifierAdapterException;
use App\utils\Notifiers\TelegramNotifierAdapter;

class TelegramNotifierAdapterTest extends TestCase {

  public function testItWithEmptyMessage() {
    $this->expectException(TelegramNotifierAdapterException::class);
    $this->expectExceptionMessage('Message param is required!');

    $chatId = 123;
    $botToken = '321';
    $requestMock = $this->prophesize(Requests::class);
    $notifier = new TelegramNotifierAdapter($requestMock->reveal(), $chatId, $botToken);
    
    $notifier->notify('');
  }

  public function testItWithCorrectMessage() {
    $chatId = 123;
    $botToken = '321';
    $requestMock = $this->prophesize(Requests::class);
    $requestMock->get('https://api.telegram.org/bot321/sendMessage?chat_id=123&text=Hello+World')->willReturn(true);

    $notifier = new TelegramNotifierAdapter($requestMock->reveal(), $chatId, $botToken);
    $this->assertEquals(true, $notifier->notify('Hello World'));
  }
}