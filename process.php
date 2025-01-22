<?php
// Include the PHPMailer library
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // Replace with your SMTP host
        $mail->SMTPAuth = true;
        $mail->Username = 'codedsymphony6@gmail.com'; // Replace with your email address
        $mail->Password = 'bzcjyhrugnkdgumh'; // Replace with your email password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption
        $mail->Port = 587; // TCP port to connect to

        // Sender and recipient settings
        $mail->setFrom('codedsymphony6@gmail.com', 'Soham Santra'); // Replace with your email address and name
        $mail->addAddress($email, $name); // Replace with the recipient's email address and name

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'New message from your website';
        $mail->Body = "
            <h2>New message</h2>
            <p><b>Name:</b> $name</p>
            <p><b>Email:</b> $email</p>
            <p><b>Message:</b> $message</p>
        ";

        // Send the email
        $mail->send();
        echo 'Message has been sent successfully!';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title