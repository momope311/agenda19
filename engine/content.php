<?php
if(!defined('PROTECT')){die('Protected Content!');}

class Content extends AppConfig {
	
	public function __construct() {

		$temp = AppConfig::$conf_public['temp'];
		$root = AppConfig::$conf_public['root'];
		
		require_once 'temp/'.$temp.'/site.php';
	}

	public static function Body() {

		global $opt1;

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

		if ($lett == 'eng') {
			$e = 'active';$l = '';$c = '';
		} elseif ($lett == 'lat') {
			$l = 'active';$e = '';$c = '';
		} elseif ($lett == 'cyr') {
			$c = 'active';$l = '';$e = '';
		} else {
			$e = '';$l = '';$c = '';
		}

		$temp 	= AppConfig::$conf_public['temp'];
		$root 	= AppConfig::$conf_public['root'];
		$url	= AppConfig::$conf_public['url'];

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

		$temp 	= AppConfig::$conf_public['temp'];
		$root 	= AppConfig::$conf_public['root'];
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

		$temp = AppConfig::$conf_public['temp'];

		$base_dir 			= 'temp/' . $temp . '/content/' . $lang .'/'. USERTYPE . '/';
		$base_dir_general 	= 'temp/' . $temp . '/content/' . $lang . '/common/';
		
		$file 				= !empty($opt1) ? $opt1 : '';
	    $file_path 			= $base_dir . $file . '.php';
	    $file_path_general 	= $base_dir_general . $file . '.php';
		
		if ((AppConfig::GetConfig('works') !== 0) && ((USERTYPE == 'gost') OR (USERTYPE == 'novajlija') OR (USERTYPE == 'clan') OR (USERTYPE == 'harambasa'))) {
	        
			$works = AppConfig::GetLang($lett, 'works_mess');

	        if ($lang == 'en') {
	        	
	        	require_once 'temp/' . $temp . '/content/' . $lang . '/common/works.php';

	  	    	if ($opt1 == 'sign-in') {
	        	
	        		require_once 'temp/' . $temp . '/content/'. $lang .'/gost/sign-in.php';
	        	}
	    	} elseif ($lang == 'sr') {

	    		require_once 'temp/' . $temp . '/content/' . $lang . '/common/radovi.php';

	    		if ($opt1 == 'prijavi-se') {
	        	
	        		require_once 'temp/' . $temp . '/content/'. $lang .'/gost/prijavi-se.php';
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
		
		$temp = AppConfig::$conf_public['temp'];
		$root = AppConfig::$conf_public['root'];
		
		$copy = AppConfig::GetLang($lett, 'copy');
		
		require_once 'temp/'.$temp.'/footer.php';
		
		return $footer;
	}
}

?>