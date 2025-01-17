<?php
header('Content-Type: application/json');

// Validate form data
if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
    echo json_encode([
        'success' => false,
        'message' => 'All fields are required'
    ]);
    exit;
}

// Sanitize inputs
$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

// Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid email format'
    ]);
    exit;
}

// Email configuration
$to = "santrasoham85@gmail.com"; // Replace with your email
$subject = "New Contact Form Submission from Portfolio";

// Prepare email content
$email_content = "Name: $name\n";
$email_content .= "Email: $email\n\n";
$email_content .= "Message:\n$message";

// Email headers
$headers = "From: $email\r\n";
$headers .= "Reply-To: $email\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();

// Send email
if (mail($to, $subject, $email_content, $headers)) {
    echo json_encode([
        'success' => true,
        'message' => 'Message sent successfully'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Failed to send message'
    ]);
}
?>
