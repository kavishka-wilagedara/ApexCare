<?php
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Retrieve and sanitize form data
$amount_to_be_paid = sanitizeInput($_POST["personal_number"]);
$mobile_number = sanitizeInput($_POST["number"]);
$valid_amounts = array("5000", "4000", "3500", "10000", "4500", "7500", "3000");

// Server-side validation
if (empty($amount_to_be_paid) || empty($mobile_number)) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('All fields are required.');
    window.location.href='../html/billing.html';
    </script>");
    exit();
}

if (!in_array($valid_amounts, $amount_to_be_paid)) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Entered amount is wrong. Select your treatment.');
    window.location.href='../html/billing.html';
    </script>");
    exit();
}

if (!preg_match("/^\d+$/", $amount_to_be_paid)) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Amount must be a number.');
    window.location.href='../html/billing.html';
    </script>");
    exit();
}

if (!preg_match())

if (!preg_match("/^\d{10}$/", $mobile_number)) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Mobile number must be 10 digits.');
    window.location.href='../html/billing.html';
    </script>");
    exit();
}

// Database connection
$conn = new mysqli('localhost', 'root', '', 'apexcare');

// Check connection
if ($conn->connect_error) {
    die('Connection Error: ' . $conn->connect_error);
} else {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO billing (amount_to_be_paid, mobile_number) VALUES (?, ?)");
    $stmt->bind_param("ss", $amount_to_be_paid, $mobile_number);
    
    // Execute the statement
    $stmt->execute();
    
    // Confirmation message and redirect
    echo ("<script LANGUAGE='JavaScript'>
        window.alert('Billing information saved successfully');
        window.location.href='../html/pay.html';
        </script>");

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>
