<?php


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get JSON data from request body
    $jsonData = file_get_contents("php://input");
    $data = json_decode($jsonData, true); // Decode JSON into an associative array
    $to = "console.digital.pro@gmail.com";
    $subject = isset($data['subject']) ? $data['subject'] : "Test Email";
    $message = isset($data['message']) ? $data['message'] : "Hello, this is a test email from PHP!";
    $headers = "From: ".isset($data['from']) ? $data['from'] : "recipient@example.com"."\r\n" .
               "Reply-To: sender@example.com" . "\r\n" .
               "Content-Type: text/plain; charset=UTF-8";


    if(mail($to, $subject, $message, $headers)) {
        echo json_encode(["message"=>"Email sent successfully!"]);
    } else {
        echo json_encode(["message"=>"Failed to send email."]);
    }
} else {
    exit;
}