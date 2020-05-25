<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Exceptions\Notifiers\TelegramNotifierException;
use PHPUnit\Framework\TestCase;
use App\Notifiers\TelegramNotifier;

class TelegramNotifierTest extends TestCase {

    function testItSetBotToken() {
        $botToken = 'exampleBotToken';
        $notifier = new TelegramNotifier($botToken, '123');

        $this->assertEquals($botToken, $notifier->getBotToken());
    }

    function testItSetChatId() {
        $chatId = 'exampleChatId';
        $notifier = new TelegramNotifier('123', $chatId);

        $this->assertEquals($chatId, $notifier->getChatId());
    }

    function testItWithInvalidToken() {
        $this->expectException(TelegramNotifierException::class);
        $this->expectExceptionMessage('Token invalid!');
        $notifier = new TelegramNotifier();
    }

    function testItWithInvalidChatId() {
        $this->expectException(TelegramNotifierException::class);
        $this->expectExceptionMessage('Chat ID invalid!');
        $notifier = new TelegramNotifier('123');
    }

    function testNotifyWithInvalidMessageType() {
        $notifier = new TelegramNotifier('1', '2');
        $this->expectException(TelegramNotifierException::class);
        $this->expectExceptionMessage('Message should be a String!');

        $notifier->notify(0);
    }

    function testNotifyWithEmptyMessage() {
        $notifier = new TelegramNotifier('1', '2');
        $this->expectException(TelegramNotifierException::class);
        $this->expectExceptionMessage('Message should\'t be empty!');

        $notifier->notify('');
    }
}