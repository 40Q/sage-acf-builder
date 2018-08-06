<?php
namespace App\Builder;

class Config {
    static $myvariablearray = array();

    public static function createDynamic($variable, $value){
        self::$myvariablearray[$variable] = $value;
    }

    public static function __callstatic($name, $arguments){
        return self::$myvariablearray[$name];
    }
}
