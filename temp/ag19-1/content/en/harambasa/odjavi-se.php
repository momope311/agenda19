<?php
if(!defined('PROTECT')){die('Protected Content!');}

if (isset($_COOKIE[SITE])) {

	setcookie(SITE, '', time() - 3600 * 24 * 30, '/');
}

session_destroy();

header('Location: '.URL.$lett.'/'.HOME);

?>	