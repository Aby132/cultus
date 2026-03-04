<?php
require_once __DIR__ . '/env.php';
require_once __DIR__ . '/PHPMailer/Exception.php';
require_once __DIR__ . '/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Creates and returns a pre-configured PHPMailer instance ready to use Gmail SMTP.
 */
function createMailer(): PHPMailer {
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host       = $_ENV['MAIL_HOST']     ?? 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV['MAIL_USERNAME']  ?? '';
    $mail->Password   = $_ENV['MAIL_PASSWORD']  ?? '';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = (int)($_ENV['MAIL_PORT'] ?? 587);
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom(
        $_ENV['MAIL_USERNAME'] ?? '',
        $_ENV['MAIL_FROM_NAME'] ?? 'Cultus India'
    );

    return $mail;
}
