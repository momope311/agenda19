<?php
if(!defined('PROTECT')){die('Protected Content!');}

class Links extends AppConfig {

    // Linkovi za srpski
    private static $links_sr = [

        'novosti'       => 'novosti',
        'magazin'       => 'magazin',
        'kategorije'    => 'kategorije',
        'arhiva'        => 'arhiva'
    ];

    // Links for english
    private static $links_en = [

        'novosti'       => 'news',
        'magazin'       => 'magazin',
        'kategorije'    => 'categories',
        'arhiva'        => 'archive'
    ];

    // Get links
    public static function GetLinks($lett) {
        
        if (($lett === 'cyr') || ($lett === 'lat')) {
            
            return self::$links_sr;
        } elseif ($lett === 'eng') {
            
            return self::$links_en;
        } else {
            
            return [];
        }
    }
}

?>