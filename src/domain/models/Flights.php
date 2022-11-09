<?php

namespace App\domain\models;

class Flights extends \ArrayObject {
  public function offsetSet($index, $newval)
  {
    if($newval instanceof FlightModel) {
      return parent::offsetSet($index, $newval);
    }
    throw new \InvalidArgumentException('Value must be a Flight');
  }
}