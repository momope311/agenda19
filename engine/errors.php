<?php
if(!defined('PROTECT')){die('Protected Content!');}

class Errors extends AppConfig {

    public static function Display() {

        $e = AppConfig::GetConfig('errors');

        if ($e == 1) {
            
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
        } else {

            ini_set('display_errors', 0);
            ini_set('display_startup_errors', 0);
            error_reporting(0);
        }
    }
}

?>