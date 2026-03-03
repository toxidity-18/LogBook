<?php
// pages/dashboard_supervisor.php - Enhanced Supervisor Dashboard
session_start();
require_once '../config/db.php';

// Access Control: Only supervisors allowed
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'supervisor') {
    header('Location: ../index.php?error=' . urlencode('Unauthorized access'));
    exit;
}

$supervisor_id = $_SESSION['user_id'];
include '../includes/header.php';

// Fetch assigned students using a JOIN on the assignments table
$sql = "SELECT u.id, u.name, u.email 
        FROM users u
        JOIN assignments a ON u.id = a.student_id
        WHERE a.supervisor_id = $supervisor_id
        ORDER BY u.name ASC";
$result = mysqli_query($conn, $sql);
?>

<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="fw-bold"><i class="fas fa-chalkboard-teacher me-2 text-primary"></i>Supervisor Dashboard</h2>
        <p class="lead text-muted">Welcome, <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>! Monitoring your assigned students.</p>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h4 class="mb-3"><i class="fas fa-users me-2 text-secondary"></i>My Assigned Students</h4>
        
        <?php if (mysqli_num_rows($result) == 0): ?>
            <div class="alert alert-info border-0 shadow-sm">
                <i class="fas fa-info-circle me-2"></i>No students have been assigned to you yet. Please contact the Admin if this is an error.
            </div>
        <?php else: ?>
            <div class="card border-0 shadow-sm">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-primary">
                            <tr>
                                <th class="ps-4">Student Name</th>
                                <th>Email Address</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                            <tr>
                                <td class="ps-4">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-light rounded-circle p-2 me-3">
                                            <i class="fas fa-user-graduate text-primary"></i>
                                        </div>
                                        <span class="fw-bold"><?php echo htmlspecialchars($row['name']); ?></span>
                                    </div>
                                </td>
                                <td><?php echo htmlspecialchars($row['email']); ?></td>
                                <td class="text-center">
                                    <a href="view_student_logs.php?student_id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm rounded-pill px-3">
                                        <i class="fas fa-eye me-1"></i> Review Logs
                                    </a>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>