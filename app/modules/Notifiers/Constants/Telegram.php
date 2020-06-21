<?php

namespace App\modules\Notifiers\Constants;

class Telegram {
    const API_BASE_URL = 'https://api.telegram.org';

    private static function getBotUrl($botToken = '') {
        return self::API_BASE_URL . '/bot' . $botToken;
    }

    static function buildNotifyUrl($botToken, $chatId, $message){
        $botUrl = self::getBotUrl($botToken);
        return $botUrl . '/sendMessage?chat_id=' . $chatId . '&text=' . $message;
    }
}