<?php

namespace App\Helpers;

class TMAUtilities
{


    public static function printSecondsAsHMS($seconds)
    {
        $t = round($seconds);
        return sprintf('%02d:%02d:%02d', ($t / 3600), ($t / 60 % 60), $t % 60);
    }

    public static function printSecondsAsHM($seconds)
    {
        $t = round($seconds);
        return sprintf('%02d:%02d', ($t / 3600), ($t / 60 % 60));
    }

    public static function getSunsetDeltaTs()
    {  //compute the local time difference between now and sunset in s
        $sunset_utc_timestamp = date_sunset(time(), SUNFUNCS_RET_TIMESTAMP, env('TMA_LATITUDE', 50), env('TMA_LONGITUDE', 3), 90, 0); //0 is UTC offset so return is GMT
        return $sunset_utc_timestamp - gmdate('U');
    }

    public static function getSunsetDeltaTsAsHMS()
    {
        return TMAUtilities::printSecondsAsHMS(TMAUtilities::getSunsetDeltaTs());
    }

    public static function getSunsetDeltaTsAsHM()
    {
        return TMAUtilities::printSecondsAsHM(TMAUtilities::getSunsetDeltaTs());
    }

    public static function getAeronauticalNightDeltaTs()
    {  //compute the local time difference between now and sunset+30m in s
        $sunset_utc_timestamp = date_sunset(time(), SUNFUNCS_RET_TIMESTAMP, env('TMA_LATITUDE', 50), env('TMA_LONGITUDE', 3), 90, 0); //0 is UTC offset so return is GMT
        return $sunset_utc_timestamp + 1800 - gmdate('U');
    }

    public static function getAeronauticalNightDeltaTsAsHMS()
    {
        return TMAUtilities::printSecondsAsHMS(TMAUtilities::getAeronauticalNightDeltaTs());
    }

    public static function getAeronauticalNightDeltaTsAsHM()
    {
        return TMAUtilities::printSecondsAsHM(TMAUtilities::getAeronauticalNightDeltaTs());
    }
}
