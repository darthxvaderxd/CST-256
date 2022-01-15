<?php

namespace App\Http\Service\Utility;

use Illuminate\Support\Facades\Log;

class MyLogger2 {
    public static $logger;
    public static function info($what) {
        try {
            if (!self::$logger) {
                self::$logger = Log::getMonolog();
            }
            self::$logger->info($what);
        } catch (\Exception $e) {

        }
    }
}
