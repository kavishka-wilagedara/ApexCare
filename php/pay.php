<?php
function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

// Retrieve and sanitize form data
$accountName = sanitizeInput($_POST["AccountName"]);
$cardNumber = sanitizeInput($_POST["CardNumber"]);
$cvv = sanitizeInput($_POST["Cvv"]);
$expiary = sanitizeInput($_POST["Expiary"]);

// Server-side validation
if (empty($accountName) || empty($cardNumber) || empty($cvv) || empty($expiary)) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('All fields are required.');
    window.location.href='../html/pay.html';
    </script>");
    exit();
}

if (!preg_match("/^[a-zA-Z\s]+$/", $accountName)) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Account name must contain only letters and spaces.');
    window.location.href='../html/pay.html';
    </script>");
    exit();
}

if (!preg_match("/^\d{16}$/", $cardNumber)) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Card number must be 16 digits.');
    window.location.href='../html/pay.html';
    </script>");
    exit();
}

if (!preg_match("/^\d{3}$/", $cvv)) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('CVV must be 3 digits.');
    window.location.href='../html/pay.html';
    </script>");
    exit();
}

if (!preg_match("/^\d{2}\/\d{2}$/", $expiary)) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Expiry date must be in MM/YY format.');
    window.location.href='../html/pay.html';
    </script>");
    exit();
}

// Database Connection
$conn = new mysqli('localhost', 'root', '', 'apexcare');

if ($conn->connect_error) {
    die('Connection Error: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO Payment (accountName, cardNumber, cvv, expiary) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $accountName, $cardNumber, $cvv, $expiary);
    $stmt->execute();

    echo ("<script LANGUAGE='JavaScript'>
        window.alert('Payment processed successfully');
        window.location.href='../html/pharmacy.html';
        </script>");

    $stmt->close();
    $conn->close();
}
?>
