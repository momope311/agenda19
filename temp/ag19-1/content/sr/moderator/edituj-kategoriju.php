<?php
if(!defined('PROTECT')){die('Protected Content!');}

$s = '';
$e = '';

if ($opt3 != '') {
	
	$link = new DB();
	
	$query = "SELECT * FROM categories WHERE catseo = ?";
	$result = $link->GetRow($query, [$opt3]);
	
	if ($result) {
		
		if (isset($_POST['submit'])) {
			
			if (empty($_POST['catname']) OR empty($_POST['opis']) OR empty($_POST['image'])) {
		
				$e = "<p class='red'>Попуните поља!</p>";
			} else {
				
				$e = Engine::EditCategory($result['catid'], $_POST['catname'], $_POST['meta_desc'], $_POST['meta_key'], $_POST['meta_author'], $result['catname'], $_POST['opis'], $_POST['image']);
			}
		}
		
		$s =
		"
		<form action='' method='post'>
		Име категорије * :
		<input type='text' name='catname' maxlength='64' placeholder='Име категорије' class='form-control w-50 mt-2' value='$result[catname]'>
		<br>
		<br>
		Мета-Опис (Ако ништа не унесете биће као наслов) :
		<input type='text' name='meta_desc' maxlength='128' placeholder='Мета Опис' class='form-control w-50 mt-2' value='$result[meta_desc]'>
		<br>
		<br>
		Мета-Кључне речи (Ако ништа не унесете биће празно) :
		<input type='text' name='meta_key' maxlength='128' placeholder='Мета Кључне речи' class='form-control w-50 mt-2' value='$result[meta_key]'>
		<br>
		<br>
		Мета-Аутор (Ако ништа не унесете биће празно) :
		<input type='text' name='meta_author' maxlength='32' placeholder='Мета Аутор' class='form-control w-50 mt-2' value='$result[meta_author]'>
		<br>
		<br>
		Опис * :
		<textarea class='form-control w-50 mt-2 fonter' name='opis' maxlength='200' placeholder='Опис (200 карактера)'>$result[catdesc]</textarea>
		<br>
		<br>
		Путања до слике (Најбоље: 600x450) * :
		<input type='text' name='image' maxlength='128' placeholder='Путања до слике' class='form-control w-50 mt-2' value='$result[image]'>
		<br>
		<input type='submit' name='submit' class='btn btn-primary btn-large-text' value='Потврди'>
		</form>
		";
	} else {
		
		$e = "<p class='red'>Нема те категорије!</p>";
	}
} else {
	
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
			
			$s .= "<p><a href='".ROOT.$lett."/edituj-kategoriju/".$page.'/'.$r['catseo']."'><b>$r[catid]</b> | $r[catname] | $r[catseo]</a></p>";
		}
		
		$s .= Engine::Pagination($page, $num_page, 'edituj-kategoriju');
	} else {
		
		$s = "<p class='red'>Нема те категорије!</p>";
	}
}

$cont =
"
<section class='page-section mt-5' id='edituj-kategoriju'>
<div class='container'>
<div class='text-center'>
<h2 class='page-section-heading text-secondary mb-0 d-inline-block'>ЕДИТУЈ КАТЕГОРИЈУ</h2>
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