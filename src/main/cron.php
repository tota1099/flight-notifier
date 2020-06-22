<?php

namespace App\main;

$raizFolder = __DIR__ . '/../..';

require_once($raizFolder . '/vendor/autoload.php');

use App\utils\Requests\CurlRequest;
use App\utils\Notifiers\Telegram\TelegramNotifier;
use App\presentation\controllers\NotifyPlanes;
use App\domain\usecases\Planes;
use App\presentation\controllers\ProcessPlanes;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable($raizFolder);
$dotenv->load();

$telegramChatId = $_ENV['TELEGRAM_CHAT_ID'];
$telegramTokenId = $_ENV['TELEGRAM_TOKEN_ID'];

$apiPlanes = file_get_contents("json_example.txt");
$planesProcessed = ProcessPlanes::handle($apiPlanes);

if(!empty($planesProcessed)) {
  $planes = new Planes();
  foreach($planesProcessed as $k => $plane) {
    $planes->offsetSet($k, $plane);
  }

  $request = new CurlRequest();
  $notifier = new TelegramNotifier($request, $telegramChatId, $telegramTokenId);
  $notifyPlanes = new NotifyPlanes($notifier);
  $notifyPlanes->handle($planes);
}