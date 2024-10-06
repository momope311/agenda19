<?php
if(!defined('PROTECT')){die('Protected Content!');}

$navigation =
"
<section id='nav-wrap'>
	<div id='navigation'>
		<ul id='left-menu'>
			<li><a href='".$url."'>".$title."</a></li>
		</ul>
		<ul id='right-menu'>
			<li><a ".$h." href='".$root.$lett."/".$ln['novosti']."'>".$home."</a></li>
			<li><a ".$m." href='".$root.$lett."/".$ln['magazin']."'>".$magazin."</a></li>
			<li><a ".$k." href='".$root.$lett."/".$ln['kategorije']."'>".$kategorije."</a></li>
			<li><a ".$a." href='".$root.$lett."/".$ln['arhiva']."'>".$arhiva."</a></li>
			<li class='dropdown'>
				<a href='#'>".$jezik."</a>
				<ul class='dropdown-menu'>
					<li><a href='".$root."eng'>- ".$engleski."</a></li><br>
					<li><a href='".$root."lat'>- ".$latinica."</a></li><br>
					<li><a href='".$root."cyr'>- ".$cirilica."</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div class='mobnav'>
		<a href='".$url.$lett."' class='logo'>".$title."</a>
		<div id='links'>
			<a ".$h." href='".$root.$lett."/".$ln['novosti']."'>".$home."</a>
			<a ".$m." href='".$root.$lett."/".$ln['magazin']."'>".$magazin."</a>
			<a ".$k." href='".$root.$lett."/".$ln['kategorije']."'>".$kategorije."</a>
			<a ".$a." href='".$root.$lett."/".$ln['arhiva']."'>".$arhiva."</a>
			<a href='".$root."eng' class='lang'>- ".$engleski."</a>
			<a href='".$root."lat' class='lang'>- ".$latinica."</a>
			<a href='".$root."cyr' class='lang'>- ".$cirilica."</a>
		</div>
		<a href='javascript:void(0);' class='icon' onclick='Dropd()'>&#9776;</a>
	</div>
</section>

";

?>