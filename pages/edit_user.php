<?php
// pages/edit_user.php - Edit user

session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php?error=Unauthorized access');
    exit;
}

// Get user ID from URL
$user_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($user_id <= 0) {
    header('Location: manage_users.php?error=Invalid user');
    exit;
}

// Fetch user data
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) != 1) {
    header('Location: manage_users.php?error=User not found');
    exit;
}
$user = mysqli_fetch_assoc($result);

include '../includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6">
        <h2>Edit User</h2>
        <form action="edit_user_process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($user['name']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="admin" <?php if ($user['role'] == 'admin') echo 'selected'; ?>>Admin</option>
                    <option value="supervisor" <?php if ($user['role'] == 'supervisor') echo 'selected'; ?>>Supervisor</option>
                    <option value="student" <?php if ($user['role'] == 'student') echo 'selected'; ?>>Student</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password (leave blank to keep current)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Update User</button>
            <a href="manage_users.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>