<?php
// pages/delete_user.php - Delete user

session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php?error=Unauthorized access');
    exit;
}

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    // Optional: prevent admin from deleting themselves
    if ($id == $_SESSION['user_id']) {
        header('Location: manage_users.php?error=You cannot delete yourself');
        exit;
    }
    $sql = "DELETE FROM users WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header('Location: manage_users.php?msg=User deleted successfully');
    } else {
        header('Location: manage_users.php?error=Delete failed: ' . mysqli_error($conn));
    }
} else {
    header('Location: manage_users.php?error=Invalid user');
}
exit;
?>