<?php
if(!defined('PROTECT')){die('Protected Content!');}

class Engine {
	
	public static function Signin($username, $password, $remember) {
    
	    global $lett;
	    
	    $max_logins = 4;

		if (isset($_COOKIE['max_logins'])) {
	        
	        $logins = $_COOKIE['max_logins'] + 1;

	        if ($logins > $max_logins) {
        		
        		die('You are currently blocked. Signin Failed! Clear your entire browser history. And restart the browser.');
    		}
	    } else {

	    	$logins = 1;
	    }
		
		setcookie('max_logins', $logins, time() + (86400 * 5), "/");

	    $password = self::md61($password);
	    
	    $link = new DB();
	    $query = "SELECT * FROM users WHERE username = ? AND password = ? AND 
        ((usertype = 'novajlija') OR (usertype = 'clan') 
            OR (usertype = 'harambasa') OR (usertype = 'autor') 
            OR (usertype = 'moderator') OR (usertype = 'administrator'))";
	    $result = $link->GetRow($query, [$username, $password]);

	    if ($result) {

			setcookie('max_logins', 1, time() + (86400 * 5), "/");
	        
	        $_SESSION[SITE] = array(
	            
	            'username'      => $result['username'],
	            'session'       => $result['session'],
	            'usertype'      => $result['usertype']
	        );
	        
	        if ($remember == 1) {
	            
	            setcookie(SITE, $result['session'], time() + 3600 * 24 * 30, '/');
	        }
	        
	        header('Location: '.URL.$lett.'/'.HOME);
	    } else {

	        return "<p class='redcent'>Нема таквог корисника!</p>";
	    }
	}

	public static function Registration($email) {
		
		global $lett;
		
		$max_regs = 4;

		if (isset($_COOKIE['max_regs'])) {
	        
	        $regs = $_COOKIE['max_regs'] + 1;

	        if ($regs > $max_regs) {
        		
        		die('You are currently blocked. Register Failed! Clear your entire browser history. And restart the browser.');
    		}
	    } else {

	    	$regs = 1;
	    }
		
		setcookie('max_regs', $regs, time() + (86400 * 5), "/");
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

			$link = new DB();
			
			$query = "INSERT INTO users(username, password, email, userdesc, session, usertype, slika, stars) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			$result = $link->InsertRow($query, ['Кандидат', '', $email, '', '', 'kandidat', '', 0]);
			
			// function sendEmail($toEmail, $toName, $subject, $htmlContent, $altContent)
			$to = $email;
			$name = explode('@', $email)[0];
			$subject = "Агенда19 - регистрација";

			require_once 'email-template-registra.php';

			$alt_message = 
			"
		    Agenda19 - registracija:\n
		    Uspesno ste se registrovali.
		    Sada morate da izvrsite uplatu, to jest pretplatu na godinu dana.\n
		    Agenda19
			";

			//if (sendEmail($to, $name, $subject, $html_message, $alt_message)) {

				//header('Location: https://www.paypal.com/ncp/payment/HV6464FZFFYT4');
				header("Location: ".URL.$lett.'/pretplata');
			//}
		} else {

			return "<p class='redcent'>Електронска пошта није валидна!</p>";
		}
	}
}

?>