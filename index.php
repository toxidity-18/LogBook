<?php
// index.php - Smart Login Gateway
session_start();

/**
 * AUTO-REDIRECT:
 * If a session already exists, don't show the login form.
 * Send the user straight to their workspace.
 */
if (isset($_SESSION['user_id'])) {
    $role = $_SESSION['user_role'];
    $redirect_path = 'pages/dashboard_student.php'; // Default

    if ($role === 'admin') $redirect_path = 'pages/dashboard_admin.php';
    elseif ($role === 'supervisor') $redirect_path = 'pages/dashboard_supervisor.php';
    
    header("Location: $redirect_path");
    exit;
}
?>

<?php include 'includes/header.php'; ?>

<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-5 col-lg-4">
        <div class="card border-0 shadow-lg">
            <div class="card-header bg-primary text-white text-center py-4 border-0 rounded-top">
                <h4 class="mb-0 fw-bold">
                    <i class="fas fa-book-open me-2"></i>Internship LogBook
                </h4>
                <small>Digital Activity Tracking System</small>
            </div>
            <div class="card-body p-4">
                
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger shadow-sm border-0 small">
                        <i class="fas fa-exclamation-circle me-2"></i><?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif; ?>

                <form action="login_process.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label fw-bold">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="fas fa-envelope"></i>
                            </span>
                            <input type="email" class="form-control border-start-0 ps-0" id="email" name="email" placeholder="name@example.com" required>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold">Password</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0 text-muted">
                                <i class="fas fa-lock"></i>
                            </span>
                            <input type="password" class="form-control border-start-0 ps-0" id="password" name="password" placeholder="••••••••" required>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill shadow-sm">
                            <i class="fas fa-sign-in-alt me-2"></i>Sign In
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer bg-white text-center border-0 pb-4">
                <p class="text-muted small mb-0">Trouble logging in? Contact your administrator.</p>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>