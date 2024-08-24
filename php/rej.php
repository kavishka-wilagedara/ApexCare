<?php
// Start the session
session_start();

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$fullname = sanitizeInput($_POST["fullname"]);
$username = sanitizeInput($_POST["username"]);
$email = sanitizeInput($_POST["email"]);
$password = sanitizeInput($_POST["password"]);

// Basic server-side validation
if (empty($fullname) || empty($username) || empty($email) || empty($password)) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('All fields are required.');
    window.location.href='../html/rej.html';
    </script>");
    exit();
}

// Check if full name contains only letters and spaces
if (!preg_match("/^[a-zA-Z\s]+$/", $fullname)) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Full name must contain only letters and spaces.');
    window.location.href='../html/rej.html';
    </script>");
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Invalid email format.');
    window.location.href='../html/rej.html';
    </script>");
    exit();
}

// Hash the password before storing it
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Database Connection 
$conn = new mysqli('localhost', 'root', '', 'apexcare');

if ($conn->connect_error) {
    die('Connection Error : ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO registered_user (fullname, username, email, rpassword) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $fullname, $username, $email, $hashed_password);
    $stmt->execute();

    echo ("<script LANGUAGE='JavaScript'>
    window.alert('User Registered successfully');
    window.location.href='../html/login.html';
    </script>");

    $stmt->close();
    $conn->close();     
}
?>
