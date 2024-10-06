<?php
if(!defined('PROTECT')){die('Protected Content!');}

$e = '';

if (isset($_POST['submit'])) {
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	$remember = isset($_POST['remember']) ? 1 : 0;
	
	if (empty($username) OR empty($password)) {
		
		$e = "<p class='redcent'>Please fill in the required fields!</p>";
	} else {
		
		$e = Engine::Signin($username, $password, $remember);
	}
}
 
$content =
"
<section id='content'>
<h1 class='cent'>Sign In</h1>
$e
<form action='' method='post' onsubmit='scrollToAnchor()'>
    <p class='cent'>
    Username * :
    <br>
    <input type='text' name='username' maxlength='30' placeholder='Your name' class='medinput'>
    <br>
    Password * :
    <br>
    <input type='password' name='password' maxlength='30' placeholder='Your password' class='medinput'>
    <br>
    Remember me <input type='checkbox' id='remember' name='remember' checked><br><br>
    <input type='submit' name='submit' value='Submit' class='medbut'>
    </p>
</form>
</section>
";

?>