<?php
// pages/edit_user_process.php - Process edit user

session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php?error=Unauthorized access');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $password = $_POST['password'];

    // Check if email already exists for another user
    $check_email = "SELECT id FROM users WHERE email = '$email' AND id != $id";
    $result = mysqli_query($conn, $check_email);
    if (mysqli_num_rows($result) > 0) {
        header("Location: edit_user.php?id=$id&error=Email already exists");
        exit;
    }

    if (!empty($password)) {
        // Update with new password
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET name='$name', email='$email', password='$hashed', role='$role' WHERE id=$id";
    } else {
        // Update without changing password
        $sql = "UPDATE users SET name='$name', email='$email', role='$role' WHERE id=$id";
    }

    if (mysqli_query($conn, $sql)) {
        header('Location: manage_users.php?msg=User updated successfully');
    } else {
        header("Location: edit_user.php?id=$id&error=Update failed: " . mysqli_error($conn));
    }
} else {
    header('Location: manage_users.php');
}
exit;
?>