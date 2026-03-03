<?php
// pages/view_student_logs.php - Supervisor reviewing student logs
session_start();
require_once '../config/db.php';

// Role Check
if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'supervisor') {
    header('Location: ../index.php?error=' . urlencode('Unauthorized access'));
    exit;
}

$supervisor_id = $_SESSION['user_id'];
$student_id = isset($_GET['student_id']) ? intval($_GET['student_id']) : 0;

/** * SECURITY: Verify the Student-Supervisor relationship 
 */
$check_sql = "SELECT id FROM assignments WHERE student_id = $student_id AND supervisor_id = $supervisor_id";
$check_result = mysqli_query($conn, $check_sql);
if (mysqli_num_rows($check_result) == 0) {
    header('Location: dashboard_supervisor.php?error=' . urlencode('Unauthorized: You are not assigned to this student.'));
    exit;
}

// Get student info for the header
$student_sql = "SELECT name FROM users WHERE id = $student_id";
$student_result = mysqli_query($conn, $student_sql);
$student = mysqli_fetch_assoc($student_result);

include '../includes/header.php';
?>

<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-bold"><i class="fas fa-clipboard-list me-2 text-primary"></i>Reviewing: <?php echo htmlspecialchars($student['name']); ?></h2>
            <a href="dashboard_supervisor.php" class="btn btn-outline-secondary rounded-pill">
                <i class="fas fa-arrow-left me-1"></i>Back to Dashboard
            </a>
        </div>
        <hr>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        
        <?php if (isset($_GET['msg'])): ?>
            <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
                <i class="fas fa-check-circle me-2"></i><?php echo htmlspecialchars($_GET['msg']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php
        // Fetch logs for this student with existing supervisor comments
        $logs_sql = "SELECT l.*, 
                            c.id as comment_id, c.comment_text, c.created_at as comment_date
                     FROM logs l
                     LEFT JOIN comments c ON l.id = c.log_id AND c.supervisor_id = $supervisor_id
                     WHERE l.student_id = $student_id
                     ORDER BY l.log_date DESC, l.created_at DESC";
        $logs_result = mysqli_query($conn, $logs_sql);
        ?>

        <?php if (mysqli_num_rows($logs_result) == 0): ?>
            <div class="alert alert-info border-0 shadow-sm text-center py-4">
                <i class="fas fa-history fa-2x mb-3 d-block text-muted"></i>
                This student hasn't submitted any log entries yet.
            </div>
        <?php else: ?>
            <?php while ($log = mysqli_fetch_assoc($logs_result)): ?>
                <div class="card log-card border-0 shadow-sm mb-4">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <span class="fw-bold">
                            <i class="fas fa-calendar-alt me-2 text-primary"></i>
                            <?php echo date('d M Y', strtotime($log['log_date'])); ?>
                        </span>
                        <span class="badge bg-primary rounded-pill px-3"><?php echo $log['hours']; ?> Hours</span>
                    </div>
                    <div class="card-body">
                        <p class="card-text text-dark mb-4"><?php echo nl2br(htmlspecialchars($log['description'])); ?></p>
                        
                        <?php if (!empty($log['comment_text'])): ?>
                            <div class="bg-light p-3 rounded border-start border-4 border-info shadow-sm">
                                <div class="d-flex justify-content-between mb-2">
                                    <strong class="text-info"><i class="fas fa-comment-check me-2"></i>Your Feedback</strong>
                                    <small class="text-muted"><?php echo date('d M Y H:i', strtotime($log['comment_date'])); ?></small>
                                </div>
                                <p class="mb-0 text-muted fst-italic">"<?php echo nl2br(htmlspecialchars($log['comment_text'])); ?>"</p>
                            </div>
                        <?php else: ?>
                            <div class="mt-2 p-3 bg-light rounded shadow-sm">
                                <form action="add_comment_process.php" method="POST">
                                    <input type="hidden" name="log_id" value="<?php echo $log['id']; ?>">
                                    <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold"><i class="fas fa-reply me-1 text-secondary"></i>Add Feedback:</label>
                                        <textarea name="comment_text" class="form-control" rows="2" placeholder="Tell the student how they're doing or give advice..." required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-sm rounded-pill px-4">
                                        <i class="fas fa-paper-plane me-1"></i>Submit Feedback
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>