<?php
/**
 * Application class
 *
 */

class App
{
    static protected $_config;

    static function config() {
        return self::$_config;
    }

    static function  setConfig($config) {
        self::$_config = $config;
    }

}