<?php
if(!defined('PROTECT')){die('Protected Content!');}

class Content extends AppConfig {
	
	public function __construct() {

		$temp = AppConfig::GetConfig('temp');
		$root = AppConfig::GetConfig('root');
		
		require_once 'temp/'.$temp.'/site.php';
	}

	public static function Body() {

		global $opt1;

		$site = AppConfig::GetConfig('site');

		if (!isset($_SESSION[$site]['first']) AND (($opt1 == ''))) {

			$_SESSION[$site]['first'] = 1;
			return self::Nav().self::Front().self::Content().self::Footer();
		} else {

			return self::Nav().self::Content().self::Footer();
		}
	}
	
	private static function Nav() {
		
		$temp = AppConfig::GetConfig('temp');

		require_once 'temp/'.$temp.'/navigation.php';
		return $navigation;	
	}
	
	private static function Front() {
		
		$temp = AppConfig::GetConfig('temp');
		$root = AppConfig::GetConfig('root');
		
		require_once 'temp/'.$temp.'/front.php';
		return $front;
	}
	
	private static function Content() {
		
		$temp = AppConfig::GetConfig('temp');
		
		require_once 'temp/'.$temp.'/content.php';
		return $content;
	}

	private static function Footer() {
		
		$temp = AppConfig::GetConfig('temp');
		
		require_once 'temp/'.$temp.'/footer.php';
		return $footer;
	}
}

?>