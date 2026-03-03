<?php
// pages/dashboard_student.php - Enhanced Student Dashboard
session_start();
require_once '../config/db.php';

// Access Control
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'student') {
    header('Location: ../index.php?error=' . urlencode('Unauthorized access'));
    exit;
}

$student_id = $_SESSION['user_id'];
include '../includes/header.php';
?>

<div class="row mb-4">
    <div class="col-md-12">
        <h2 class="fw-bold"><i class="fas fa-user-graduate me-2 text-primary"></i>Student Dashboard</h2>
        <p class="lead">Welcome back, <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>!</p>
        <hr>
    </div>
</div>

<div class="row mb-5">
    <div class="col-md-12">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h5 class="mb-0 fw-bold text-primary"><i class="fas fa-pen-nib me-2"></i>Record Daily Activity</h5>
            </div>
            <div class="card-body p-4">
                <form action="add_log_process.php" method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="log_date" class="form-label fw-bold">Date of Work</label>
                                <input type="date" class="form-control" id="log_date" name="log_date" value="<?php echo date('Y-m-d'); ?>" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="hours" class="form-label fw-bold">Hours Spent</label>
                                <input type="number" step="0.5" min="0" max="24" class="form-control" id="hours" name="hours" placeholder="e.g. 8" required>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="mb-3">
                                <label for="description" class="form-label fw-bold">Description of Tasks</label>
                                <textarea class="form-control" id="description" name="description" rows="2" placeholder="Describe what you did today..." required></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4 rounded-pill">
                            <i class="fas fa-save me-2"></i>Submit Daily Log
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <h4 class="fw-bold mb-4"><i class="fas fa-history me-2 text-secondary"></i>Logbook History</h4>
        
        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-success shadow-sm"><?php echo htmlspecialchars($_GET['msg']); ?></div>
        <?php endif; ?>
        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger shadow-sm"><?php echo htmlspecialchars($_GET['error']); ?></div>
        <?php endif; ?>

        <?php
        // Fetch logs joined with comments and supervisor info
        $logs_sql = "SELECT l.*, 
                            c.comment_text, c.created_at as comment_date, 
                            sup.name as supervisor_name 
                     FROM logs l
                     LEFT JOIN comments c ON l.id = c.log_id
                     LEFT JOIN users sup ON c.supervisor_id = sup.id
                     WHERE l.student_id = $student_id
                     ORDER BY l.log_date DESC, l.created_at DESC";
        $logs_result = mysqli_query($conn, $logs_sql);
        ?>

        <?php if (mysqli_num_rows($logs_result) == 0): ?>
            <div class="alert alert-info border-0 shadow-sm">
                <i class="fas fa-info-circle me-2"></i>Your logbook is empty. Start by adding an entry above!
            </div>
        <?php else: ?>
            <?php while ($log = mysqli_fetch_assoc($logs_result)): ?>
                <div class="card log-card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                        <span class="fw-bold">
                            <i class="fas fa-calendar-day me-2 text-primary"></i>
                            <?php echo date('d M Y', strtotime($log['log_date'])); ?>
                            <span class="badge bg-light text-primary border border-primary ms-2 rounded-pill">
                                <?php echo $log['hours']; ?> Hours
                            </span>
                        </span>
                        <div class="btn-group">
                            <a href="edit_log.php?id=<?php echo $log['id']; ?>" class="btn btn-sm btn-outline-warning rounded-start">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="delete_log.php?id=<?php echo $log['id']; ?>" class="btn btn-sm btn-outline-danger rounded-end" 
                               onclick="return confirm('Permanently delete this log entry?')">
                                <i class="fas fa-trash-alt"></i> Delete
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-dark"><?php echo nl2br(htmlspecialchars($log['description'])); ?></p>
                        
                        <?php if (!empty($log['comment_text'])): ?>
                            <div class="mt-3 p-3 bg-light rounded border-start border-4 border-warning">
                                <div class="d-flex justify-content-between align-items-center mb-1">
                                    <strong class="text-dark"><i class="fas fa-comment-dots me-2 text-warning"></i>Supervisor Feedback</strong>
                                    <small class="text-muted"><?php echo date('d M Y', strtotime($log['comment_date'])); ?></small>
                                </div>
                                <p class="mb-1 fst-italic">"<?php echo nl2br(htmlspecialchars($log['comment_text'])); ?>"</p>
                                <small class="text-primary">— <?php echo htmlspecialchars($log['supervisor_name']); ?></small>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>