<?php

namespace App\domain\usecases;

class Planes extends \ArrayObject {
  public function offsetSet($index, $newval)
  {
    if($newval instanceof PlaneModel) {
      return parent::offsetSet($index, $newval);
    }
    throw new \InvalidArgumentException('Value must be a Plane');
  }
}