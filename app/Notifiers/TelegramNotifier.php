<?php

namespace App\Notifiers;

use App\Validations\Notifiers\TelegramNotifierValidation;
use Constants\Telegram;

class TelegramNotifier implements NotifierInterface {

    private String $botToken;
    private String $chatId;

    public function __construct($botToken = '', $chatId = '')
    {
        TelegramNotifierValidation::tokenIsValid($botToken);
        TelegramNotifierValidation::chatIdIsValid($chatId);

        $this->botToken = $botToken;
        $this->chatId = $chatId;
    }

    public function getChatId() {
        return $this->chatId;
    }

    public function getBotToken() {
        return $this->botToken;
    }

    public function notify($message = ''): bool
    {
        TelegramNotifierValidation::messageIsValid($message);
        $notifyUrl = Telegram::buildNotifyUrl($this->botToken, $this->chatId, $message);
    }
}

