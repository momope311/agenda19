<?php
if(!defined('PROTECT')){die('Protected Content!');}

$s = '';

$link = new DB();
	
$query1 = "SELECT COUNT(*) FROM articles WHERE year(datum) = ? AND month(datum) = ?";
$count = $link->GetRow($query1, [$opt2, $opt3]);

$total = ($count['COUNT(*)']);

if ($total > 0) {
	
	$limit = 30;
	$page = ($opt4 != '') ? $opt4 : 1;
	$start = $limit * ($page-1);
	$num_page = ceil($total/$limit);
	
	$query = "SELECT * FROM articles WHERE year(datum) = ? AND month(datum) = ? ORDER BY artid DESC LIMIT $start, $limit";
	$result = $link->GetRows($query, [$opt2, $opt3]);

	foreach ($result as $r) {
				
		if ($r['comments'] == 0) {
			
			$co = "<i class='fas fa-comment-slash ml-3'></i>";
		} else {

			$queryc = "SELECT COUNT(*) FROM comments WHERE artid = ? AND pub = 1";
			$resultc = $link->GetRow($queryc, [$r['artid']]);

			$tot = $resultc['COUNT(*)'];

			$co = "<i class='fas fa-comment ml-3 mr-1'></i><b>".$tot."</b>";
		}

		$date = explode('-', $r['datum']);
		$date = $date[2].'.'.$date[1].'.'.$date[0];

		$string = mb_substr(strip_tags($r['tekst'], '<img>'), 0, $r['minview'], 'utf-8');

		$cat = Engine::CatName($r['catid']);

		$catseo = Engine::CatSeo($r['catid']);
		
		$author = Engine::Author($r['authorid']);

		$s .= 
		"
		<h2><a href='".ROOT.$lett."/clanak/".$r['seo']."'>$r[header]</a></h2>
		<p><i class='fas fa-calendar-alt ml-3 mr-1'></i><b>$date</b><i class='fas fa-hashtag ml-3 mr-1'></i><a href='".ROOT.$lett."/kategorija/".$catseo."'><b>$cat</b></a><i class='fas fa-at ml-3 mr-1'></i><a href='".ROOT.$lett."/clanci-od-korisnika/".$author."'><b>$author</b></a><i class='far fa-eye ml-3 mr-1'></i><b>$r[pregledi]</b>$co</p>
		<p class='porav'>".$string." ... <a href='".ROOT.$lett."/clanak/".$r['seo']."'>Прочитај више</a></p>
		<br>
		";
	}
	
	$s .= Engine::Pagination($page, $num_page, 'arhiva-za/'.$opt2.'/'.$opt3);
} else {
	
	$s = "<p class='red'>Нема чланака!</p>";
}

$cont =
"
<section class='page-section mt-5' id='arhiva-za'>
<div class='container'>
<div class='text-center'>
<h2 class='page-section-heading text-secondary mb-0 d-inline-block'>Архива за: $opt2 / $opt3</h2>
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