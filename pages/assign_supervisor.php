<?php
// pages/assign_supervisor.php - Enhanced Assignment Interface
session_start();
require_once '../config/db.php';

// Security: Admin only
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    header('Location: ../index.php?error=' . urlencode('Unauthorized access'));
    exit;
}

include '../includes/header.php';

// Fetch Students and Supervisors for the dropdowns
$students_result = mysqli_query($conn, "SELECT id, name FROM users WHERE role='student' ORDER BY name");
$supervisors_result = mysqli_query($conn, "SELECT id, name FROM users WHERE role='supervisor' ORDER BY name");

// Fetch active assignments using a double-join on the users table
$assign_sql = "SELECT a.*, s.name as student_name, sup.name as supervisor_name 
               FROM assignments a
               JOIN users s ON a.student_id = s.id
               JOIN users sup ON a.supervisor_id = sup.id
               ORDER BY s.name ASC";
$assign_result = mysqli_query($conn, $assign_sql);
?>

<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="fw-bold"><i class="fas fa-link me-2 text-primary"></i>Supervision Management</h2>
        <p class="text-muted">Connect students with their respective industrial or academic supervisors.</p>
        <hr>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-primary"><i class="fas fa-plus-circle me-2"></i>New Assignment</h5>
            </div>
            <div class="card-body p-4">
                <?php if (isset($_GET['msg'])): ?>
                    <div class="alert alert-success shadow-sm"><?php echo htmlspecialchars($_GET['msg']); ?></div>
                <?php endif; ?>
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger shadow-sm"><?php echo htmlspecialchars($_GET['error']); ?></div>
                <?php endif; ?>

                <form action="assign_supervisor_process.php" method="POST">
                    <div class="mb-3">
                        <label for="student_id" class="form-label fw-bold">Student Name</label>
                        <select class="form-select" id="student_id" name="student_id" required>
                            <option value="">-- Select Student --</option>
                            <?php while ($student = mysqli_fetch_assoc($students_result)): ?>
                                <option value="<?php echo $student['id']; ?>"><?php echo htmlspecialchars($student['name']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="supervisor_id" class="form-label fw-bold">Assigned Supervisor</label>
                        <select class="form-select" id="supervisor_id" name="supervisor_id" required>
                            <option value="">-- Select Supervisor --</option>
                            <?php while ($supervisor = mysqli_fetch_assoc($supervisors_result)): ?>
                                <option value="<?php echo $supervisor['id']; ?>"><?php echo htmlspecialchars($supervisor['name']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary rounded-pill py-2">
                            <i class="fas fa-check-circle me-2"></i>Finalize Assignment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-secondary"><i class="fas fa-clipboard-list me-2"></i>Active Pairings</h5>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">Student</th>
                                <th>Supervisor</th>
                                <th class="text-end pe-4">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (mysqli_num_rows($assign_result) > 0): ?>
                                <?php while ($assign = mysqli_fetch_assoc($assign_result)): ?>
                                <tr>
                                    <td class="ps-4 fw-bold text-primary"><?php echo htmlspecialchars($assign['student_name']); ?></td>
                                    <td><i class="fas fa-user-tie text-muted me-2"></i><?php echo htmlspecialchars($assign['supervisor_name']); ?></td>
                                    <td class="text-end pe-4 text-muted small">
                                        <?php echo date('d M Y', strtotime($assign['assigned_date'])); ?>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" class="text-center py-5 text-muted">No assignments found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>