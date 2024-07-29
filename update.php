<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $course = $_POST['course'];

    $stmt = $conn->prepare("REPLACE INTO students (user_id, name, email, course) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $user_id, $name, $email, $course);

    if ($stmt->execute()) {
        header("Location: dashboard.php");
    } else {
        echo "Update failed!";
    }

    $stmt->close();
    $conn->close();
}
?>
