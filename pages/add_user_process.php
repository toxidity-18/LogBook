<?php
// pages/add_user_process.php - Process add user

session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php?error=Unauthorized access');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    // Validate email uniqueness
    $check_email = "SELECT id FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $check_email);
    if (mysqli_num_rows($result) > 0) {
        header('Location: add_user.php?error=Email already exists');
        exit;
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user
    $sql = "INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$hashed_password', '$role')";
    if (mysqli_query($conn, $sql)) {
        header('Location: manage_users.php?msg=User added successfully');
    } else {
        header('Location: add_user.php?error=Failed to add user: ' . mysqli_error($conn));
    }
} else {
    header('Location: manage_users.php');
}
exit;
?>