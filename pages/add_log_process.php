<?php
// pages/add_log_process.php - Add new log entry

session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'student') {
    header('Location: ../index.php?error=Unauthorized access');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_SESSION['user_id'];
    $log_date = mysqli_real_escape_string($conn, $_POST['log_date']);
    $hours = floatval($_POST['hours']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    $sql = "INSERT INTO logs (student_id, log_date, description, hours) 
            VALUES ($student_id, '$log_date', '$description', $hours)";
    if (mysqli_query($conn, $sql)) {
        header('Location: dashboard_student.php?msg=Log added successfully');
    } else {
        header('Location: dashboard_student.php?error=Failed to add log: ' . mysqli_error($conn));
    }
} else {
    header('Location: dashboard_student.php');
}
exit;
?>