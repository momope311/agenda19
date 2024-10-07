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
<section id='content'>
<h1 class='cent'>ИНФО</h1>
$e
</section>
";

?>