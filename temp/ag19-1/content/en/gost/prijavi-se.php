<?php
if(!defined('PROTECT')){die('Protected Content!');}

class System extends AppConfig {
	
	public static function Signin($username, $password, $remember) {
    
	    global $lett;
	    
	    $max_logins = 3;

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

	private static function md61($password) {

        $md5Hash = md5($password);


        $permutation = [15, 7, 23, 31, 3, 11, 19, 27, 1, 9, 17, 25, 5, 13, 21, 29, 0, 8, 16, 24, 4, 12, 20, 28, 2, 10, 18, 26, 6, 14, 22, 30];
        $hashArray = str_split($md5Hash);

        $permutedArray = [];

        foreach ($permutation as $index) {
            
            $permutedArray[] = $hashArray[$index];
        }

        $md61Hash = implode('', $permutedArray);

        return $md61Hash;
    }
}

$e = '';

if (isset($_POST['submit'])) {
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$remember = isset($_POST['remember']) ? 1 : 0;
	
	if (empty($username) OR empty($password)) {
		
		$e = "<p class='redcent'>Попуните обавезна поља!</p>";
	} else {
		
		$e = System::Signin($username, $password, $remember);
	}
}
 
$content =
"
<section id='content'>
<h1 class='cent'>Пријави се</h1>
$e
<form action='' method='post' onsubmit='scrollToAnchor()'>
    <p class='cent'>
    Корисничко име * :
    <br>
    <input type='text' name='username' maxlength='30' placeholder='Ваше име' class='medinput'>
    <br>
    Лозинка * :
    <br>
    <input type='password' name='password' maxlength='30' placeholder='Ваша лозинка' class='medinput'>
    <br>
    Запамти ме <input type='checkbox' id='remember' name='remember' checked><br><br>
    <input type='submit' name='submit' value='Прихвати' class='medbut'>
    </p>
</form>
</section>
";

?>