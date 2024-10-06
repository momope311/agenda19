<?php
if(!defined('PROTECT')){die('Protected Content!');}

$e = '';

if ($opt2 == 'email-sent') {
	
	$e = "<p class='greencent'>Порука је успешно послата. Биће вам одговорено у најкраћем року.</p>";
} else if ($opt2 == 'write-success') {
	
	$e = "<p class='greencent'>Чланак успешно написан!</p>";
} else if ($opt2 == 'edit-success') {
	
	$e = "<p class='greencent'>Чланак успешно едитован!</p>";
} else if ($opt2 == 'delete-success') {
	
	$e = "<p class='greencent'>Успешно избрисан чланак!</p>";
} else if ($opt2 == 'add-category-success') {
	
	$e = "<p class='greencent'>Успешно креирана категорија!</p>";
} else if ($opt2 == 'edit-category-success') {
	
	$e = "<p class='greencent'>Категорија успешно едитована!</p>";
} else if ($opt2 == 'category-delete-success') {
	
	$e = "<p class='greencent'>Категорија успешно избрисана!</p>";
} else if ($opt2 == 'registration-start') {
	
	$e = "<p class='greencent'>Успешно сте аплицирали! Добићете податке за пријаву у наредних 24 часа.</p>";
} else if ($opt2 == 'profile-update') {
	
	$e = "<p class='greencent'>Успешно сте ажурирали профил! Добићете имејл као потврду.<br>
	Ако сте мењали корисничко име или лозинку, одјавите се, па се поново пријавите.</p>";
} else if ($opt2 == 'registration-completed') {
	
	$e = "<p class='greencent'>Успешно сте регистровали новог члана! Имејл је послат.</p>";
} else {
	
	$e = "<p class='redcent'>Нема садржаја! Приступ ограничен.</p>";
}

$content =
"
<section class='page-section mt-5' id='info'>
<div class='container'>
<div class='text-center'>
<h2 class='page-section-heading text-secondary mb-0 d-inline-block'>ИНФО</h2>
</div>
<div class='divider-custom'>
    <div class='divider-custom-line'></div>
    <div class='divider-custom-icon'><i class='fas fa-star'></i></div>
    <div class='divider-custom-line'></div>
</div>
$e
</div>
</section>
";

?>