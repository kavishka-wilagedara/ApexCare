<?php
$name = $_POST["name"];
$email = $_POST["email"];
$feedback = $_POST["feedback"];

// Database Connection
$conn = new mysqli('localhost', 'root', '', 'apexcare');

if ($conn->connect_error) {
    die('Connection Error: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, feedback) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $feedback);
    $stmt->execute();

    echo ("<script LANGUAGE='JavaScript'>
        window.alert('Feedback submitted successfully');
        window.location.href='../html/home.html';
        </script>");

    $stmt->close();
    $conn->close();
}
?>