<?php
if(!defined('PROTECT')){die('Protected Content!');}

$s = '';
$e = '';

if (isset($_POST['submit'])) {

    $username = $_POST['username'];
    $usertype = $_POST['usertype'];

    $e = Engine::Tips($username, $usertype);
}

if (isset($_POST['submit2'])) {

    $username = $_POST['username'];

    $e = Engine::Tips($username, 'blokiran');
}

$s .= 
"
<form action='' method='post'>
Корисничко име * :
<input type='text' name='username' maxlength='20' placeholder='Корисничко име' class='form-control w-25 mt-2'>
<select class='form-control w-25 mt-4' name='usertype'>
    <option value='novajlija'>Новајлија</option>
    <option value='clan'>Члан</option>
    <option value='harambasa'>Харамбаша</option>
    <option value='autor'>Аутор</option>
    <option value='moderator'>Модератор</option>
    <option value='administrator'>Администратор</option>
</select>
<input type='submit' name='submit' class='btn btn-primary btn-large-text mt-4' value='Типуј'>
</form>
<br><br>
<form action='' method='post'>
Корисничко име * :
<input type='text' name='username' maxlength='20' placeholder='Корисничко име' class='form-control w-25 mt-2'>
<input type='submit' name='submit2' class='btn btn-primary btn-large-text mt-4' value='Блокирај корисника'>
</form>
<br><br>
";

$cont =
"
<section class='page-section mt-5' id='tipovanje'>
<div class='container'>
<div class='text-center'>
<h2 class='page-section-heading text-secondary mb-0 d-inline-block'>ТИПОВАЊЕ</h2>
</div>
<div class='divider-custom'>
    <div class='divider-custom-line'></div>
    <div class='divider-custom-icon'><i class='fas fa-star'></i></div>
    <div class='divider-custom-line'></div>
</div>
<br><br>
$e
$s
</div>
</section>
";

?>