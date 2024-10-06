<?php
if(!defined('PROTECT')){die('Protected Content!');}

$e = '';

if (isset($_POST['submit'])) {

	$email = $_POST['email'];
	
	if (empty($email)) {
		
		$e = "<p class='redcent'>Унесите вашу Електронску пошту!</p>";
	} else {
		
		$e = Engine::Registration($email);
	}
}

$poruka1 = "<p>Унесите ваш Имејл и стићи ће вам подаци за пријаву.</p>";

/*"<p>Унесите ваш имејл и стићи ће вам обавештење. Такође, бићете преусмерени на линк за претплату.<br>
    Кад завршите цео процес, на имејл ће вам стићи подаци за пријаву на сајт.</p>";
*/

$poruka2 = '';

/*"<br><br><br><p>
За нестрпљиве: <a href='https://www.paypal.com/ncp/payment/HV6464FZFFYT4'>PayPal, platne kartice...</a><br><br>
Ако имате проблема или питања у вези претплате,<br>пошаљите поруку на наш имејл:<br>
kancelarija@agenda19.com
</p>";
*/

$cont =
"
<section class='page-section mt-5' id='registracija'>
<div class='container text-center'>
<div class='text-center'>
<h2 class='page-section-heading text-secondary mb-0 d-inline-block'>Регистрација</h2>
</div>
<div class='divider-custom'>
    <div class='divider-custom-line'></div>
    <div class='divider-custom-icon'><i class='fas fa-star'></i></div>
    <div class='divider-custom-line'></div>
</div>
$e
<form action='' method='post'>
    <br>
    $poruka1
    Имејл * :
    <br>
    <div class='d-flex justify-content-center'>
        <input type='text' name='email' maxlength='64' placeholder='Електронска пошта' class='form-control w-50 mt-2 min1'>
    </div>
    <br>
    <input type='submit' name='submit' class='btn btn-primary btn-large-text' value='Потврди'>
</form>
$poruka2
</div>
</section>
";

?>