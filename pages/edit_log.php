<?php
// pages/edit_log.php - Edit log entry

session_start();
require_once '../config/db.php';

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'student') {
    header('Location: ../index.php?error=Unauthorized access');
    exit;
}

$student_id = $_SESSION['user_id'];
$log_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Fetch log and verify ownership
$sql = "SELECT * FROM logs WHERE id = $log_id AND student_id = $student_id";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) != 1) {
    header('Location: dashboard_student.php?error=Log not found');
    exit;
}
$log = mysqli_fetch_assoc($result);

include '../includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <h2>Edit Log Entry</h2>
        <form action="edit_log_process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $log['id']; ?>">
            <div class="row">
                <div class="col-md-3">
                    <div class="mb-3">
                        <label for="log_date" class="form-label">Date</label>
                        <input type="date" class="form-control" id="log_date" name="log_date" value="<?php echo $log['log_date']; ?>" required>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="mb-3">
                        <label for="hours" class="form-label">Hours</label>
                        <input type="number" step="0.5" min="0" max="24" class="form-control" id="hours" name="hours" value="<?php echo $log['hours']; ?>" required>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($log['description']); ?></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Update Log</button>
            <a href="dashboard_student.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include '../includes/footer.php'; ?>