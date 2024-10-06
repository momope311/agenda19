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

		/*

		if (!isset($_SESSION[$site]['first']) AND (($opt1 == ''))) {

			$_SESSION[$site]['first'] = 1;
			return self::Nav().self::Front().self::Content().self::Footer();
		} else {

			return self::Nav().self::Content().self::Footer();
		}

		*/

		return self::Nav().self::Front().self::Content().self::Footer();
	}
	
	private static function Nav() {
		
		global $lett, $opt1;

		$ln = Links::GetLinks($lett);
		
		if ($opt1 == $ln['novosti']) {
			$n = "class='active'";$m = '';$k = '';$a = '';
		} elseif ($opt1 == $ln['magazin']) {
			$m = "class='active'";$n = '';$k = '';$a = '';
		} elseif ($opt1 == $ln['kategorije']) {
			$k = "class='active'";$n = '';$m = '';$a = '';
		} elseif ($opt1 == $ln['arhiva']) {
			$a = "class='active'";$n = '';$k = '';$m = '';
		} else {
			$n = '';$m = '';$k = '';$a = '';
		}

		$temp 	= AppConfig::GetConfig('temp');
		$root 	= AppConfig::GetConfig('root');
		$url 	= AppConfig::GetConfig('url');

		$title 			= AppConfig::GetLang($lett, 'title');
		$home 			= AppConfig::GetLang($lett, 'home');
		$magazin 		= AppConfig::GetLang($lett, 'magazin');
		$kategorije 	= AppConfig::GetLang($lett, 'kategorije');
		$arhiva	 		= AppConfig::GetLang($lett, 'arhiva');
		$jezik 			= AppConfig::GetLang($lett, 'jezik');
		$engleski 		= AppConfig::GetLang($lett, 'engleski');
		$latinica 		= AppConfig::GetLang($lett, 'latinica');
		$cirilica 		= AppConfig::GetLang($lett, 'cirilica');

		require_once 'temp/'.$temp.'/navigation.php';
		return $navigation;	
	}
	
	private static function Front() {
		
		global $lett;

		$temp 	= AppConfig::GetConfig('temp');
		$root 	= AppConfig::GetConfig('root');
		$title 	= AppConfig::GetLang($lett, 'title');
		$desc 	= AppConfig::GetLang($lett, 'desc');
		
		require_once 'temp/'.$temp.'/front.php';
		return $front;
	}
	
	private static function Content() {
		
		global $lett, $opt1, $opt2, $opt3, $opt4;

		if (($lett == 'lat') OR ($lett == 'cyr')) {

			$lang = 'sr';
		} elseif ($lett == 'eng') {

			$lang = 'en';
		}

		$temp = AppConfig::GetConfig('temp');

		$base_dir 			= 'temp/' . $temp . '/inc/' . $lang .'/'. USERTYPE . '/';
		$base_dir_general 	= 'temp/' . $temp . '/inc/' . $lang . '/common/';
		
		$file 				= !empty($opt1) ? $opt1 : '';
	    $file_path 			= $base_dir . $file . '.php';
	    $file_path_general 	= $base_dir_general . $file . '.php';
		
		if ((AppConfig::GetConfig('works') !== 0) && ((USERTYPE == 'gost') OR (USERTYPE == 'novajlija') OR (USERTYPE == 'clan') OR (USERTYPE == 'harambasa'))) {
	        
			$works = AppConfig::GetLang($lett, 'works_mess');

	        if ($lang == 'en') {
	        	
	        	require_once 'temp/' . $temp . '/inc/' . $lang . '/common/works.php';

	  	    	if ($opt1 == 'sign-in') {
	        	
	        		require_once 'temp/' . $temp . '/inc/'. $lang .'/gost/sign-in.php';
	        	}
	    	} elseif ($lang == 'sr') {

	    		require_once 'temp/' . $temp . '/inc/' . $lang . '/common/radovi.php';

	    		if ($opt1 == 'prijavi-se') {
	        	
	        		require_once 'temp/' . $temp . '/inc/'. $lang .'/gost/prijavi-se.php';
	        	}
	    	}
		} else {
			
			if (file_exists($file_path)) {
		            
		        require_once $file_path;
		    } else if (file_exists($file_path_general)) {
	        		
	        	require_once $file_path_general;
	    	} else {

		    	require_once $base_dir_general . 'info.php';
		    }
		}

		return $content;
	}

	private static function Footer() {
		
		global $lett;
		
		$temp = AppConfig::GetConfig('temp');
		$root = AppConfig::GetConfig('root');
		
		$copy = AppConfig::GetLang($lett, 'copy');
		
		require_once 'temp/'.$temp.'/footer.php';
		
		return $footer;
	}
}

?>