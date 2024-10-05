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
 
$cont =
"
<section class='page-section mt-5' id='prijava'>
<div class='container text-center'>
<div class='text-center'>
<h2 class='page-section-heading text-secondary mb-0 d-inline-block'>Пријави се</h2>
</div>
<div class='divider-custom'>
    <div class='divider-custom-line'></div>
    <div class='divider-custom-icon'><i class='fas fa-star'></i></div>
    <div class='divider-custom-line'></div>
</div>
$e
<form action='' method='post'>
    <br>
    Корисничко име * :
    <br>
    <div class='d-flex justify-content-center'>
        <input type='text' name='username' maxlength='20' placeholder='Ваше име' class='form-control w-25 mt-2 min1'>
    </div>
    <br>
    Лозинка * :
    <br>
    <div class='d-flex justify-content-center'>
        <input type='password' name='password' maxlength='20' placeholder='Ваша лозинка' class='form-control w-25 mt-2 min1 fonter'>
    </div>
    <br>
    Запамти ме <input type='checkbox' id='remember' name='remember' class='form-check-input ml-2 mt-2' checked><br><br>
    <input type='submit' name='submit' class='btn btn-primary btn-large-text' value='Потврди'>
</form>
</div>
</section>
";

?>