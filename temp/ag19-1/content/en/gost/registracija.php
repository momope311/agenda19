<?php
if(!defined('PROTECT')){die('Protected Content!');}

// Uključivanje potrebnih PHPMailer klasa
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class System extends AppConfig {

	public static function Registration($email) {
		
		global $lett;
		
		$max_regs = 4;

		if (isset($_COOKIE['max_regs'])) {
	        
	        $regs = $_COOKIE['max_regs'] + 1;

	        if ($regs > $max_regs) {
        		
        		die('You are currently blocked. Register Failed! Clear your entire browser history. And restart the browser.');
    		}
	    } else {

	    	$regs = 1;
	    }
		
		setcookie('max_regs', $regs, time() + (86400 * 5), "/");
		
		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {

			$link = new DB();
			
			$query = "INSERT INTO users(username, password, email, userdesc, session, usertype, slika, stars) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			$result = $link->InsertRow($query, ['Кандидат', '', $email, '', '', 'kandidat', '', 0]);
			
			// function sendEmail($toEmail, $toName, $subject, $htmlContent, $altContent)
			$to = $email;
			$name = explode('@', $email)[0];
			$subject = "Агенда19 - регистрација";

			$html_message =
			"<!DOCTYPE html>
			<html lang='sr'>
			<head>
			    <meta charset='UTF-8'>
			    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
			</head>
			<body style='font-family: Arial, sans-serif; font-size: 17px;'>
			    <section style='width: 80%; max-width: 600px; margin: 30px auto; background-color: #f7f7f7; padding: 8px 20px 8px 20px; border: 1px solid #ccc; border-radius: 20px; color: #2c3e50; text-align: center;'>
			        <h1 style='text-align: center; font-size: 28px; line-height: 1.4;'>Агенда19 Магазин</h1>
			        <h2 style='margin-top: 50px; margin-bottom: 20px; text-align: left; font-size: 24px;'>Здраво, $name</h2>
			        <h3 style='text-align: left; font-size: 20px;'>Регистрација</h3>
			        <p style='text-align: left;'>Успешно сте се регистровали.<br>
			        Сада морате да извршите уплату, то јест претплату на годину дана.</p>
			        <p style='text-align: left;'><a href='https://www.paypal.com/ncp/payment/HV6464FZFFYT4'>Уплата</a>
			        <br>
			        https://www.paypal.com/ncp/payment/HV6464FZFFYT4
			        </p>
			        <p>PayPal, Visa, Mastercard...</p>
			        <br><br><br>
			        <p style='font-size: 17px; text-align: left; padding-left: 20px; padding-right: 20px;'>Канцеларија Агенда19<br>kancelarija@agenda19.com</p>
			        <footer style='margin-top: 30px; text-align: center; font-size: 14px; color: #aaa;'>&copy; 2024 Агенда19. Сва права задржана.</footer>
			    </section>
			</body>
			</html>
			";

			$alt_message = 
			"
		    Agenda19 - registracija:\n
		    Uspesno ste se registrovali.
		    Sada morate da izvrsite uplatu, to jest pretplatu na godinu dana.\n
		    Agenda19
			";

			//if (sendEmail($to, $name, $subject, $html_message, $alt_message)) {

				//header('Location: https://www.paypal.com/ncp/payment/HV6464FZFFYT4');
				header("Location: ".URL.$lett.'/pretplata');
			//}
		} else {

			return "<p class='redcent'>Електронска пошта није валидна!</p>";
		}
	}

    public static function sendEmail($toEmail, $toName, $subject, $htmlContent, $altContent) {
        
        $host      = AppConfig::GetConfig('smtp_host');
        $username  = AppConfig::GetConfig('smtp_username');
        $password  = AppConfig::GetConfig('smtp_password');
        $fromEmail = AppConfig::GetConfig('email_from');
        $fromName  = AppConfig::GetConfig('email_from_name');

        // Kreiranje instance PHPMailer-a
        $mail = new PHPMailer(true);

        try {
            // SMTP konfiguracija
            $mail->isSMTP();
            $mail->Host       = $host;
            $mail->SMTPAuth   = true;
            $mail->Username   = $username;
            $mail->Password   = $password;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Ako vaš server koristi TLS
            $mail->Port       = 587;

            // Primaoci
            $mail->setFrom($this->fromEmail, $this->fromName);
            $mail->addAddress($toEmail, $toName); // Dodavanje primaoca

            // Sadržaj e-maila
            $mail->isHTML(true); // Postavljanje HTML formata
            $mail->CharSet = 'UTF-8';
            $mail->Subject = $subject;
            $mail->Body    = $htmlContent;
            $mail->AltBody = $altContent;

            // Slanje e-maila
            $mail->send();

            return true;
        } catch (Exception $e) {
            // Ako dođe do greške, vraćamo false
            return false;
        }
    }
}

$e = '';

if (isset($_POST['submit'])) {

	$email = $_POST['email'];
	
	if (empty($email)) {
		
		$e = "<p class='redcent'>Унесите вашу Електронску пошту!</p>";
	} else {
		
		$e = System::Registration($email);
	}
}

$content =
"
<section id='content'>
<h1 class='cent'>Регистрација</h1>
$e
<form action='' method='post' onsubmit='scrollToAnchor()'>
    <p class='cent'>
    И-мејл * :
    <br>
    <input type='text' name='email' maxlength='64' placeholder='Ваша електронска пошта' class='medinput'>
    <br>
    <input type='submit' name='submit' class='medbut' value='Прихвати'>
    </p>
</form>
</section>
";

?>