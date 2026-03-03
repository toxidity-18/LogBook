<?php
// pages/add_comment_process.php - Add comment to a log

session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'supervisor') {
    header('Location: ../index.php?error=Unauthorized access');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $log_id = intval($_POST['log_id']);
    $student_id = intval($_POST['student_id']);
    $supervisor_id = $_SESSION['user_id'];
    $comment_text = mysqli_real_escape_string($conn, $_POST['comment_text']);

    // Verify that the supervisor is assigned to the student of this log
    // First get student_id from log
    $log_check = "SELECT student_id FROM logs WHERE id = $log_id";
    $log_result = mysqli_query($conn, $log_check);
    if (mysqli_num_rows($log_result) != 1) {
        header("Location: view_student_logs.php?student_id=$student_id&error=Invalid log");
        exit;
    }
    $log = mysqli_fetch_assoc($log_result);
    if ($log['student_id'] != $student_id) {
        header("Location: view_student_logs.php?student_id=$student_id&error=Log does not belong to this student");
        exit;
    }

    // Check assignment
    $assign_check = "SELECT id FROM assignments WHERE student_id = $student_id AND supervisor_id = $supervisor_id";
    $assign_result = mysqli_query($conn, $assign_check);
    if (mysqli_num_rows($assign_result) == 0) {
        header("Location: view_student_logs.php?student_id=$student_id&error=You are not assigned to this student");
        exit;
    }

    // Insert comment
    $sql = "INSERT INTO comments (log_id, supervisor_id, comment_text) VALUES ($log_id, $supervisor_id, '$comment_text')";
    if (mysqli_query($conn, $sql)) {
        header("Location: view_student_logs.php?student_id=$student_id&msg=Comment added");
    } else {
        header("Location: view_student_logs.php?student_id=$student_id&error=Failed to add comment: " . mysqli_error($conn));
    }
} else {
    header('Location: dashboard_supervisor.php');
}
exit;
?>