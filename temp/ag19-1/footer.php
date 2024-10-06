<?php
if(!defined('PROTECT')){die('Protected Content!');}

if ($lett == 'eng') {
	
	if (USERTYPE == 'gost') {
		
		$flinks =
		"<p>
		<a class='blokic' href='".$root.$lett."/news#content'>News</a>
		<a class='blokic' href='".$root.$lett."/sign-in#content'>Sign In</a>
		<a class='blokic' href='".$root.$lett."/registration#content'>Registration</a>
		</p>
		";
	}
} else if (($lett == 'cyr')OR($lett == 'lat')) {

	if (USERTYPE == 'gost') {
		
		$flinks =
		"<p>
		<a class='blokic' href='".$root.$lett."/novosti#content'>Новости</a>
		<a class='blokic' href='".$root.$lett."/prijavi-se#content'>Пријави се</a>
		<a class='blokic' href='".$root.$lett."/registracija#content'>Регистрација</a>
		</p>
		";
	}
}

$footer =
"
<section id='footer'>
$flinks
<p class='copy'>
$copy
</p>
</section>
";

?>