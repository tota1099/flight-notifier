<?php

namespace Tests\presentation\controllers;

use PHPUnit\Framework\TestCase;
use App\presentation\helpers\TimeHelper;

class TimeHelperTest extends TestCase {

  public function testDiffInMinutes() {
    $date1 = (new \DateTime('01/12/2022 10:34 AM'))->format('Y-m-d  H:i:s');
    $date2 = (new \DateTime('01/12/2022 10:00 AM'))->format('Y-m-d  H:i:s');

    $sut = new TimeHelper();
    $this->assertEquals($sut->getDiffInMinutes($date1, $date2), 34);

    $date1 = (new \DateTime('01/12/2022 10:01 AM'))->format('Y-m-d  H:i:s');
    $date2 = (new \DateTime('01/12/2022 08:04 AM'))->format('Y-m-d  H:i:s');

    $this->assertEquals($sut->getDiffInMinutes($date1, $date2), 117);
  }

  public function testConvertRFC3339ToDatetime() {
    $sut = new TimeHelper();
    $this->assertEquals($sut->convertRFC3339ToDatetime("2020-07-21T20:10:00+00:00"), '2020-07-21 20:10:00');
    $this->assertEquals($sut->convertRFC3339ToDatetime("2022-03-21T20:11:00+00:00"), '2022-03-21 20:11:00');
  }
}