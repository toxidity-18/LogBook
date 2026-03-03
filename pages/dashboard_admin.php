<?php
// pages/dashboard_admin.php - Updated Admin Dashboard
session_start();
require_once '../config/db.php';

// Role-Based Access Control
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php?error=' . urlencode('Unauthorized access'));
    exit;
}

include '../includes/header.php';
?>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex align-items-center justify-content-between">
            <div>
                <h2 class="fw-bold text-dark">
                    <i class="fas fa-tachometer-alt me-2 text-primary"></i>Admin Dashboard
                </h2>
                <p class="text-muted mb-0">Logged in as: <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong></p>
            </div>
            <div class="text-end">
                <span class="badge bg-primary rounded-pill p-2 px-3">Administrator Mode</span>
            </div>
        </div>
        <hr>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card dashboard-card border-0 shadow-sm h-100">
            <div class="card-body py-5">
                <div class="mb-4">
                    <i class="fas fa-users fa-3x text-primary"></i>
                </div>
                <h4 class="card-title fw-bold">Manage Users</h4>
                <p class="card-text text-muted">Create, update, or remove students, supervisors, and administrative staff.</p>
                <a href="manage_users.php" class="btn btn-primary mt-3">
                    Go to Users <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card dashboard-card border-0 shadow-sm h-100">
            <div class="card-body py-5">
                <div class="mb-4">
                    <i class="fas fa-user-tie fa-3x text-primary"></i>
                </div>
                <h4 class="card-title fw-bold">Assign Supervisor</h4>
                <p class="card-text text-muted">Establish links between students and their industrial or academic supervisors.</p>
                <a href="assign_supervisor.php" class="btn btn-primary mt-3">
                    Go to Assignments <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>