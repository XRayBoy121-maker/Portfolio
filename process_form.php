<?php
header('Content-Type: application/json');

// Validate form data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['message'])) {
        echo json_encode(['success' => false, 'message' => 'All fields are required']);
        exit;
    }

    // Sanitize inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format']);
        exit;
    }

    // Email configuration
    $to = "santrasoham85@gmail.com"; // Replace with your email
    $subject = "New Contact Form Submission";

    // Prepare email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message";

    // Send email
    if (mail($to, $subject, $email_content)) {
        echo json_encode(['success' => true, 'message' => 'Message sent successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to send message']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
?>