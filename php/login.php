<?php
// Start the session
session_start();

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

$username = sanitizeInput($_POST["username"]);
$password = sanitizeInput($_POST["password"]);

// Basic server-side validation
if (empty($username) || empty($password)) {
    echo ("<script LANGUAGE='JavaScript'>
    window.alert('Username and password are required.');
    window.location.href='../html/login.html';
    </script>");
    exit();
}

// Database Connection
$conn = new mysqli('localhost', 'root', '', 'apexcare');

if ($conn->connect_error) {
    die('Connection Error : ' . $conn->connect_error);
} else {
    // Check if the username exists
    $stmt = $conn->prepare("SELECT rpassword FROM registered_user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // If username exists, verify the password
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            // Password is correct, allow login
            $_SESSION['username'] = $username; // Set session variable
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('User Authentication Successful');
            window.location.href='../html/help.html';
            </script>");
        } else {
            // Incorrect password
            echo ("<script LANGUAGE='JavaScript'>
            window.alert('Incorrect password. Please try again.');
            window.location.href='../html/login.html';
            </script>");
        }
    } else {
        // Username does not exist
        echo ("<script LANGUAGE='JavaScript'>
        window.alert('User not registered. Please register first.');
        window.location.href='../html/rej.html';
        </script>");
    }

    $stmt->close();
    $conn->close();
}
?>
