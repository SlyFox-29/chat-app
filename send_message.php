<?php
session_start();

// Redirect user if not logged in
if (!isset($_SESSION['username'])) {
    http_response_code(403); // Forbidden
    exit;
}

$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];

    // Save message to a file or database
    $message = htmlspecialchars($username) . ': ' . htmlspecialchars($message) . PHP_EOL;
    file_put_contents('messages.txt', $message, FILE_APPEND);
}
?>
