<?php
if(!defined('PROTECT')){die('Protected Content!');}

$e = '';
$s = '';

if (isset($_POST['submit'])) {

    $small_p = isset($_POST['small_p']) ? 1 : 0;

    if ($_FILES['photo']['name']) {

        if ($_FILES['photo']['size'] > (1024000)) {

            $e .= "<p class='red'>Слика је превелика. Треба бити мања од 1mb!</p>";
        } else {

            $imageFileType = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {

                $e .= "<p class='red'>Изгледа да фајл није слика!</p>";
            } else {

                $rand = rand(0, 100);

                $date = date("m-Y");

                if (!file_exists('content/img/'.$date)) {

                    mkdir('content/img/'.$date, 0777, true);
                }

                $filename = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", strtolower(basename($_FILES['photo']['name'])));
				$target = 'content/img/'.$date.'/'. $rand . $filename;
                
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

                if ($small_p == 1 && isset($image)) {

                    // Dimenzije originalne slike
                    list($width, $height) = getimagesize($target);

                    // Dimenzije male slike
                    $new_width_thumb = 350;
                    $new_height_thumb = round($new_width_thumb / 1.7); // Visina izračunata na osnovu širine i razmere 1.7

                    // Kreiranje prazne slike sa dimenzijama 350x206 (razmera 1.7)
                    $image_thumb = imagecreatetruecolor($new_width_thumb, $new_height_thumb);

                    // Prekopiraj originalnu sliku u novu sliku sa dimenzijama 350x206
                    imagecopyresampled($image_thumb, $image, 0, 0, 0, 0, $new_width_thumb, $new_height_thumb, $width, $height);

                    // Dodeljivanje novog imena za malu sliku (npr. dodajemo '_thumb')
                    $thumb_target = 'content/img/'.$date.'/'. 'thumb_' . $rand . $filename;

                    // Snimi malu sliku
                    if ($imageFileType == 'jpg' || $imageFileType == 'jpeg') {
                        imagejpeg($image_thumb, $thumb_target, 80); // 80 je kvaliteta
                    } elseif ($imageFileType == 'png') {
                        imagepng($image_thumb, $thumb_target);
                    } elseif ($imageFileType == 'gif') {
                        imagegif($image_thumb, $thumb_target);
                    }

                    // Oslobodi memoriju za malu sliku
                    imagedestroy($image_thumb);

                    $m = "Мала слика (за садржај) је успешно креирана и налази се овде: <br><b>$thumb_target</b><br><br>";
                } else {

                    $m = '';
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
                $m
                Копирајте путању слике, за каснију употребу.
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
Слика за <b>профилну</b> треба да буде 256x256 пиксела.<br>
Слика за <b>категорију</b> треба да буде 600x450 пиксела.<br>
Слика за <b>садржај</b> је 800x450 или већа, али сличне размере (1.7).
<br><br>
<p class='color1q'>Све слике су овде: <a href='".ROOT."content/img/'>".ROOT."content/img/</a></p>
$e
<form action='' method='post' enctype='multipart/form-data'>
    <div class='form-group'>
        <label for='photo'><br>Пошаљите вашу слику:</label>
        <input type='file' name='photo' id='photo' class='form-control-file'>
    </div>
    Креирај и малу слику за садржај <input type='checkbox' id='remember' name='small_p' class='form-check-input ml-2 mt-2' checked><br><br>
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