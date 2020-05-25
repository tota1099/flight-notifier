<?php

namespace App\Validations\Notifiers;

use App\Exceptions\Notifiers\TelegramNotifierException;

class TelegramNotifierValidation {

    public static function tokenIsValid($token) : void {
        if(!is_string($token) || empty($token)) {
            throw new TelegramNotifierException('Token invalid!');
        }
    }

    public static function chatIdIsValid($chatId) : void {
        if(!is_string($chatId) || empty($chatId)) {
            throw new TelegramNotifierException('Chat ID invalid!');
        }
    }

    public static function messageIsValid($message = '') : void {
        if(!is_string($message)) {
            throw new TelegramNotifierException('Message should be a String!');
        }
        if(empty($message)) {
            throw new TelegramNotifierException('Message should\'t be empty!');
        }
    }
}