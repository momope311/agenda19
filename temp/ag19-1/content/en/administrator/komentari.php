<?php
if(!defined('PROTECT')){die('Protected Content!');}

$s = '';

$link = new DB();

if (isset($_POST['submit'])) {

	$comid = $_POST['comid'];

	if (!empty($comid)) {
		
		$query = "UPDATE comments SET pub = 1 WHERE comid = ?";
		$result = $link->UpdateRow($query, [$comid]);
		
		$s .= "<p class='green'>Коментар је објављен!</p>";
	}
}

if (isset($_POST['submit1'])) {

	$comid = $_POST['comid'];

	if (!empty($comid)) {
		
		$query = "UPDATE comments SET pub = 0 WHERE comid = ?";
		$result = $link->UpdateRow($query, [$comid]);

		$s .= "<p class='red'>Коментар је уклоњен!</p>";
	}
}

if (isset($_POST['submit2'])) {

	$comid = $_POST['comid'];

	if (!empty($comid)) {
		
		$query = "DELETE FROM comments WHERE comid = ?";
		$result = $link->UpdateRow($query, [$comid]);

		$s .= "<p class='red'>Коментар је избрисан!</p>";
	}
}

$query1 = "SELECT COUNT(*) FROM comments";
$count = $link->GetRow($query1);

$total = ($count['COUNT(*)']);

if ($total > 0) {
	
	$limit = 30;
	$page = ($opt2 != '') ? $opt2 : 1;
	$start = $limit * ($page-1);
	$num_page = ceil($total/$limit);
	
	$query = "SELECT * FROM comments ORDER BY comid DESC LIMIT $start, $limit";
	$result = $link->GetRows($query);

	foreach ($result as $r) {
		
		if ($r['pub'] == 0) {

			$e = "<span class='red'>Коментар није приказан!</span>";
		} else {

			$e = "<span class='green'>Коментар је приказан!</span>";
		}

		$s.= "<p><b>$r[comid]</b> | <b>$r[name]</b><br>$r[comment] | $e</p>";
	}
	
	$s .=
	"
	<form action='' method='post'>
	Унеси ИД број коментара који желите да буде видљив:
	<br>
	<br>
	ИД:
	<input type='text' name='comid' class='form-control w-25 mt-2'>
	<br>
	<input type='submit' name='submit' class='btn btn-primary btn-large-text' value='Објави'>
	</form>
	<br>
	<form action='' method='post'>
	Унеси ИД број коментара који желите да склоните:
	<br>
	<br>
	ИД:
	<input type='text' name='comid' class='form-control w-25 mt-2'>
	<br>
	<input type='submit' name='submit1' class='btn btn-primary btn-large-text' value='Уклони'>
	</form>
	<br>
	<br>
	<h2>Избриши коментар</h2>
	<form action='' method='post'>
	Унеси ИД број коментара који желите да избришете:
	<br>
	<br>
	ИД:
	<input type='text' name='comid' class='form-control w-25 mt-2'>
	<br>
	<input type='submit' name='submit2' class='btn btn-primary btn-large-text' value='Избриши'>
	</form>
	";

	$s .= Engine::Pagination($page, $num_page, 'komentari');
} else {

	$s = "<p class='red'>Нема коментара!</p>";
}

$cont =
"
<section class='page-section mt-5' id='komentari'>
<div class='container'>
<div class='text-center'>
<h2 class='page-section-heading text-secondary mb-0 d-inline-block'>КОМЕНТАРИ</h2>
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