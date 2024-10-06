<?php
if(!defined('PROTECT')){die('Protected Content!');}

$e = '';

if (isset($_POST['submit'])) {

	$email = $_POST['email'];
	
	if (empty($email)) {
		
		$e = "<p class='redcent'>Enter your Email!</p>";
	} else {
		
		$e = Engine::Registration($email);
	}
}

$content =
"
<section id='content'>
<h1 class='cent'>Registration</h1>
$e
<form action='' method='post' onsubmit='scrollToAnchor()'>
    <p class='cent'>
    Email * :
    <br>
    <input type='text' name='email' maxlength='64' placeholder='Your Email' class='medinput'>
    <br>
    <input type='submit' name='submit' class='medbut' value='Submit'>
    </p>
</form>
</section>
";

?>