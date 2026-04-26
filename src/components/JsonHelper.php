<?php
/**
 * Created by PhpStorm.
 * User: aleksey
 * Date: 04.06.17
 * Time: 1:03
 */

namespace easyBilling\components;


class JsonHelper
{

    public static function encode($str, $flags = [])
    {
        $options = JSON_UNESCAPED_UNICODE;
        foreach ($flags as $flag) {
            $options = $options | $flag;
        }

        return $str ? json_encode($str, $options) : null;
    }

    public static function decode($str, $flags = [])
    {
        $options = JSON_UNESCAPED_UNICODE;
        foreach ($flags as $flag) {
            $options = $options | $flag;
        }

        $result = $str ? json_decode($str, true, 512, $options) : null;

        return $result;
    }

}