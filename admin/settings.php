<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

require_once '../config.php';
require_once '../includes/database.php';

$db = new Database();
$success = '';
$error = '';

// Get current admin credentials
$adminData = $db->getAdminCredentials();

// Handle username change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_username'])) {
    $new_username = trim($_POST['new_username'] ?? '');
    $confirm_password = $_POST['confirm_password'] ?? '';
    
    if (empty($new_username)) {
        $error = 'Username cannot be empty';
    } elseif (strlen($new_username) < 4) {
        $error = 'Username must be at least 4 characters';
    } elseif ($confirm_password !== $adminData['password']) {
        $error = 'Password is incorrect';
    } else {
        if ($db->updateAdminUsername($adminData['id'], $new_username)) {
            $_SESSION['settings_success'] = 'Username changed successfully! Please use the new username to login next time.';
            header('Location: settings.php');
            exit();
        } else {
            $error = 'Failed to update username';
        }
    }
}

// Handle password change
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_password'])) {
    $current_password = $_POST['current_password'] ?? '';
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password_new'] ?? '';
    
    if ($current_password !== $adminData['password']) {
        $error = 'Current password is incorrect';
    } elseif ($new_password !== $confirm_password) {
        $error = 'New passwords do not match';
    } elseif (strlen($new_password) < 8) {
        $error = 'New password must be at least 8 characters';
    } else {
        if ($db->updateAdminPassword($adminData['id'], $new_password)) {
            $_SESSION['settings_success'] = 'Password changed successfully!';
            header('Location: settings.php');
            exit();
        } else {
            $error = 'Failed to update password';
        }
    }
}

// Handle profile update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    
    if (empty($name)) {
        $error = 'Name cannot be empty';
    } else {
        if ($db->updateAdminProfile($adminData['id'], $name, $email)) {
            $_SESSION['admin_name'] = $name;
            $_SESSION['settings_success'] = 'Profile updated successfully!';
            header('Location: settings.php');
            exit();
        } else {
            $error = 'Failed to update profile';
        }
    }
}

// Check for success message from redirect
if (isset($_SESSION['settings_success'])) {
    $success = $_SESSION['settings_success'];
    unset($_SESSION['settings_success']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Admin Dashboard</title>
    
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/admin.css" rel="stylesheet">
</head>
<body>
    
    <?php include 'includes/sidebar.php'; ?>
    
    <div class="main-content">
        <?php include 'includes/topbar.php'; ?>
        
        <div class="content-wrapper">
            <div class="page-header">
                <h1>Settings</h1>
                <p>Manage admin account and system settings</p>
            </div>
            
            <?php if ($success): ?>
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i> <?php echo $success; ?>
                </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-danger">
                    <i class="bi bi-exclamation-circle"></i> <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="activity-card">
                        <div class="card-header">
                            <h5><i class="bi bi-person-circle"></i> Admin Profile</h5>
                        </div>
                        <div class="card-body" style="padding: 30px;">
                            <form method="POST" action="settings.php">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <label>Full Name</label>
                                            <input type="text" name="name" class="form-control" required 
                                                   value="<?php echo htmlspecialchars($adminData['name']); ?>"
                                                   style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <label>Email Address</label>
                                            <input type="email" name="email" class="form-control" 
                                                   value="<?php echo htmlspecialchars($adminData['email'] ?? ''); ?>"
                                                   style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <label>Username</label>
                                            <input type="text" class="form-control" readonly 
                                                   value="<?php echo htmlspecialchars($adminData['username']); ?>"
                                                   style="width: 100%; padding: 10px; border: 2px solid #e0e0e0; background: #f8f9fa;">
                                            <small style="color: #666; font-size: 12px;">Use the form below to change username</small>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group" style="margin-bottom: 20px;">
                                            <label>Role</label>
                                            <input type="text" class="form-control" readonly value="Administrator"
                                                   style="width: 100%; padding: 10px; border: 2px solid #e0e0e0; background: #f8f9fa;">
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="submit" name="update_profile" class="btn-primary">
                                    <i class="bi bi-check-circle"></i> Update Profile
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row" style="margin-top: 30px;">
                <div class="col-md-6">
                    <div class="activity-card">
                        <div class="card-header">
                            <h5><i class="bi bi-person-badge"></i> Change Username</h5>
                        </div>
                        <div class="card-body" style="padding: 30px;">
                            <form method="POST" action="settings.php">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label>Current Username</label>
                                    <input type="text" class="form-control" readonly 
                                           value="<?php echo htmlspecialchars($adminData['username']); ?>"
                                           style="width: 100%; padding: 10px; border: 2px solid #e0e0e0; background: #f8f9fa;">
                                </div>
                                
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label>New Username</label>
                                    <input type="text" name="new_username" class="form-control" required 
                                           style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                    <small style="color: #666; font-size: 12px;">Minimum 4 characters</small>
                                </div>
                                
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" required 
                                           style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                    <small style="color: #666; font-size: 12px;">Enter your current password to confirm</small>
                                </div>
                                
                                <button type="submit" name="change_username" class="btn-primary">
                                    <i class="bi bi-check-circle"></i> Change Username
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                        <div class="card-header">
                            <h5><i class="bi bi-shield-lock"></i> Change Password</h5>
                        </div>
                        <div class="card-body" style="padding: 30px;">
                            <form method="POST" action="settings.php">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label>Current Password</label>
                                    <input type="password" name="current_password" class="form-control" required style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                </div>
                                
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label>New Password</label>
                                    <input type="password" name="new_password" class="form-control" required style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                </div>
                                
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label>Confirm New Password</label>
                                    <input type="password" name="confirm_password_new" class="form-control" required style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                </div>
                                
                                <button type="submit" name="change_password" class="btn-primary">
                                    <i class="bi bi-check-circle"></i> Update Password
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row" style="margin-top: 30px;">
                <div class="col-md-12">
                    <div class="activity-card">
                        <div class="card-header">
                            <h5><i class="bi bi-info-circle"></i> Company Information</h5>
                        </div>
                        <div class="card-body" style="padding: 30px;">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <label>Company Name</label>
                                        <p><strong><?php echo COMPANY_NAME; ?></strong></p>
                                    </div>
                                    <div class="info-item">
                                        <label>Email</label>
                                        <p><?php echo COMPANY_EMAIL; ?></p>
                                    </div>
                                    <div class="info-item">
                                        <label>Phone</label>
                                        <p><?php echo COMPANY_PHONE; ?></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-item">
                                        <label>Address</label>
                                        <p><?php echo COMPANY_ADDRESS; ?></p>
                                    </div>
                                    <div class="info-item">
                                        <label>Registration Number</label>
                                        <p><?php echo COMPANY_REGISTRATION; ?></p>
                                    </div>
                                    <div class="info-item">
                                        <label>Website</label>
                                        <p><?php echo COMPANY_WEBSITE; ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row" style="margin-top: 30px;">
                <div class="col-md-12">
                    <div class="activity-card">
                        <div class="card-header">
                            <h5><i class="bi bi-shield-check"></i> Security Information</h5>
                        </div>
                        <div class="card-body" style="padding: 30px;">
                            <div class="security-info">
                                <p><i class="bi bi-shield-check"></i> Security monitored by <strong>Synthilogic Enterprise</strong></p>
                                <p><i class="bi bi-lock"></i> All admin actions are logged and monitored</p>
                                <p><i class="bi bi-database"></i> Database: MySQL (<?php echo DB_NAME; ?>)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <?php include 'includes/footer.php'; ?>
    </div>
    
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/admin.js"></script>
</body>
</html>
