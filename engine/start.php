<?php
if(!defined('PROTECT')){die('Protected Content!');}

class Start extends AppConfig {

    public static function Initialize() {

        // protected sessions
        ini_set('session.use_only_cookies', 1);
        ini_set('session.cookie_httponly', 1);
        ini_set('session.cookie_secure', 1);
        ini_set('session.use_strict_mode', 1);
        ini_set('session.cookie_samesite', 'Strict');

        // Open session and baffer
        session_start();
        ob_start();
		
        // protected maximum login try
        if (isset($_COOKIE['max_logins']) AND $_COOKIE['max_logins'] >= 3) {
            
            die('You are currently blocked. Signin Failed! Clear your entire browser history. And restart the browser.');
        }

        // protected maximum register try
        if (isset($_COOKIE['max_regs']) AND $_COOKIE['max_regs'] >= 3) {
            
            die('You are currently blocked. Register Failed! Clear your entire browser history. And restart the browser.');
        }
		
        $site = AppConfig::GetConfig('site');

        if (isset($_COOKIE[$site])) {
            
            if (isset($_SESSION[$site])) {
                
                // ok
            } else {
                
                $data = self::DataFromCookie($_COOKIE[$site]);
                
                if ($data == false) {
                    
                    die('Bad cookie! Delete your browser cache and restart');
                } else {
                    
                    $_SESSION[$site] = array(
                    
                        'username'      => $data['username'],
                        'session'       => $data['session'],
                        'usertype'      => $data['usertype']
                    );
                }
            }
        } else {
            if (isset($_SESSION[$site])) {
                
                // ok
            } else {
                
                $_SESSION[$site] = array(
                
                    'username'      => '',
                    'session'       => md5(microtime(true)).md5(rand()),
                    'usertype'      => 'gost'
                );
            }
        }

        define('USERTYPE', $_SESSION[$site]['usertype']);
    }
	
	private static function DataFromCookie($session) {

		$link = new DB();

        $query = "SELECT * FROM users WHERE session = ? AND usertype NOT IN ('blocked', 'candidate')";
        $result = $link->GetRow($query, [$session]);

		if ($result) {

			return $result;
		} else {

			return false;
		}
	}
}

?>