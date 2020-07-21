<?php

namespace Tests\presentation\services;

use PHPUnit\Framework\TestCase;
use App\presentation\services\ProcessPlanes;
use App\presentation\exceptions\ProcessPlanesException;

class ProcessPlanesTest extends TestCase {

  public function testItWithEmptyData() {
    $this->expectException(ProcessPlanesException::class);
    $this->expectExceptionMessage('Data param is required!');
    ProcessPlanes::handle('');
  }

  public function testItWithInvalidDataType() {
    $this->expectException(ProcessPlanesException::class);
    $this->expectExceptionMessage('The param data needs to be a json!');
    ProcessPlanes::handle('invalid_json');
  }
}