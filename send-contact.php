<?php
/**
 * send-contact.php — AJAX endpoint for the Contact Us form
 * Returns JSON: {"success": true/false, "message": "..."}
 */
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
    exit;
}

require_once __DIR__ . '/includes/env.php';
require_once __DIR__ . '/includes/PHPMailer/Exception.php';
require_once __DIR__ . '/includes/PHPMailer/PHPMailer.php';
require_once __DIR__ . '/includes/PHPMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$name    = trim(strip_tags($_POST['name']    ?? ''));
$email   = trim(strip_tags($_POST['email']   ?? ''));
$subject = trim(strip_tags($_POST['subject'] ?? ''));
$message = trim(strip_tags($_POST['message'] ?? ''));

if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}

$subjectLabels = [
    'lightning' => 'Lightning Protection Inquiry',
    'garments'  => 'Garments Export Inquiry',
    'trade'     => 'Import/Export Services',
    'general'   => 'General Inquiry',
];
$subjectLabel = $subjectLabels[$subject] ?? ucfirst($subject);

$toEmail   = $_ENV['MAIL_TO']        ?? 'escoltrix1@gmail.com';
$fromEmail = $_ENV['MAIL_USERNAME']  ?? 'escoltrix1@gmail.com';
$fromName  = $_ENV['MAIL_FROM_NAME'] ?? 'Cultus India';

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host         = $_ENV['MAIL_HOST'] ?? 'smtp.gmail.com';
    $mail->SMTPAuth     = true;
    $mail->Username     = $fromEmail;
    $mail->Password     = $_ENV['MAIL_PASSWORD'] ?? '';
    $mail->SMTPSecure   = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port         = (int)($_ENV['MAIL_PORT'] ?? 587);
    $mail->CharSet      = 'UTF-8';
    $mail->Timeout      = 10;          // faster fail if SMTP unreachable
    $mail->SMTPKeepAlive = true;       // reuse TCP connection for both emails

    $mail->setFrom($fromEmail, $fromName);

    // ── Business notification ──
    $mail->addAddress($toEmail, 'Cultus India');
    $mail->addReplyTo($email, $name);
    $mail->Subject = "Contact: $subjectLabel — $name";
    $mail->isHTML(true);
    $mail->Body = "
<html><body style='font-family:Arial,sans-serif;color:#333;max-width:600px;margin:0 auto;'>
  <div style='background:#1a1a2e;padding:20px 30px;border-radius:8px 8px 0 0;'>
    <h2 style='color:#fff;margin:0;'>&#128236; New Contact Message</h2>
  </div>
  <div style='background:#f9f9f9;padding:25px 30px;border-radius:0 0 8px 8px;border:1px solid #eee;'>
    <table style='width:100%;border-collapse:collapse;'>
      <tr><td style='padding:8px 0;font-weight:bold;color:#555;width:130px;'>Name</td><td>" . htmlspecialchars($name) . "</td></tr>
      <tr><td style='padding:8px 0;font-weight:bold;color:#555;'>Email</td><td><a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></td></tr>
      <tr><td style='padding:8px 0;font-weight:bold;color:#555;'>Subject</td><td>" . htmlspecialchars($subjectLabel) . "</td></tr>
    </table>
    <hr style='margin:20px 0;border:none;border-top:1px solid #ddd;'>
    <h4 style='color:#555;margin-bottom:8px;'>Message</h4>
    <p style='line-height:1.7;background:#fff;padding:15px;border-radius:6px;border:1px solid #e0e0e0;'>" . nl2br(htmlspecialchars($message)) . "</p>
    <p style='color:#aaa;font-size:12px;margin-top:20px;'>Sent via cultusindia.com</p>
  </div>
</body></html>";
    $mail->AltBody = "Name: $name\nEmail: $email\nSubject: $subjectLabel\n\nMessage:\n$message";
    $mail->send();

    // ── Confirmation to sender (same SMTP connection) ──
    $mail->clearAddresses();
    $mail->clearReplyTos();
    $mail->addAddress($email, $name);
    $mail->addReplyTo($fromEmail, $fromName);
    $mail->Subject = "We received your message — Cultus India";
    $mail->Body = "
<html><body style='font-family:Arial,sans-serif;color:#333;max-width:600px;margin:0 auto;'>
  <div style='background:#1a1a2e;padding:20px 30px;border-radius:8px 8px 0 0;'>
    <h2 style='color:#fff;margin:0;'>Thank you, " . htmlspecialchars($name) . "!</h2>
  </div>
  <div style='background:#f9f9f9;padding:25px 30px;border-radius:0 0 8px 8px;border:1px solid #eee;'>
    <p>We've received your message and will get back to you within <strong>1 business day</strong>.</p>
    <hr style='margin:20px 0;border:none;border-top:1px solid #ddd;'>
    <p style='color:#aaa;font-size:12px;'>Cultus India &mdash; Pala, Kerala 686575</p>
  </div>
</body></html>";
    $mail->AltBody = "Hi $name,\n\nWe received your message and will respond within 1 business day.\n\n— Cultus India";
    $mail->send();

    $mail->smtpClose(); // explicitly close after we're done

    echo json_encode(['success' => true, 'message' => "Thank you, $name! Your message has been sent. We'll get back to you within 1 business day."]);

} catch (Exception $e) {
    error_log('Contact mail error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Failed to send. Please email us at escoltrix1@gmail.com']);
}
exit;
