<?php

namespace App\presentation\interfaces;

interface Time {
    public function now() : String;
    public function convertRFC3339ToDatetime(String $date): String;
    public function getDiffInMinutes(String $date1, String $date2) : int;
}