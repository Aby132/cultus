<?php
require_once __DIR__ . '/includes/mailer.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Only handle POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: quote.php');
    exit;
}

// Sanitise inputs
$fullName     = trim(strip_tags($_POST['fullName']     ?? ''));
$company      = trim(strip_tags($_POST['company']      ?? ''));
$email        = trim(strip_tags($_POST['email']        ?? ''));
$phone        = trim(strip_tags($_POST['phone']        ?? ''));
$country      = trim(strip_tags($_POST['country']      ?? ''));
$requirements = trim(strip_tags($_POST['requirements'] ?? ''));
$service      = trim(strip_tags($_POST['service']      ?? ''));

// Basic validation
if (empty($fullName) || empty($email) || empty($phone) || empty($country) || empty($requirements) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: quote.php?status=error&reason=validation');
    exit;
}

// Map service key to label
$serviceLabels = [
    'lightning' => 'Lightning Protection',
    'garments'  => 'Garments Export',
    'trade'     => 'Import / Export Services',
];
$serviceLabel = $serviceLabels[$service] ?? ($service ?: 'Not selected');

try {
    $mail = createMailer();

    /* ── Quote email TO the business ── */
    $mail->addAddress($_ENV['MAIL_TO'] ?? 'escoltrix1@gmail.com', 'Cultus India');
    $mail->addReplyTo($email, $fullName);
    $mail->Subject = "Quote Request: $serviceLabel — from $fullName" . ($company ? " ($company)" : '');
    $mail->isHTML(true);
    $mail->Body = "
    <html><body style='font-family:Arial,sans-serif;color:#333;max-width:600px;margin:0 auto;'>
      <div style='background:#1a1a2e;padding:20px 30px;border-radius:8px 8px 0 0;'>
        <h2 style='color:#fff;margin:0;'>⚡ New Quote Request</h2>
      </div>
      <div style='background:#f9f9f9;padding:25px 30px;border-radius:0 0 8px 8px;border:1px solid #eee;'>
        <table style='width:100%;border-collapse:collapse;'>
          <tr><td style='padding:8px 0;font-weight:bold;color:#555;width:140px;'>Service</td><td style='padding:8px 0;'><strong style='color:#c0392b;'>" . htmlspecialchars($serviceLabel) . "</strong></td></tr>
          <tr><td style='padding:8px 0;font-weight:bold;color:#555;'>Name</td><td style='padding:8px 0;'>" . htmlspecialchars($fullName) . "</td></tr>
          <tr><td style='padding:8px 0;font-weight:bold;color:#555;'>Company</td><td style='padding:8px 0;'>" . (htmlspecialchars($company) ?: '<em style=\"color:#aaa\">Not provided</em>') . "</td></tr>
          <tr><td style='padding:8px 0;font-weight:bold;color:#555;'>Email</td><td style='padding:8px 0;'><a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></td></tr>
          <tr><td style='padding:8px 0;font-weight:bold;color:#555;'>Phone</td><td style='padding:8px 0;'>" . htmlspecialchars($phone) . "</td></tr>
          <tr><td style='padding:8px 0;font-weight:bold;color:#555;'>Country</td><td style='padding:8px 0;'>" . htmlspecialchars($country) . "</td></tr>
        </table>
        <hr style='margin:20px 0;border:none;border-top:1px solid #ddd;'>
        <h4 style='color:#555;margin-bottom:8px;'>Requirements</h4>
        <p style='line-height:1.7;background:#fff;padding:15px;border-radius:6px;border:1px solid #e0e0e0;'>" . nl2br(htmlspecialchars($requirements)) . "</p>
        <p style='color:#aaa;font-size:12px;margin-top:20px;'>Sent from cultusindia.com quote form</p>
      </div>
    </body></html>";
    $mail->AltBody = "Service: $serviceLabel\nName: $fullName\nCompany: $company\nEmail: $email\nPhone: $phone\nCountry: $country\n\nRequirements:\n$requirements";
    $mail->send();

    /* ── Confirmation email TO the requester ── */
    $mail->clearAddresses();
    $mail->clearReplyTos();
    $mail->addAddress($email, $fullName);
    $mail->addReplyTo($_ENV['MAIL_USERNAME'] ?? 'escoltrix1@gmail.com', 'Cultus India');
    $mail->Subject = "Your Quote Request Received — Cultus India";
    $mail->Body = "
    <html><body style='font-family:Arial,sans-serif;color:#333;max-width:600px;margin:0 auto;'>
      <div style='background:#1a1a2e;padding:20px 30px;border-radius:8px 8px 0 0;'>
        <h2 style='color:#fff;margin:0;'>Thank you, " . htmlspecialchars($fullName) . "!</h2>
      </div>
      <div style='background:#f9f9f9;padding:25px 30px;border-radius:0 0 8px 8px;border:1px solid #eee;'>
        <p>We've received your quote request for <strong>" . htmlspecialchars($serviceLabel) . "</strong>.</p>
        <p>Our team will review your requirements and get back to you within <strong>24 hours</strong>.</p>
        <hr style='margin:20px 0;border:none;border-top:1px solid #ddd;'>
        <p style='color:#aaa;font-size:12px;'>Cultus India &mdash; Bus Stand, Municipal Complex, Kottaramattom, Pala, Kerala 686575</p>
      </div>
    </body></html>";
    $mail->AltBody = "Hi $fullName,\n\nWe received your quote request for $serviceLabel and will respond within 24 hours.\n\n— Cultus India";
    $mail->send();

    header('Location: quote.php?status=success');
} catch (Exception $e) {
    error_log('Quote mail error: ' . $e->getMessage());
    header('Location: quote.php?status=error');
}
exit;
