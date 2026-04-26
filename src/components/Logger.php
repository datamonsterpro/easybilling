<?php
/**
 * Created by PhpStorm.
 * User: aleksey
 * Date: 09.06.17
 * Time: 2:24
 */

namespace easyBilling\components;

class Logger
{

    const COLOR_SUCCESS = '0;32';

    const COLOR_ERROR = '0;31';

    const COLOR_WARNING = '1;33';

    const COLOR_TRACE = '0;36';

    public static function trace($message, $color = null)
    {
        if (is_array($message) || is_object($message)) {
            $message = JsonHelper::encode($message);
        }

        if (!$color) {
            $color = self::COLOR_TRACE;
        }
        echo "\033[" . $color . "m" . $message . "\033[0m\r\n";
    }

    public static function error($message)
    {
        $color = self::COLOR_ERROR;

        if (is_array($message) || is_object($message)) {
            $message = JsonHelper::encode($message);
        }

        echo "\033[" . $color . "m" . $message . "\033[0m\r\n";
    }


    public static function warning($message)
    {
        $color = self::COLOR_WARNING;

        if (is_array($message) || is_object($message)) {
            $message = JsonHelper::encode($message);
        }

        echo "\033[" . $color . "m" . $message . "\033[0m\r\n";
    }

    public static function success($message)
    {
        $color = self::COLOR_SUCCESS;

        if (is_array($message) || is_object($message)) {
            $message = JsonHelper::encode($message);
        }

        echo "\033[" . $color . "m" . $message . "\033[0m\r\n";
    }


}