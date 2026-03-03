<?php
// pages/delete_log.php - Delete log entry

session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'student') {
    header('Location: ../index.php?error=Unauthorized access');
    exit;
}

$student_id = $_SESSION['user_id'];
$log_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Verify ownership
$check_sql = "SELECT id FROM logs WHERE id = $log_id AND student_id = $student_id";
$check_result = mysqli_query($conn, $check_sql);
if (mysqli_num_rows($check_result) != 1) {
    header('Location: dashboard_student.php?error=Log not found');
    exit;
}

$delete_sql = "DELETE FROM logs WHERE id = $log_id";
if (mysqli_query($conn, $delete_sql)) {
    header('Location: dashboard_student.php?msg=Log deleted successfully');
} else {
    header('Location: dashboard_student.php?error=Delete failed: ' . mysqli_error($conn));
}
exit;
?>