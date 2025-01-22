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
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;
        $mail->Username = 'codedsymphony6@gmail.com'; 
        $mail->Password = 'bzcjyhrugnkdgumh'; 
        $mail->SMTPSecure = 'tls'; 
        $mail->Port = 587; 

        // Sender and recipient settings
        $mail->setFrom('codedsymphony6@gmail.com', 'Soham Santra');
        $mail->addAddress($email, $name);

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
        $successMessage = 'Message has been sent successfully!';
    } catch (Exception $e) {
        $errorMessage = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
        }
        .success {
            color: green;
            margin-bottom: 15px;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        input, textarea {
            width: 100%;
            margin-bottom: 10px;
            padding: 8px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h2>Contact Form</h2>
    
    <?php
    if (isset($successMessage)) {
        echo "<div class='success'>" . htmlspecialchars($successMessage) . "</div>";
    }
    if (isset($errorMessage)) {
        echo "<div class='error'>" . htmlspecialchars($errorMessage) . "</div>";
    }
    ?>
    
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
        <input type="submit" value="Send Message">
    </form>
</body>
</html>