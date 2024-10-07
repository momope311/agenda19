<?php
if(!defined('PROTECT')){die('Protected Content!');}

$s = '';

if ($opt4 == 1) {

	$link = new DB();
	
	if (!isset($_SESSION[SITE][$opt3])) {
		
		$query = "UPDATE users SET stars = stars + 1 WHERE username = ?";
		$result = $link->UpdateRow($query, [$opt3]);
	
		$_SESSION[SITE][$opt3] = 1;
	}
}

$link = new DB();
	
$query1 = "SELECT COUNT(*) FROM users WHERE 
	((usertype = 'novajlija') OR (usertype = 'clan') 
    OR (usertype = 'harambasa') OR (usertype = 'autor') 
    OR (usertype = 'moderator') OR (usertype = 'administrator'))";

$count = $link->GetRow($query1);

$total = ($count['COUNT(*)']);

if ($total > 0) {
	
	$limit = 30;
	$page = ($opt2 != '') ? $opt2 : 1;
	$start = $limit * ($page-1);
	$num_page = ceil($total/$limit);
	
	$query = "SELECT * FROM users WHERE 
		((usertype = 'novajlija') OR (usertype = 'clan') 
        OR (usertype = 'harambasa') OR (usertype = 'autor') 
        OR (usertype = 'moderator') OR (usertype = 'administrator')) 
        ORDER BY userid ASC LIMIT $start, $limit";
	
	$result = $link->GetRows($query);

	$red = $start;
	
	foreach ($result as $index => $r) {
		
		$use = Engine::Mode($r['usertype']);

		if ($r['slika'] == '') {

			$slika = "<a href='".ROOT."content/default-user.png'><img src='".ROOT."content/default-user.png' class='miniavatar'></a>";
		} else {
			
			if (isset($r['slika']) && (strpos($r['slika'], 'http://') === 0 || strpos($r['slika'], 'https://') === 0)) {
				
				$slika = "<img src='$r[slika]' class='miniavatar'>";
			} else {

				$slika = "<a href='".ROOT."$r[slika]'><img src='".ROOT."$r[slika]' class='miniavatar'></a>";
			}
		}

		if ($r['username'] == 'admin') {
			
			$username = "<span class='red'>$r[username]</span>";
		} else {

			$username = $r['username'];
		}
		
		$red++;

		$stars_link = ROOT.$lett.'/'.$opt1.'/'.$page.'/'.$r['username'].'/1';

		$s .= "$slika<p>$red | Корисник: <b>$username</b> | <b>$use</b> | <a href='".$stars_link."'><i class='fas fa-star ml-1 mr-1'></i><b>$r[stars]</b></a><br>$r[userdesc]</p><div class='clear'></div><br>";
	}

	$s .= Engine::Pagination($page, $num_page, 'clanovi');
} else {

	$s = "<p class='red'>Нема чланова!</p>";
}

$cont =
"
<section class='page-section mt-5' id='clanovi'>
<div class='container'>
<div class='text-center'>
<h2 class='page-section-heading text-secondary mb-0 d-inline-block'>ЧЛАНОВИ</h2>
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