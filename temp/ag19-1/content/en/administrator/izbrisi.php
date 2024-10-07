<?php
if(!defined('PROTECT')){die('Protected Content!');}

$e = '';

$authorid = Engine::UserId($_SESSION[SITE]['username']);
	
if (isset($_POST['submit'])) {
	
	$id = $_POST['id'];
	
	$link = new DB();

	$query = "DELETE FROM articles WHERE artid = ?";
	$result = $link->DeleteRow($query, [$id]);

	if ($result) {
		
		header('Location: '.URL.$lett.'/info/delete-success');
	} else {
		
		$e = "<p class='red'>Нема тог чланка!</p>";
	}
}

$s = '';

$link = new DB();
	
$query1 = "SELECT COUNT(*) FROM articles";
$count = $link->GetRow($query1);

$total = ($count['COUNT(*)']);

if ($total > 0) {	
	
	$limit = 30;
	$page = ($opt2 != '') ? $opt2 : 1;
	$start = $limit * ($page-1);
	$num_page = ceil($total/$limit);

	$query = "SELECT * FROM articles ORDER BY artid DESC LIMIT $start, $limit";
	$result = $link->GetRows($query);

	foreach ($result as $r) {
		
		$s .= "<p><b>$r[artid]</b> | $r[header] | $r[seo]</p>";
	}

	$s .=
	"
	<form action='' method='post'>
	Унеси ИД број чланка који желиш да избришеш:
	<br>
	<br>
	ИД: <input type='text' name='id' class='form-control w-25 mt-2 mb-4'>
	<input type='submit' name='submit' class='btn btn-primary btn-large-text' value='Избриши'>
	</form>
	";

	$s .= Engine::Pagination($page, $num_page, 'izbrisi');
} else {
	
	$s = "<p class='red'>Нема чланака!</p>";
}

$ddd = '';

$cont =
"
<section class='page-section mt-5' id='izbrisi'>
<div class='container'>
<div class='text-center'>
<h2 class='page-section-heading text-secondary mb-0 d-inline-block'>Избриши $ddd чланак</h2>
</div>
<div class='divider-custom'>
    <div class='divider-custom-line'></div>
    <div class='divider-custom-icon'><i class='fas fa-star'></i></div>
    <div class='divider-custom-line'></div>
</div>
$e
$s
</div>
</section>
";

?>