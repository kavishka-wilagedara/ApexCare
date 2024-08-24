<?php
$fullname = $_POST["fullname"];
$email = $_POST["email"];
$address = $_POST["address"];
$doctor = $_POST["doctor"];
$appointment_date = $_POST["appointment_date"];
$appointment_time = $_POST["appointment_time"];
$reason = $_POST["reason"];

// Database Connection
$conn = new mysqli('localhost', 'root', '', 'apexcare');

if ($conn->connect_error) {
    die('Connection Error: ' . $conn->connect_error);
} else {
    $stmt = $conn->prepare("INSERT INTO contact_us (fullname, email, address, doctor, appointment_date, appointment_time, reason) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $fullname, $email, $address, $doctor, $appointment_date, $appointment_time, $reason);
    $stmt->execute();

    echo ("<script LANGUAGE='JavaScript'>
        window.alert('Appointment booked successfully');
        window.location.href='../html/billing.html';
        </script>");

    $stmt->close();
    $conn->close();
}
?>