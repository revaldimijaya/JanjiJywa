<?php


namespace App\Helpers;


use Carbon\Carbon;

class CarbonHelper
{

    public static function parseDate($date = null) {
        if($date === null) {
            return Carbon::now()->format("Ymd His");
        }
        return Carbon::parse($date)->format("Ymd His");
    }
}
