
<?php
// login_process.php - Handle login form submission

// Start session
session_start();

// Include database connection
require_once 'config/db.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and sanitize input
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password']; // Will be verified with password_verify()

    // Query to find user by email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        // Verify password
        if (password_verify($password, $user['password'])) {
            // Password correct – set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role'];

            // Redirect based on role
            switch ($user['role']) {
                case 'admin':
                    header('Location: pages/dashboard_admin.php');
                    break;
                case 'supervisor':
                    header('Location: pages/dashboard_supervisor.php');
                    break;
                case 'student':
                    header('Location: pages/dashboard_student.php');
                    break;
            }
            exit;
        } else {
            // Invalid password
            header('Location: index.php?error=Invalid email or password');
            exit;
        }
    } else {
        // Email not found
        header('Location: index.php?error=Invalid email or password');
        exit;
    }
} else {
    // If someone tries to access this file directly without POST
    header('Location: index.php');
    exit;
}
?>