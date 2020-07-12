<?php

namespace App\utils\Notifiers;

use App\domain\usecases\PlaneModel;
use App\domain\usecases\PlaneTypes;
use App\presentation\interfaces\Notifier;
use App\presentation\interfaces\Requests;

class TelegramNotifierAdapter implements Notifier {
    
    const API_BASE_URL = 'https://api.telegram.org';
    private Requests $requestService;
    private Int $chatId;
    private String $botToken;

    public function __construct(Requests $requestService, Int $chatId, String $botToken) {
        $this->requestService = $requestService;
        $this->chatId = $chatId;
        $this->botToken = $botToken;
    }

    public function notify(PlaneModel $plane): bool {
      $message = 'Vôo ' . $plane->flightNumber . ' da empresa ' . $plane->airline . ' vai ';
      if($plane->type == PlaneTypes::ARRIVAL) {
        $message.= 'CHEGAR no aeroporto ';
      } else if ($plane->type == PlaneTypes::DEPARTURE) {
        $message.= 'PARTIR do aeroporto ';
      }
      $message .= $plane->airport->name . ' ás ' . (new \DateTime($plane->timeScheduled))->format('H:i:s');

      $url = $this->buildNotifyUrl($message);
      $this->requestService->get($url);
      return true;
    }

    private function getBotUrl() {
        return self::API_BASE_URL . '/bot' . $this->botToken;
    }

    public function buildNotifyUrl($message = ''){
      if(empty($message)) {
        throw new TelegramNotifierAdapterException('Message param is required!', 400);
      }

      $botUrl = $this->getBotUrl();
      return $botUrl . '/sendMessage?chat_id=' . $this->chatId . '&text=' . urlencode($message);
    }
}