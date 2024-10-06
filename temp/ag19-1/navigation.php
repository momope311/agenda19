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
			<li><a ".$n." href='".$root.$lett."/".$ln['novosti']."#content'>".$home."</a></li>
			<li><a ".$m." href='".$root.$lett."/".$ln['magazin']."#content'>".$magazin."</a></li>
			<li><a ".$k." href='".$root.$lett."/".$ln['kategorije']."#content'>".$kategorije."</a></li>
			<li><a ".$a." href='".$root.$lett."/".$ln['arhiva']."#content'>".$arhiva."</a></li>
			<li class='dropdown'>
				<a href='#'>".$jezik."</a>
				<ul class='dropdown-menu'>
					<li><a href='".$root."eng#content' class='$e'>- ".$engleski."</a></li><br>
					<li><a href='".$root."lat#content' class='$l'>- ".$latinica."</a></li><br>
					<li><a href='".$root."cyr#content' class='$c'>- ".$cirilica."</a></li>
				</ul>
			</li>
		</ul>
	</div>
	<div class='mobnav'>
		<a href='".$url.$lett."' class='logo'>".$title."</a>
		<div id='links'>
			<a ".$n." href='".$root.$lett."/".$ln['novosti']."#content'>".$home."</a>
			<a ".$m." href='".$root.$lett."/".$ln['magazin']."#content'>".$magazin."</a>
			<a ".$k." href='".$root.$lett."/".$ln['kategorije']."#content'>".$kategorije."</a>
			<a ".$a." href='".$root.$lett."/".$ln['arhiva']."#content'>".$arhiva."</a>
			<a href='".$root."eng#content' class='lang $e'>- ".$engleski."</a>
			<a href='".$root."lat#content' class='lang $l'>- ".$latinica."</a>
			<a href='".$root."cyr#content' class='lang $c'>- ".$cirilica."</a>
		</div>
		<a href='javascript:void(0);' class='icon' onclick='Dropd()'>&#9776;</a>
	</div>
</section>

";

?>