<?php

namespace Tests\utils\Notifiers;

use App\presentation\interfaces\Requests;
use PHPUnit\Framework\TestCase;
use App\utils\Notifiers\NotifierAdapterException;
use App\utils\Notifiers\TelegramNotifierAdapter;

class TelegramNotifierAdapterTest extends TestCase {

  public function testItWithEmptyMessage() {
    $this->expectException(NotifierAdapterException::class);
    $this->expectExceptionMessage('Message param is required!');

    $chatId = 123;
    $botToken = '321';
    $requestMock = $this->createMock(Requests::class);
    $notifier = new TelegramNotifierAdapter($requestMock, $chatId, $botToken);
    
    $notifier->notify('');
  }

  public function testItWithCorrectMessage() {
    $chatId = 123;
    $botToken = '321';
    $requestMock = $this->createMock(Requests::class);
    $requestMock
      ->expects($this->once())
      ->method('get')
      ->with('https://api.telegram.org/bot321/sendMessage?chat_id=123&text=Hello+World')
      ->willReturn('any');

    $notifier = new TelegramNotifierAdapter($requestMock, $chatId, $botToken);
    $this->assertEquals(true, $notifier->notify('Hello World'));
  }
}