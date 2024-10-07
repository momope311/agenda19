<?php
if(!defined('PROTECT')){die('Protected Content!');}

// Uključivanje PHPMailer klasa
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EM extends AppConfig {

    // Propertiji za konfiguraciju
    private $host;
    private $username;
    private $password;
    private $fromEmail;
    private $fromName;

    // Konstruktor klase
    public function __construct() {
        // Učitavanje konfiguracionih podataka putem AppConfig::GetConfig($key)
        $this->host      = AppConfig::GetConfig('smtp_host');
        $this->username  = AppConfig::GetConfig('smtp_username');
        $this->password  = AppConfig::GetConfig('smtp_password');
        $this->fromEmail = AppConfig::GetConfig('email_from');
        $this->fromName  = AppConfig::GetConfig('email_from_name');
    }

    // Metoda za slanje emaila
    public function sendEmail($toEmail, $toName, $subject, $htmlContent, $altContent) {

        // Uključivanje potrebnih PHPMailer klasa
        require 'PHPMailer/src/Exception.php';
        require 'PHPMailer/src/PHPMailer.php';
        require 'PHPMailer/src/SMTP.php';

        // Kreiranje instance PHPMailer-a
        $mail = new PHPMailer(true);

        try {
            // SMTP konfiguracija
            $mail->isSMTP();
            $mail->Host       = $this->host;
            $mail->SMTPAuth   = true;
            $mail->Username   = $this->username;
            $mail->Password   = $this->password;
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

?>