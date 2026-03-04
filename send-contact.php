<?php
require_once __DIR__ . '/includes/mailer.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Only handle POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

// Sanitise inputs
$name    = trim(strip_tags($_POST['name']    ?? ''));
$email   = trim(strip_tags($_POST['email']   ?? ''));
$subject = trim(strip_tags($_POST['subject'] ?? ''));
$message = trim(strip_tags($_POST['message'] ?? ''));

// Basic validation
if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: index.php#contact?status=error&reason=validation');
    exit;
}

// Map subject value to human-readable label
$subjectLabels = [
    'lightning' => 'Lightning Protection Inquiry',
    'garments'  => 'Garments Export Inquiry',
    'trade'     => 'Import/Export Services',
    'general'   => 'General Inquiry',
];
$subjectLabel = $subjectLabels[$subject] ?? ucfirst($subject);

try {
    $mail = createMailer();

    /* ── Email TO the business ── */
    $mail->addAddress($_ENV['MAIL_TO'] ?? 'escoltrix1@gmail.com', 'Cultus India');
    $mail->addReplyTo($email, $name);
    $mail->Subject = "Contact Form: $subjectLabel — from $name";
    $mail->isHTML(true);
    $mail->Body = "
    <html><body style='font-family:Arial,sans-serif;color:#333;max-width:600px;margin:0 auto;'>
      <div style='background:#1a1a2e;padding:20px 30px;border-radius:8px 8px 0 0;'>
        <h2 style='color:#fff;margin:0;'>📬 New Contact Message</h2>
      </div>
      <div style='background:#f9f9f9;padding:25px 30px;border-radius:0 0 8px 8px;border:1px solid #eee;'>
        <table style='width:100%;border-collapse:collapse;'>
          <tr><td style='padding:8px 0;font-weight:bold;color:#555;width:130px;'>Name</td><td style='padding:8px 0;'>" . htmlspecialchars($name) . "</td></tr>
          <tr><td style='padding:8px 0;font-weight:bold;color:#555;'>Email</td><td style='padding:8px 0;'><a href='mailto:" . htmlspecialchars($email) . "'>" . htmlspecialchars($email) . "</a></td></tr>
          <tr><td style='padding:8px 0;font-weight:bold;color:#555;'>Subject</td><td style='padding:8px 0;'>" . htmlspecialchars($subjectLabel) . "</td></tr>
        </table>
        <hr style='margin:20px 0;border:none;border-top:1px solid #ddd;'>
        <h4 style='color:#555;margin-bottom:8px;'>Message</h4>
        <p style='line-height:1.7;background:#fff;padding:15px;border-radius:6px;border:1px solid #e0e0e0;'>" . nl2br(htmlspecialchars($message)) . "</p>
        <p style='color:#aaa;font-size:12px;margin-top:20px;'>Sent from cultusindia.com contact form</p>
      </div>
    </body></html>";
    $mail->AltBody = "Name: $name\nEmail: $email\nSubject: $subjectLabel\n\nMessage:\n$message";
    $mail->send();

    /* ── Confirmation email TO the sender ── */
    $mail->clearAddresses();
    $mail->clearReplyTos();
    $mail->addAddress($email, $name);
    $mail->addReplyTo($_ENV['MAIL_USERNAME'] ?? 'escoltrix1@gmail.com', 'Cultus India');
    $mail->Subject = "We received your message — Cultus India";
    $mail->Body = "
    <html><body style='font-family:Arial,sans-serif;color:#333;max-width:600px;margin:0 auto;'>
      <div style='background:#1a1a2e;padding:20px 30px;border-radius:8px 8px 0 0;'>
        <h2 style='color:#fff;margin:0;'>Thank you, " . htmlspecialchars($name) . "!</h2>
      </div>
      <div style='background:#f9f9f9;padding:25px 30px;border-radius:0 0 8px 8px;border:1px solid #eee;'>
        <p>We've received your message and will get back to you within <strong>1 business day</strong>.</p>
        <hr style='margin:20px 0;border:none;border-top:1px solid #ddd;'>
        <p style='color:#aaa;font-size:12px;'>Cultus India &mdash; Bus Stand, Municipal Complex, Kottaramattom, Pala, Kerala 686575</p>
      </div>
    </body></html>";
    $mail->AltBody = "Hi $name,\n\nWe received your message and will get back to you within 1 business day.\n\n— Cultus India";
    $mail->send();

    header('Location: index.php?status=success#contact');
} catch (Exception $e) {
    error_log('Contact mail error: ' . $e->getMessage());
    header('Location: index.php?status=error#contact');
}
exit;
