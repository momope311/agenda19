<?php
if(!defined('PROTECT')){die('Protected Content!');}

$e = '';

if (isset($_POST['submit'])) {
	
	$catname 		= $_POST['catname'];
	$meta_desc 		= $_POST['meta_desc'];
	$meta_key 		= $_POST['meta_key'];
	$meta_author 	= $_POST['meta_author'];
	$opis 			= $_POST['opis'];
	$image 			= $_POST['image'];
	
	if (empty($catname) OR empty($opis) OR empty($image)) {
		
		$e = "<p class='red'>Попуните поља!</p>";
	} else {
		
		$e = Engine::AddCategory($catname, $meta_desc, $meta_key, $meta_author, $opis, $image);
	}
}

$cont =
"
<section class='page-section mt-5' id='dodaj-kategoriju'>
<div class='container'>
<div class='text-center'>
<h2 class='page-section-heading text-secondary mb-0 d-inline-block'>ДОДАЈ КАТЕГОРИЈУ</h2>
</div>
<div class='divider-custom'>
    <div class='divider-custom-line'></div>
    <div class='divider-custom-icon'><i class='fas fa-star'></i></div>
    <div class='divider-custom-line'></div>
</div>
$e
<form action='' method='post'>
Име категорије * :
<input type='text' name='catname' maxlength='64' placeholder='Име категорије' class='form-control w-50 mt-2'>
<br>
<br>
Мета-Опис (Ако ништа не унесете биће као наслов) :
<input type='text' name='meta_desc' maxlength='128' placeholder='Мета Опис' class='form-control w-50 mt-2'>
<br>
<br>
Мета-Кључне речи (Ако ништа не унесете биће празно) :
<input type='text' name='meta_key' maxlength='128' placeholder='Мета Кључне речи' class='form-control w-50 mt-2'>
<br>
<br>
Мета-Аутор (Ако ништа не унесете биће празно) :
<input type='text' name='meta_author' maxlength='32' placeholder='Мета Аутор' class='form-control w-50 mt-2'>
<br>
<br>
Опис * :
<textarea class='form-control w-50 mt-2 fonter' name='opis' maxlength='200' placeholder='Опис (200 карактера)'></textarea>
<br>
<br>
Путања до слике (Најбоље: 600x450) * :
<input type='text' name='image' maxlength='128' placeholder='Путања до слике' class='form-control w-50 mt-2'>
<br>
<input type='submit' name='submit' class='btn btn-primary btn-large-text' value='Потврди'>
</form>
</div>
</section>
";

?>