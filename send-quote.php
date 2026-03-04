<?php
/**
 * send-quote.php — AJAX endpoint for the Quote Request form
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

$fullName     = trim(strip_tags($_POST['fullName']     ?? ''));
$company      = trim(strip_tags($_POST['company']      ?? ''));
$email        = trim(strip_tags($_POST['email']        ?? ''));
$phone        = trim(strip_tags($_POST['phone']        ?? ''));
$country      = trim(strip_tags($_POST['country']      ?? ''));
$requirements = trim(strip_tags($_POST['requirements'] ?? ''));
$service      = trim(strip_tags($_POST['service']      ?? ''));

if (empty($fullName) || empty($email) || empty($phone) || empty($country) || empty($requirements)) {
    echo json_encode(['success' => false, 'message' => 'Please fill in all required fields.']);
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Please enter a valid email address.']);
    exit;
}

$serviceLabels = [
    'lightning' => 'Lightning Protection',
    'garments'  => 'Garments Export',
    'trade'     => 'Import / Export Services',
];
$serviceLabel   = $serviceLabels[$service] ?? ($service ?: 'Not selected');
$companyDisplay = $company ?: 'Not provided';

$toEmail   = $_ENV['MAIL_TO']        ?? 'escoltrix1@gmail.com';
$fromEmail = $_ENV['MAIL_USERNAME']  ?? 'escoltrix1@gmail.com';
$fromName  = $_ENV['MAIL_FROM_NAME'] ?? 'Cultus India';

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host          = $_ENV['MAIL_HOST'] ?? 'smtp.gmail.com';
    $mail->SMTPAuth      = true;
    $mail->Username      = $fromEmail;
    $mail->Password      = $_ENV['MAIL_PASSWORD'] ?? '';
    $mail->SMTPSecure    = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port          = (int)($_ENV['MAIL_PORT'] ?? 587);
    $mail->CharSet       = 'UTF-8';
    $mail->Timeout       = 10;         // faster fail if SMTP unreachable
    $mail->SMTPKeepAlive = true;       // reuse TCP connection for both emails

    $mail->setFrom($fromEmail, $fromName);

    // ── Business quote notification ──
    $mail->addAddress($toEmail, 'Cultus India');
    $mail->addReplyTo($email, $fullName);
    $mail->Subject = "Quote: $serviceLabel — $fullName" . ($company ? " ($company)" : '');
    $mail->isHTML(true);
    $mail->Body = "
<html><body style='font-family:Arial,sans-serif;color:#333;max-width:600px;margin:0 auto;'>
  <div style='background:#1a1a2e;padding:20px 30px;border-radius:8px 8px 0 0;'>
    <h2 style='color:#fff;margin:0;'>&#9889; New Quote Request</h2>
  </div>
  <div style='background:#f9f9f9;padding:25px 30px;border-radius:0 0 8px 8px;border:1px solid #eee;'>
    <table style='width:100%;border-collapse:collapse;'>
      <tr><td style='padding:8px 0;font-weight:bold;color:#555;width:140px;'>Service</td><td><strong style='color:#c0392b;'>" . htmlspecialchars($serviceLabel) . "</strong></td></tr>
      <tr><td style='padding:8px 0;font-weight:bold;color:#555;'>Name</td><td>" . htmlspecialchars($fullName) . "</td></tr>
      <tr><td style='padding:8px 0;font-weight:bold;color:#555;'>Company</td><td>" . htmlspecialchars($companyDisplay) . "</td></tr>
      <tr><td style='padding:8px 0;font-weight:bold;color:#555;'>Email</td><td><a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></td></tr>
      <tr><td style='padding:8px 0;font-weight:bold;color:#555;'>Phone</td><td>" . htmlspecialchars($phone) . "</td></tr>
      <tr><td style='padding:8px 0;font-weight:bold;color:#555;'>Country</td><td>" . htmlspecialchars($country) . "</td></tr>
    </table>
    <hr style='margin:20px 0;border:none;border-top:1px solid #ddd;'>
    <h4 style='color:#555;margin-bottom:8px;'>Requirements</h4>
    <p style='line-height:1.7;background:#fff;padding:15px;border-radius:6px;border:1px solid #e0e0e0;'>" . nl2br(htmlspecialchars($requirements)) . "</p>
    <p style='color:#aaa;font-size:12px;margin-top:20px;'>Sent via cultusindia.com</p>
  </div>
</body></html>";
    $mail->AltBody = "Service: $serviceLabel\nName: $fullName\nCompany: $companyDisplay\nEmail: $email\nPhone: $phone\nCountry: $country\n\nRequirements:\n$requirements";
    $mail->send();

    // ── Confirmation to requester (same SMTP connection) ──
    $mail->clearAddresses();
    $mail->clearReplyTos();
    $mail->addAddress($email, $fullName);
    $mail->addReplyTo($fromEmail, $fromName);
    $mail->Subject = "Your Quote Request Received — Cultus India";
    $mail->Body = "
<html><body style='font-family:Arial,sans-serif;color:#333;max-width:600px;margin:0 auto;'>
  <div style='background:#1a1a2e;padding:20px 30px;border-radius:8px 8px 0 0;'>
    <h2 style='color:#fff;margin:0;'>Thank you, " . htmlspecialchars($fullName) . "!</h2>
  </div>
  <div style='background:#f9f9f9;padding:25px 30px;border-radius:0 0 8px 8px;border:1px solid #eee;'>
    <p>We've received your quote request for <strong>" . htmlspecialchars($serviceLabel) . "</strong>.</p>
    <p>Our team will review your requirements and respond within <strong>24 hours</strong>.</p>
    <hr style='margin:20px 0;border:none;border-top:1px solid #ddd;'>
    <p style='color:#aaa;font-size:12px;'>Cultus India &mdash; Pala, Kerala 686575</p>
  </div>
</body></html>";
    $mail->AltBody = "Hi $fullName,\n\nWe received your quote request for $serviceLabel and will respond within 24 hours.\n\n— Cultus India";
    $mail->send();

    $mail->smtpClose();

    echo json_encode(['success' => true, 'message' => "Quote request sent, $fullName! We'll review your requirements and respond within 24 hours."]);

} catch (Exception $e) {
    error_log('Quote mail error: ' . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Failed to send. Please email us at escoltrix1@gmail.com']);
}
exit;
