<?php
if(!defined('PROTECT')){die('Protected Content!');}

$s = '';
$e = '';
$use = '';
$session = $_SESSION[SITE]['session'];

$link = new DB();

$query = "SELECT * FROM users WHERE session = ? AND username = ?";
$result = $link->GetRow($query, [$session, $opt2]);

if ($result) {

	$use = Engine::Mode($result['usertype']);
	$userid = Engine::UserId($result['username']);

	$oldname = $result['username'];
	
	if (isset($_POST['submit'])) {

		$username 	= $_POST['name'];
		$email 		= $_POST['email'];
		$userdesc 	= $_POST['userdesc'];
		$password 	= $_POST['new_p'];
		$slika		= $_POST['slika'];

		if (empty($username) OR empty($email) OR empty($userdesc)) {
			
			$e = "<p class='red'>Попуните обавезна поља!</p>";
		} else {

			$e = Engine::Profile($userid, $oldname, $username, $email, $userdesc, $password, $slika);
		}
	}

	if ($result['slika'] == '') {

		$slika = "<img src='".ROOT."content/default-user.png' class='avatar'>";
	} else {
		
		if (isset($result['slika']) && (strpos($result['slika'], 'http://') === 0 || strpos($result['slika'], 'https://') === 0)) {
			
			$slika = "<img src='$result[slika]' class='avatar'>";
		} else {
			
			$slika = "<img src='".ROOT."$result[slika]' class='avatar'>";
		}
	}

	$s = "
	<br><br>
	Другим корисницима су видљиве следеће ставке: Корисничко име, тип корисника, опис и слика.
	<br><br>
	$e
	<form action='' method='post'>
		Корисничко име * :
		<br>
		<input type='text' name='name' maxlength='20' placeholder='Ваше име' value='$result[username]' class='form-control w-50 mt-2 min1'>
		<br>
		<br>
		$slika
		<br>
		<p><b>$use</b></p>
		<p>Звездица : <b>$result[stars]</b></p><br>
		Путања до слике (256x256) :
		<br>
		<input type='text' name='slika' maxlength='128' placeholder='Путања до слике (Ако нема, приказаће се генеричка слика)' value='$result[slika]' class='form-control w-50 mt-2 min1'>
		<br>
		<br>
		Имејл * :
		<br>
		<input type='text' name='email' maxlength='64' placeholder='Ваша имејл адреса' value='$result[email]' class='form-control w-50 mt-2 min1'>
		<br>
		<br>
		Опис (Ваш кратак опис) * :
		<br>
		<textarea class='form-control w-50 mt-2 fonter' name='userdesc' maxlength='128' placeholder='Опис (128 карактера)'>$result[userdesc]</textarea>
		<br>
		<br>
		Нова лозинка (Попунити само ако желите нову лозинку) :
		<br>
		<input type='text' name='new_p' maxlength='20' placeholder='Ваша нова лозинка' value='' class='form-control w-50 mt-2 min1 fonter'>
		<br>
		<br>
		<input type='submit' name='submit' class='btn btn-primary btn-large-text' value='Прихвати'>
		<a href='".ROOT."cir' class='ml-4 btn btn-primary btn-large-text'>Врати се</a>
	</form>";
} else {

	$s = "<p class='red'>Непостојећи корисник! Насилан упад!</p>";
}

$cont =
"
<section class='page-section mt-5' id='profil'>
<div class='container'>
<div class='text-center'>
<h2 class='page-section-heading text-secondary mb-0 d-inline-block'>Профил: $opt2</h2>
</div>
<div class='divider-custom'>
    <div class='divider-custom-line'></div>
    <div class='divider-custom-icon'><i class='fas fa-star'></i></div>
    <div class='divider-custom-line'></div>
</div>
$s
</div>
</section>
";

?>