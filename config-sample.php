<?php
if(!defined('PROTECT')){die('Protected Content!');}

class AppConfig {
    
    // Public config data (accessible without method)
    public static $conf_public = [
        
        'url'       => 'http://localhost/agenda19/',    // URL site
        'root'      => '/agenda19/',                    // Root site
        'temp'      => 'ag19-1'                         // site template folder
    ];

    // Config data
    private static $conf = [
        
        'errors'    => 1,                               // Display errors 1 = yes 0 = no
        'works'     => 0,                               // Works on site 0 = no 1 = yes
        'compress'  => 0,                               // Compress html content
        'site'      => 'agenda19',                      // cookie name
        'dfl'       => 'eng',                           // Default lang (lat = SR-latinica, cyr = SR-cirilica, eng = English)
        
        // database
        'hostname'  => '',                              // hostname
        'username'  => '',                              // db username
        'password'  => '',                              // db password
        'database'  => '',                              // db name
        
        // email data
        'smtp_host'         => '',
        'smtp_username'     => '',
        'smtp_password'     => '',
        'email_from'        => '',
        'email_from_name'   => ''
    ];

    // Lang data - srpski
    private static $lang_sr = [
        
        'html_lang'     => 'sr',
        'homepage'      => 'novosti',
        'home'          => 'Новости',
        'title'         => 'Агенда19',
        'magazin'       => 'Магазин',
        'kategorije'    => 'Категорије',
        'arhiva'        => 'Архива',
        'jezik'         => 'Језик',
        'engleski'      => 'Engleski',
        'latinica'      => 'Latinica',
        'cirilica'      => 'Ћирилица',
        'copy'          => 'Агенда19 © %s. Сва права задржана.',
        'desc'          => 'Истраживачки рад - Нове технологије - Здрав живот',
        'meta_desc'     => 'Дигитални магазин који се бави новим, модерним, популарним темама. Има места за свакога. Можете много да научите и себи поправите дан.',
        'meta_keys'     => 'наука, мудрости, филозофија, мотивација, електроника, програмирање, уметност, приче, политика, интернет, блог, живот, магазин',
        'meta_auth'     => 'Агенда19 Тим',
        'g_message'     => 'Поштовани посетиоци, да би сте видели цео садржај сајта, довољно је да унесете ваш Имејл у регистрацији.<br>(Промо период - бесплатно)',
        'works_mess'    => 'Радови на сајту у наредних месец дана.'
    ];

    // Lang data - engleski
    private static $lang_en = [
        
        'html_lang'     => 'en',
        'homepage'      => 'news',
        'home'          => 'News',
        'title'         => 'Agenda19',
        'magazin'       => 'Magazin',
        'kategorije'    => 'Categories',
        'arhiva'        => 'Archive',
        'jezik'         => 'Language',
        'engleski'      => 'English',
        'latinica'      => 'SR Latin',
        'cirilica'      => 'SR Cyrillic',
        'copy'          => 'Agenda19 © %s. All rights reserved.',
        'desc'          => 'Research work - New Technologies - Healthy Living',
        'meta_desc'     => 'A digital magazine that covers new, modern, popular topics. There is something for everyone. You can learn a lot and improve your day.',
        'meta_keys'     => 'science, wisdom, philosophy, motivation, electronics, programming, art, stories, politics, internet, blog, life, magazine',
        'meta_auth'     => 'Agenda19 Team',
        'g_message'     => 'Dear visitors, to view the full content of the site, it is enough to enter your email in the registration.<br>(Promo period - free)',
        'works_mess'    => 'Works on the site in the next month.'
    ];

    // Get config parametar (one)
    protected static function GetConfig($key) {
        
        return isset(self::$conf[$key]) ? self::$conf[$key] : null;
    }

    // Cet lang config parametar (one)
    protected static function GetLang($lett, $key) {
        
        if (($lett === 'cyr') || ($lett === 'lat')) {
            
            if ($key === 'copy') {
                
                return sprintf(self::$lang_sr[$key], date('Y'));
            }

            return isset(self::$lang_sr[$key]) ? self::$lang_sr[$key] : null;
        } elseif ($lett === 'eng') {
            
            if ($key === 'copy') {
                
                return sprintf(self::$lang_en[$key], date('Y'));
            }

            return isset(self::$lang_en[$key]) ? self::$lang_en[$key] : null;
        } else {
            
            return [];
        }
    }

    // Get basic language data (all)
    protected static function GetLangAll($lett) {
        
        if (($lett === 'cyr') || ($lett === 'lat')) {
            
            return self::$lang_sr;
        } elseif ($lett === 'eng') {
            
            return self::$lang_en;
        } else {
            
            return [];
        }
    }

    // Sanitize $_GET (path) input
    public static function Path() {
        
        $path = isset($_GET['path']) ? $_GET['path'] : self::GetConfig('dfl');
        
        $sanitized_path = preg_replace('/[^a-zA-Z0-9_\/-]/', '', $path);
        $path = explode('/', $sanitized_path);
        $path = array_filter($path);

        if (isset($path[0])) {
            
            if ($path[0] == 'cyr') {

                $path[0] = 'cyr';
            } elseif ($path[0] == 'lat') {

                $path[0] = 'lat';
            } elseif ($path[0] == 'eng') {

                $path[0] = 'eng';
            } else {

                $path[0] = self::GetConfig('dfl');
            }
        }

        $path = array_pad($path, 5, '');
        
        if (empty($path[1])) {
            
            $path[1] = self::GetLang($path[0], 'homepage');
        }

        return $path;
    }
}

?>