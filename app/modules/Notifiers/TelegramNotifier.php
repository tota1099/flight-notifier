<?php

namespace App\modules\Notifiers;

use App\modules\Notifiers\Validations\TelegramNotifierValidation;
use App\modules\Notifiers\Constants\Telegram;
use App\modules\Requests\RequestsInterface;

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

    public function notify(RequestsInterface $requestService, $message = ''): bool
    {
        TelegramNotifierValidation::messageIsValid($message);
        $notifyUrl = Telegram::buildNotifyUrl($this->botToken, $this->chatId, $message);
        $requestService->get($notifyUrl);
        return true;
    }
}

