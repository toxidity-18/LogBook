<?php
// pages/assign_supervisor_process.php - Process assignment

session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php?error=Unauthorized access');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $student_id = intval($_POST['student_id']);
    $supervisor_id = intval($_POST['supervisor_id']);
    $assigned_date = date('Y-m-d'); // today

    // Check if student already has an assignment
    $check_sql = "SELECT id FROM assignments WHERE student_id = $student_id";
    $check_result = mysqli_query($conn, $check_sql);
    if (mysqli_num_rows($check_result) > 0) {
        // Update existing assignment
        $sql = "UPDATE assignments SET supervisor_id = $supervisor_id, assigned_date = '$assigned_date' WHERE student_id = $student_id";
    } else {
        // Insert new assignment
        $sql = "INSERT INTO assignments (student_id, supervisor_id, assigned_date) VALUES ($student_id, $supervisor_id, '$assigned_date')";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: assign_supervisor.php?msg=Assignment saved successfully');
    } else {
        header('Location: assign_supervisor.php?error=Failed to save: ' . mysqli_error($conn));
    }
} else {
    header('Location: assign_supervisor.php');
}
exit;
?>