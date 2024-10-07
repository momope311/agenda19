<?php
if(!defined('PROTECT')){die('Protected Content!');}

$error = '';

$authorid = Engine::UserId($_SESSION[SITE]['username']);

if (isset($_POST['submit'])) {
	
	if (empty($_POST['header']) OR empty($_POST['tekst'])) {
		
		$error = "<p class='red'>Попуните обавезна поља!</p>";
	} else {
		
		$comments = isset($_POST['comments']) ? 1 : 0;
		$error = Engine::Write($_POST['header'], $_POST['meta_desc'], $_POST['meta_key'], $_POST['meta_author'], $_POST['catid'], $_POST['tekst'], $authorid, $_POST['minview'], $comments);
	}
}

$selectbox = Engine::SelectBox('');

$cont =
"
<section class='page-section mt-5' id='pisi'>
<div class='container'>
<div class='text-center'>
<h2 class='page-section-heading text-secondary mb-0 d-inline-block'>ПИШИ</h2>
</div>
<div class='divider-custom'>
    <div class='divider-custom-line'></div>
    <div class='divider-custom-icon'><i class='fas fa-star'></i></div>
    <div class='divider-custom-line'></div>
</div>
$error
<form action='' method='post'>
	Наслов * :
	<input type='text' name='header' maxlength='128' placeholder='Наслов' class='form-control w-75 mt-2'>
	<br>
	<br>
	Мета-Опис (Ако ништа не унесете биће као наслов) :
	<input type='text' name='meta_desc' maxlength='128' placeholder='Мета Опис' class='form-control w-75 mt-2'>
	<br>
	<br>
	Мета-Кључне речи (Ако ништа не унесете биће празно) :
	<input type='text' name='meta_key' maxlength='128' placeholder='Мета Кључне речи' class='form-control w-75 mt-2'>
	<br>
	<br>
	Мета-Аутор (Ако ништа не унесете биће празно) :
	<input type='text' name='meta_author' maxlength='32' placeholder='Мета Аутор' class='form-control w-50 mt-2'>
	<br>
	<br>
	Категорија * :
	<select class='form-control w-50 mt-2' name='catid'>$selectbox</select>
	<br>
	<br>
	Предпреглед * :
	<input type='text' name='minview' class='form-control w-25 mt-2' value='400'>
	<br>
	<br>
	Коментари * : &nbsp; <input type='checkbox' name='comments' checked>
	<br>
	<br>
	Текст * :
	<br class='mb-2'>
	<textarea id='edit' name='tekst'></textarea><br>
	<input type='submit' name='submit' class='btn btn-primary btn-large-text mt-4' value='Потврди'>
</form>
<script src='".ROOT."engine/tinymce/tinymce.min.js'></script>
<script>
	tinymce.init({
		relative_urls : false,
		remove_script_host : true,
		document_base_url : '".ROOT."',
		content_css : '".ROOT.'views/templates/'.TEMP.'/css/styles.css'."',
		selector: 'textarea',
		height: 400,
		theme: 'modern',
		images_upload_url: '".ROOT."views/templates/ag19/inc/administrator/slike.php',
  		file_picker_types: 'image',
		plugins: [
		'advlist autolink lists link image charmap print preview hr anchor pagebreak',
		'searchreplace wordcount visualblocks visualchars code fullscreen',
		'insertdatetime media nonbreaking save table contextmenu directionality',
		'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
		],
		toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		toolbar2: 'preview media | forecolor backcolor emoticons | codesample',
		image_advtab: true,
		menubar: 'edit view insert format tools table',
		image_class_list: [
			{title: 'Poravnaj', value: 'slika'}
		],
  		content_style: 'body { padding: 10px; } .slika { width: 94%; max-width: 800px; height: auto; display: block; margin: auto; padding: 20px; }'
	});
</script>
</div>
</section>
";

?>