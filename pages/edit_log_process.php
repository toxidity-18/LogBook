<?php
// pages/edit_log_process.php - Process edit log

session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'student') {
    header('Location: ../index.php?error=Unauthorized access');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = $_SESSION['user_id'];
    $log_id = intval($_POST['id']);
    $log_date = mysqli_real_escape_string($conn, $_POST['log_date']);
    $hours = floatval($_POST['hours']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Verify ownership
    $check_sql = "SELECT id FROM logs WHERE id = $log_id AND student_id = $student_id";
    $check_result = mysqli_query($conn, $check_sql);
    if (mysqli_num_rows($check_result) != 1) {
        header('Location: dashboard_student.php?error=Unauthorized');
        exit;
    }

    $sql = "UPDATE logs SET log_date='$log_date', description='$description', hours=$hours WHERE id=$log_id";
    if (mysqli_query($conn, $sql)) {
        header('Location: dashboard_student.php?msg=Log updated successfully');
    } else {
        header("Location: edit_log.php?id=$log_id&error=Update failed: " . mysqli_error($conn));
    }
} else {
    header('Location: dashboard_student.php');
}
exit;
?>