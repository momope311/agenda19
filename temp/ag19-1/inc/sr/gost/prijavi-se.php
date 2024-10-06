<?php
if(!defined('PROTECT')){die('Protected Content!');}

$e = '';

if (isset($_POST['submit'])) {
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$remember = isset($_POST['remember']) ? 1 : 0;
	
	if (empty($username) OR empty($password)) {
		
		$e = "<p class='redcent'>Попуните обавезна поља!</p>";
	} else {
		
		$e = Engine::Signin($username, $password, $remember);
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