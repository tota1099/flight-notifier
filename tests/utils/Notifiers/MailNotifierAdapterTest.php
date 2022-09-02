<?php

namespace Tests\utils\Notifiers;

use App\presentation\interfaces\Requests;
use PHPUnit\Framework\TestCase;
use App\utils\Notifiers\NotifierAdapterException;
use App\utils\Notifiers\MailNotifierAdapter;

class MailNotifierAdapterTest extends TestCase {

  public function testItWithEmptyMessage() {
    $this->expectException(NotifierAdapterException::class);
    $this->expectExceptionMessage('Message param is required!');

    $notifier = new MailNotifierAdapter();    
    $notifier->notify('');
  }

  public function testItWithCorrectMessage() {
    $notifier = new MailNotifierAdapter();
    $this->assertEquals(true, $notifier->notify('Hello World'));
  }
}