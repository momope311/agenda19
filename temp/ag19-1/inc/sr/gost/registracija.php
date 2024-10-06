<?php
if(!defined('PROTECT')){die('Protected Content!');}

$e = '';

if (isset($_POST['submit'])) {

	$email = $_POST['email'];
	
	if (empty($email)) {
		
		$e = "<p class='redcent'>Унесите вашу Електронску пошту!</p>";
	} else {
		
		$e = Engine::Registration($email);
	}
}

$content =
"
<section id='content'>
<h1 class='cent'>Регистрација</h1>
$e
<form action='' method='post' onsubmit='scrollToAnchor()'>
    <p class='cent'>
    И-мејл * :
    <br>
    <input type='text' name='email' maxlength='64' placeholder='Ваша електронска пошта' class='medinput'>
    <br>
    <input type='submit' name='submit' class='medbut' value='Прихвати'>
    </p>
</form>
</section>
";

?>