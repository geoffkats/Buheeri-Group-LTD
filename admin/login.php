<?php
session_start();

// If already logged in, redirect to dashboard
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: index.php');
    exit();
}

require_once '../includes/database.php';
$db = new Database();

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    // Check credentials from database
    $admin = $db->verifyAdminLogin($username, $password);
    
    if ($admin) {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_name'] = $admin['name'];
        $_SESSION['admin_username'] = $admin['username'];
        $_SESSION['admin_id'] = $admin['id'];
        header('Location: index.php');
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Buheeri Group U Ltd</title>
    
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/admin.css" rel="stylesheet">
</head>
<body class="login-page">
    
    <div class="login-container">
        <div class="login-grid">
            <!-- Left Side - Image/Branding -->
            <div class="login-left">
                <div class="login-branding">
                    <img src="../assets/img/logo.png" alt="Buheeri Group" class="brand-logo">
                    <h1>Buheeri Group U Ltd</h1>
                    <p class="brand-tagline">Excellence in Construction, Logistics, Labour & General Supply</p>
                    <div class="brand-features">
                        <div class="feature-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Professional Management</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Secure Dashboard</span>
                        </div>
                        <div class="feature-item">
                            <i class="bi bi-check-circle-fill"></i>
                            <span>Real-time Analytics</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right Side - Login Form -->
            <div class="login-right">
                <div class="login-form-wrapper">
                    <div class="login-header">
                        <h2>Admin Login</h2>
                        <p>Enter your credentials to access the dashboard</p>
                    </div>
                    
                    <?php if ($error): ?>
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-circle"></i> <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    
                    <form method="POST" action="login.php" class="login-form">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <div class="input-group">
                                <span class="input-icon"><i class="bi bi-person"></i></span>
                                <input type="text" id="username" name="username" class="form-control" required autofocus>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="input-group">
                                <span class="input-icon"><i class="bi bi-lock"></i></span>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn-login">
                            <i class="bi bi-box-arrow-in-right"></i> Sign In
                        </button>
                    </form>
                    
                    <div class="login-footer">
                        <p>&copy; <?php echo date('Y'); ?> Buheeri Group U Ltd. All rights reserved.</p>
                        <p class="security-badge"><i class="bi bi-shield-check"></i> Security monitored by <strong>Synthilogic Enterprise</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>
