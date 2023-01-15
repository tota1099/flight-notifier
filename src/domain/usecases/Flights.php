<?php

namespace App\domain\usecases;

class Flights extends \ArrayObject {
  public function offsetSet($index, $newval) : void
  {
    if(!($newval instanceof FlightModel)) {
      throw new \InvalidArgumentException('Value must be a Flight');
    }
    parent::offsetSet($index, $newval);
  }
}