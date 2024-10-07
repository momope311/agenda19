<?php
if(!defined('PROTECT')){die('Protected Content!');}

$e = '';

if (isset($_POST['submit'])) {
	
	$catid = $_POST['catid'];
	
	$link = new DB();
	$query = "SELECT COUNT(*) as count FROM articles WHERE catid = ?";
	$result1 = $link->GetRow($query, [$catid]);
	
	if ($result1['count']) {
		
		$e = 
		"<p class='red'>
		Та категорија није празна и не можете да је избришете!
		<br>
		Категорија садржи: <b>$result1[count]</b> чланак/а!
		</p>
		";
	} else {
		
		$query = "DELETE FROM categories WHERE catid = ?";
		$result = $link->DeleteRow($query, [$catid]);
		
		if ($result) {
			
			header('Location: '.URL.$lett.'/info/category-delete-success');
		} else {
			
			$e = "<p class='red'>Нема те категорије!</p>";
		}
	}
}

$s = '';

$link = new DB();
	
$query1 = "SELECT COUNT(*) FROM categories";
$count = $link->GetRow($query1);

$total = ($count['COUNT(*)']);

if ($total > 0) {
	
	$limit = 30;
	$page = ($opt2 != '') ? $opt2 : 1;
	$start = $limit * ($page-1);
	$num_page = ceil($total/$limit);

	$query = "SELECT * FROM categories ORDER BY catid DESC LIMIT $start, $limit";
	$result = $link->GetRows($query);

	foreach ($result as $r) {
		
		$s .= "<p><b>$r[catid]</b> | $r[catname] | $r[catseo]</p>";
	}

	$s .=
	"
	<form action='' method='post'>
	Унеси ИД број категорије коју желиш да избришеш:
	<br>
	<br>
	ИД:
	<input type='text' name='catid' class='form-control w-25 mt-2'>
	<br>
	<input type='submit' name='submit' class='btn btn-primary btn-large-text' value='Избриши'>
	</form>
	";

	$s .= Engine::Pagination($page, $num_page, 'izbrisi-kategoriju');
} else {
	
	$s = "<p class='red'>Нема категорија!</p>";
}

$cont =
"
<section class='page-section mt-5' id='izbrisi-kategoriju'>
<div class='container'>
<div class='text-center'>
<h2 class='page-section-heading text-secondary mb-0 d-inline-block'>ИЗБРИШИ КАТЕГОРИЈУ</h2>
</div>
<div class='divider-custom'>
    <div class='divider-custom-line'></div>
    <div class='divider-custom-icon'><i class='fas fa-star'></i></div>
    <div class='divider-custom-line'></div>
</div>
<p>Можете избрисати само категорију, која нема своје чланке!</p>
$e
$s
</div>
</section>
";

?>