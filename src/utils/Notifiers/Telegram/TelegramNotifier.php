<?php

namespace App\utils\Notifiers\Telegram;

use App\domain\usecases\PlaneModel;
use App\domain\usecases\PlaneTypes;
use App\presentation\interfaces\Notifier;
use App\utils\Requests\RequestsInterface;

class TelegramNotifier implements Notifier {
    
    const API_BASE_URL = 'https://api.telegram.org';
    private RequestsInterface $requestService;

    public function __construct(RequestsInterface $requestService) {
        $this->requestService = $requestService;
    }

    public function notify(PlaneModel $plane): bool {
      $message = 'Vôo ' . $plane->flightNumber . ' da empresa ' . $plane->airline . ' vai ';
      if($plane->type == PlaneTypes::ARRIVAL) {
        $message.= 'CHEGAR no aeroporto ';
      } else if ($plane->type == PlaneTypes::DEPARTURE) {
        $message.= 'PARTIR do aeroporto ';
      }
      $message .= $plane->airport->name . ' ás ' . (new \DateTime($plane->timeScheduled))->format('H:i:s');

      $url = self::buildNotifyUrl($message);
      $this->requestService->get($url);
      return true;
    }

    private static function getBotUrl($botToken = '') {
        return self::API_BASE_URL . '/bot' . $botToken;
    }

    public static function buildNotifyUrl($message = ''){
      if(empty($message)) {
        throw new TelegramNotifierException('Message param is required!', 400);
      }

      $chatId = 1209657923;    
      $botUrl = self::getBotUrl('1234038119:AAH6i-CRcHLJmBx2huUS0rH-XgsgT3Y7uH0');
      return $botUrl . '/sendMessage?chat_id=' . $chatId . '&text=' . urlencode($message);
    }
}