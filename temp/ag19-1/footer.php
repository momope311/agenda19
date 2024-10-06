<?php
if(!defined('PROTECT')){die('Protected Content!');}

if (USERTYPE == 'gost') {
	
	$flinks =
	"<p>
	<a class='blokic' href='".$root.$lett."/news#content'>News</a>
	<a class='blokic' href='".$root.$lett."/sign-in#content'>Sign In</a>
	<a class='blokic' href='".$root.$lett."/registration#content'>Registration</a>
	</p>
	";
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