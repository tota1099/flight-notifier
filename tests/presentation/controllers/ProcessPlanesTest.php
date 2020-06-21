<?php

namespace Tests\utils\Notifiers\Telegram;

require_once dirname(__DIR__) . '/../../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use App\presentation\controllers\ProcessPlanes;
use App\presentation\exceptions\ProcessPlanesException;

class ProcessPlanesTest extends TestCase {

  public function testItWithEmptyData() {
    $this->expectException(ProcessPlanesException::class);
    $this->expectExceptionMessage('Data param is required!');
    ProcessPlanes::handle('');
  }
}