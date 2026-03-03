<?php
// pages/manage_users.php - Enhanced User Management
session_start();
require_once '../config/db.php';

// Access Control
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php?error=' . urlencode('Unauthorized access'));
    exit;
}

include '../includes/header.php';

// Fetch all users sorted by role and name
$sql = "SELECT * FROM users ORDER BY role ASC, name ASC";
$result = mysqli_query($conn, $sql);
?>

<div class="row">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold"><i class="fas fa-users-cog me-2 text-primary"></i>Manage Users</h2>
            <a href="add_user.php" class="btn btn-primary rounded-pill">
                <i class="fas fa-plus-circle me-1"></i>Add New User
            </a>
        </div>

        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i><?php echo htmlspecialchars($_GET['msg']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i><?php echo htmlspecialchars($_GET['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th class="ps-3">ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (mysqli_num_rows($result) > 0): ?>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="ps-3 fw-bold text-muted"><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td>
                                    <?php
                                    $role = $row['role'];
                                    $badge = 'bg-info text-dark'; // Default Student
                                    if ($role == 'admin') $badge = 'bg-danger';
                                    elseif ($role == 'supervisor') $badge = 'bg-warning text-dark';
                                    ?>
                                    <span class="badge <?php echo $badge; ?> rounded-pill px-3">
                                        <?php echo ucfirst($role); ?>
                                    </span>
                                </td>
                                <td><?php echo date('d M Y', strtotime($row['created_at'])); ?></td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <a href="edit_user.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-warning">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="delete_user.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger" 
                                           onclick="return confirm('Are you sure you want to delete <?php echo addslashes($row['name']); ?>?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No users found in the system.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>