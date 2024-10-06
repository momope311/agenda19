<?php
if(!defined('PROTECT')){die('Protected Content!');}

function sendEmail($toEmail, $toName, $subject, $htmlContent, $altContent) {
    
    // Uključivanje potrebnih PHPMailer klasa
    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    // Kreiranje instance PHPMailer-a
    $mail = new PHPMailer\PHPMailer\PHPMailer();

    try {
        // SMTP konfiguracija
        $mail->isSMTP();
        $mail->Host       = 'mail.agenda19.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'bot@agenda19.com'; // Vaš username
        $mail->Password   = "E5w#%MhLK'K*2QJ";    // Vaša lozinka
        $mail->SMTPSecure = PHPMailer\PHPMailer\PHPMailer::ENCRYPTION_STARTTLS; // Ako vaš server koristi TLS
        $mail->Port       = 587;

        // Primaoci
        $mail->setFrom('bot@agenda19.com', 'Agenda19');
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
    } catch (PHPMailer\PHPMailer\Exception $e) {
        
        return false;
    }
}

/* Primer poziva funkcije
echo sendEmail(
    'momope311@gmail.com',      // Email primaoca
    'Recipient Name',           // Ime primaoca
    'Naslov vašeg emaila',      // Naslov
    '<h1>Ovo je HTML poruka</h1><p>Ovo je sadržaj e-maila.</p>', // HTML sadržaj
    'Ovo je plain-text verzija poruke za klijente koji ne podržavaju HTML.' // Plain-text sadržaj
);
*/

?>