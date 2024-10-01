<?php
if(!defined('PROTECT')){die('Protected Content!');}

class Decode extends AppConfig {
	
	public function Output() {
		
		global $lett;

		$compress = AppConfig::GetConfig('compress');

		$content = ob_get_contents();
		ob_end_clean();

		$content = self::Converter($content);
		
		if ($compress == 1) {
			
			$content = self::Compress($content);
		}

		if ($lett === 'lat') {
			
			$content = self::Transliteration($content);	
		}
		
		return $content;
	}
	
	private static function Converter($input) {
		
		$conversion_table = self::ConversionTable();

		$output = strtr ($input, $conversion_table);
		
		return $output;
	}

	private static function ConversionTable() {
		
		global $lett, $opt1, $opt2;

		$link = new DB();
		
		if ($opt1 == 'category') {
			
			$query = "SELECT * FROM categories WHERE catseo = ?";
			$result = $link->GetRow($query, [$opt2]);
			
			if ($result) {
			
				if ($result['meta_desc']) {
					
					$description = $result['meta_desc'];
				}
				
				if ($result['meta_key']) {
					
					$keywords = $result['meta_key'];
				}
				
				if ($result['meta_author']) {
					
					$author = $result['meta_author'];
				}
			}
		} else if ($opt1 == 'article') {

			$query = "SELECT * FROM articles WHERE seo = ?";
			$result = $link->GetRow($query, [$opt2]);
			
			if ($result) {
				
				if ($result['meta_desc']) {
					
					$description = $result['meta_desc'];
				}
				
				if ($result['meta_key']) {
					
					$keywords = $result['meta_key'];
				}
				
				if ($result['meta_author']) {
					
					$author = $result['meta_author'];
				}
			}
		}

		$body = Content::Body();

		$temp = AppConfig::GetConfig('temp');
		$root = AppConfig::GetConfig('root');
		$lb = AppConfig::GetLangAll($lett);

		return $conversion_table = array (

			"{#html_lang#}"			=> $lb['html_lang'],
			"{#meta_desc#}"			=> $lb['meta_desc'],
			"{#meta_keys#}"			=> $lb['meta_keys'],
			"{#meta_auth#}"			=> $lb['meta_auth'],
			"{#favicon#}"			=> "<link rel='icon' href='".$root."favicon.ico'>",
			"{#title#}"				=> $lb['title'].' | '.$opt1,
			"{#basecss#}"			=> "<link rel='stylesheet' href='".$root."temp/".$temp."/css/style.css'>",
			"{#body#}"				=> $body
		);
	}
	
	private static function Compress($input) {

		$content = str_replace(array("\r\n", "\r"), "\n", $input);
		$lines = explode("\n", $content);
		$new_lines = array();

		foreach ($lines as $i => $line) {
		    
		    if(!empty($line)) {
		        $new_lines[] = trim($line);
		    }
		}

		$content = implode($new_lines);

		return $content;
	}

	private static function Transliteration($input) {
		
		$transliteration_sr_ci_la = self::TransliterationTable();

		$output = strtr ($input, $transliteration_sr_ci_la);

		return $output;
	}

	private static function TransliterationTable() {
		
		$transliteration_sr_ci_la = array (
			
			"А" => "A", "Б" => "B", "В" => "V", "Г" => "G", "Д" => "D", "Ђ" => "Đ", "Е" => "E", "Ж" => "Ž", "З" => "Z", "И" => "I", 
			"Ј" => "J", "К" => "K", "Л" => "L", "Љ" => "LJ", "М" => "M", "Н" => "N", "Њ" => "NJ", "О" => "O", "П" => "P", "Р" => "R", 
			"С" => "S", "Т" => "T", "Ћ" => "Ć", "У" => "U", "Ф" => "F", "Х" => "H", "Ц" => "C", "Ч" => "Č", "Џ" => "DŽ", "Ш" => "Š", 

			"а" => "a", "б" => "b", "в" => "v", "г" => "g", "д" => "d", "ђ" => "đ", "е" => "e", "ж" => "ž", "з" => "z", "и" => "i", 
			"ј" => "j", "к" => "k", "л" => "l", "љ" => "lj", "м" => "m", "н" => "n", "њ" => "nj", "о" => "o", "п" => "p", "р" => "r", 
			"с" => "s", "т" => "t", "ћ" => "ć", "у" => "u", "ф" => "f", "х" => "h", "ц" => "c", "ч" => "č", "џ" => "dž", "ш" => "š", 

			"Ља" => "Lja", "Ље" => "Lje", "Љи" => "Lji", "Љо" => "Ljo", "Љу" => "Lju", 
			"Ња" => "Nja", "Ње" => "Nje", "Њи" => "Nji", "Њо" => "Njo", "Њу" => "Nju", 
			"Џа" => "Dža", "Џе" => "Dže", "Џи" => "Dži", "Џо" => "Džo", "Џу" => "Džu"
		);

		return $transliteration_sr_ci_la;
	}
}

?>