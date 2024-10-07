<?php
if(!defined('PROTECT')){die('Protected Content!');}

$s = '';
$e = '';

if (isset($_POST['submit'])) {

    $userid = $_POST['userid'];
    $usertype = $_POST['usertype'];

    $e = Engine::Candidates($userid, $usertype);
}

if (isset($_POST['submit2'])) {

    $userid = $_POST['userid'];

    $e = Engine::Candidates($userid, 'brisanje');
}

$link = new DB();
$query = "SELECT * FROM users WHERE ((usertype = 'kandidat') OR (usertype = 'blokiran')) ORDER BY userid ASC";
$result = $link->GetRows($query);

$s .= 
"
<form action='' method='post'>
ИД * :
<input type='text' name='userid' maxlength='100' placeholder='Ид број' class='form-control w-25 mt-2'>
<select class='form-control w-25 mt-4' name='usertype'>
    <option value='novajlija'>Новајлија</option>
    <option value='clan'>Члан</option>
    <option value='harambasa'>Харамбаша</option>
    <option value='autor'>Аутор</option>
    <option value='moderator'>Модератор</option>
    <option value='administrator'>Администратор</option>
</select>
<input type='submit' name='submit' class='btn btn-primary btn-large-text mt-4' value='Креирај корисника'>
</form>
<br><br>
<form action='' method='post'>
ИД * :
<input type='text' name='userid' maxlength='100' placeholder='Ид број' class='form-control w-25 mt-2'>
<input type='submit' name='submit2' class='btn btn-primary btn-large-text mt-4' value='Избриши кандидата'>
</form>
<br><br>
";

if ($result) {
    
    foreach ($result as $index => $r) {

        $s .= "<p><b>$r[userid]</b> | Корисник: <b>$r[email]</b> | Тип корисника: <b>$r[usertype]</b></p><div class='clear'></div>";
    }
} else {

    $s = "<p class='red'>Нема кандидата!</p>";
}

$cont =
"
<section class='page-section mt-5' id='kandidati'>
<div class='container'>
<div class='text-center'>
<h2 class='page-section-heading text-secondary mb-0 d-inline-block'>КАНДИДАТИ</h2>
</div>
<div class='divider-custom'>
    <div class='divider-custom-line'></div>
    <div class='divider-custom-icon'><i class='fas fa-star'></i></div>
    <div class='divider-custom-line'></div>
</div>
<br><br>
$e
$s
</div>
</section>
";

?>