<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'vendor/autoload.php';  // Adjust path according to your PHPMailer installation

header('Content-Type: application/json');

try {
    // Validate inputs
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
        throw new Exception('All fields are required');
    }

    $name = $_POST['name'];
    $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
    $message = $_POST['message'];

    if (!$email) {
        throw new Exception('Invalid email format');
    }

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';  // Gmail SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'your-gmail@gmail.com';  // Your Gmail address
    $mail->Password   = 'your-app-specific-password';  // Your Gmail app-specific password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;

    // Recipients
    $mail->setFrom($email, $name);
    $mail->addAddress('santrasoham85@gmail.com', 'Soham Santra');
    $mail->addReplyTo($email, $name);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'New Contact Form Submission from Portfolio';
    
    // HTML email body
    $mail->Body = "
        <html>
        <body style='font-family: Arial, sans-serif; line-height: 1.6; color: #333;'>
            <h2>New Contact Form Submission</h2>
            <table style='border-collapse: collapse; width: 100%; max-width: 600px;'>
                <tr>
                    <th style='text-align: left; padding: 8px; background-color: #f2f2f2;'>Name:</th>
                    <td style='padding: 8px;'>" . htmlspecialchars($name) . "</td>
                </tr>
                <tr>
                    <th style='text-align: left; padding: 8px; background-color: #f2f2f2;'>Email:</th>
                    <td style='padding: 8px;'>" . htmlspecialchars($email) . "</td>
                </tr>
                <tr>
                    <th style='text-align: left; padding: 8px; background-color: #f2f2f2;'>Message:</th>
                    <td style='padding: 8px;'>" . nl2br(htmlspecialchars($message)) . "</td>
                </tr>
            </table>
        </body>
        </html>";

    // Plain text version for non-HTML mail clients
    $mail->AltBody = "
        New Contact Form Submission
        -------------------------
        Name: $name
        Email: $email
        Message: $message";

    // Send email
    $mail->send();

    echo json_encode([
        'success' => true,
        'message' => 'Message sent successfully!'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => "Error: {$e->getMessage()}"
    ]);
}
?>