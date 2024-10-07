<?php
if(!defined('PROTECT')){die('Protected Content!');}

$e = '';
$s = '';

if (isset($_POST['submit'])) {

    if ($_FILES['photo']['name']) {

        if ($_FILES['photo']['size'] > (1024000)) {

            $e .= "<p class='red'>Слика је превелика. Треба бити мања од 1mb!</p>";
        } else {

            $imageFileType = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {

                $e .= "<p class='red'>Изгледа да фајл није слика!</p>";
            } else {

                $rand = rand(0, 100);

                if (!file_exists('content/img/members')) {

                    mkdir('content/img/members', 0777, true);
                }

                $filename = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", strtolower(basename($_FILES['photo']['name'])));
				$target = 'content/img/members/' . $rand . $filename;
                
                move_uploaded_file($_FILES['photo']['tmp_name'], $target);

                // Otvaranje originalne slike u zavisnosti od tipa
                if ($imageFileType == 'jpg' || $imageFileType == 'jpeg') {
                    $image = imagecreatefromjpeg($target);
                } elseif ($imageFileType == 'png') {
                    $image = imagecreatefrompng($target);
                } elseif ($imageFileType == 'gif') {
                    $image = imagecreatefromgif($target);
                } else {
                    $e .= "<p class='red'>Грешка при обради слике!</p>";
                }

                // Oslobodi memoriju za originalnu sliku
                if (isset($image)) {
                    imagedestroy($image);
                }

                $e .= 
                "<p>Слика је успешно послата и налази се овде:
                <br>
                <b>$target</b>
                <br>
                <br>
                Копирајте путању слике, за профилну.
                </p>";
            }
        }
    }
}

$s .= 
"
<br><br>
Прво средите вашу слику. Не сме бити већа од 1 мегабајт. Димензије, исто тако не би требало да буду велике.
<br>
Слика за <b>профилну</b> требало би да буде 256x256 пиксела.<br>
<br><br>
<p class='color1q'>Слике свих чланова су овде: <a href='".ROOT."content/img/members/'>".ROOT."content/img/members/</a></p>
$e
<form action='' method='post' enctype='multipart/form-data'>
    <div class='form-group'>
        <label for='photo'><br>Пошаљите вашу слику:</label>
        <input type='file' name='photo' id='photo' class='form-control-file'>
    </div>
    <button type='submit' name='submit' class='btn btn-primary mt-3 btn-large-text'>Пошаљи</button>
</form>
";

$cont =
"
<section class='page-section mt-5' id='slike'>
<div class='container'>
<div class='text-center'>
<h2 class='page-section-heading text-secondary mb-0 d-inline-block'>СЛИКЕ</h2>
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