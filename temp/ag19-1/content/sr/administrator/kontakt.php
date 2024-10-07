<?php
if(!defined('PROTECT')){die('Protected Content!');}

$e = '';

if (isset($_POST['submit'])) {
    
    $username   = $_POST['username'];
    $naslov     = $_POST['naslov'];
    $poruka     = $_POST['poruka'];
    
    if (empty($username) OR empty($naslov) OR empty($poruka)) {
        
        $e = "<p class='red'>Попуните поља!</p>";
    } else {
        
        $e = Engine::Contact($username, $naslov, $poruka);
    }
}

$cont =
"
<section class='page-section mt-5' id='kontakt'>
<div class='container'>
<div class='text-center'>
<h2 class='page-section-heading text-secondary mb-0 d-inline-block'>КОНТАКТ</h2>
</div>
<div class='divider-custom'>
    <div class='divider-custom-line'></div>
    <div class='divider-custom-icon'><i class='fas fa-star'></i></div>
    <div class='divider-custom-line'></div>
</div>
$e
<form action='' method='post'>
Корисничко име * :
<input type='text' name='username' maxlength='20' placeholder='Корисник' class='form-control w-25 mt-2'>
<br>
<br>
Наслов имејла * :
<input type='text' name='naslov' maxlength='128' placeholder='Наслов поруке' class='form-control w-50 mt-2'>
<br>
<br>
Порука * :
<textarea class='form-control w-50 mt-2 fonter' name='poruka' maxlength='200' placeholder='Порука (200 карактера)'></textarea>
<br>
<input type='submit' name='submit' class='btn btn-primary btn-large-text' value='Пошаљи'>
</form>
</div>
</section>
";

?>