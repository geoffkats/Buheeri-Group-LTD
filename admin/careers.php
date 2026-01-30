<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

require_once '../config.php';
require_once '../includes/database.php';

$db = new Database();

// Check if viewing single application
$viewApplication = null;
if (isset($_GET['id']) && !isset($_GET['action'])) {
    $viewApplication = $db->getApplicationById($_GET['id']);
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $application = $db->getApplicationById($_GET['id']);
    if ($application && $application['cv_filename']) {
        $cvPath = '../uploads/' . $application['cv_filename'];
        if (file_exists($cvPath)) {
            unlink($cvPath);
        }
    }
    $db->deleteApplication($_GET['id']);
    header('Location: careers.php?deleted=1');
    exit();
}

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 20;

// Get all applications with pagination
$applications = $db->getAllApplications($page, $perPage);
$totalApplications = $db->getCareerApplicationCount();
$totalPages = ceil($totalApplications / $perPage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Career Applications - Admin Dashboard</title>
    
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/admin.css" rel="stylesheet">
</head>
<body>
    
    <?php include 'includes/sidebar.php'; ?>
    
    <div class="main-content">
        <?php include 'includes/topbar.php'; ?>
        
        <div class="content-wrapper">
            <?php if ($viewApplication): ?>
                <!-- Single Application View -->
                <div class="page-header">
                    <h1>Career Application Details</h1>
                    <p>Full application information</p>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <a href="careers.php" class="btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to All Applications
                    </a>
                </div>
                
                <div class="activity-card">
                    <div class="card-header">
                        <h5><i class="bi bi-person-badge"></i> Application from <?php echo htmlspecialchars($viewApplication['name']); ?></h5>
                        <div style="display: flex; gap: 10px;">
                            <a href="mailto:<?php echo htmlspecialchars($viewApplication['email']); ?>" class="btn-primary" style="padding: 8px 16px; font-size: 13px;">
                                <i class="bi bi-reply"></i> Reply via Email
                            </a>
                            <?php if ($viewApplication['cv_filename']): ?>
                                <a href="../uploads/<?php echo htmlspecialchars($viewApplication['cv_filename']); ?>" target="_blank" class="btn-primary" style="padding: 8px 16px; font-size: 13px; background: var(--success-color); border-color: var(--success-color);">
                                    <i class="bi bi-download"></i> Download CV
                                </a>
                            <?php endif; ?>
                            <a href="?action=delete&id=<?php echo $viewApplication['id']; ?>" class="btn-action btn-delete" 
                               onclick="return confirm('Are you sure you want to delete this application?')" 
                               style="width: auto; padding: 8px 16px;">
                                <i class="bi bi-trash"></i> Delete
                            </a>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 40px;">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item" style="margin-bottom: 25px;">
                                    <label style="font-size: 12px; font-weight: 700; color: var(--primary-color); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                                        <i class="bi bi-person-circle"></i> Full Name
                                    </label>
                                    <p style="font-size: 16px; font-weight: 600; margin: 0; color: var(--dark-color);">
                                        <?php echo htmlspecialchars($viewApplication['name']); ?>
                                    </p>
                                </div>
                                
                                <div class="info-item" style="margin-bottom: 25px;">
                                    <label style="font-size: 12px; font-weight: 700; color: var(--primary-color); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                                        <i class="bi bi-envelope"></i> Email Address
                                    </label>
                                    <p style="font-size: 16px; margin: 0;">
                                        <a href="mailto:<?php echo htmlspecialchars($viewApplication['email']); ?>" style="color: var(--primary-color); text-decoration: none; font-weight: 500;">
                                            <?php echo htmlspecialchars($viewApplication['email']); ?>
                                        </a>
                                    </p>
                                </div>
                                
                                <div class="info-item" style="margin-bottom: 25px;">
                                    <label style="font-size: 12px; font-weight: 700; color: var(--primary-color); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                                        <i class="bi bi-telephone"></i> Phone Number
                                    </label>
                                    <p style="font-size: 16px; margin: 0; color: var(--dark-color);">
                                        <?php echo htmlspecialchars($viewApplication['phone'] ?? 'Not provided'); ?>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="info-item" style="margin-bottom: 25px;">
                                    <label style="font-size: 12px; font-weight: 700; color: var(--primary-color); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                                        <i class="bi bi-briefcase"></i> Position Applied For
                                    </label>
                                    <p style="font-size: 16px; font-weight: 600; margin: 0;">
                                        <span class="badge-division" style="font-size: 14px; padding: 8px 16px;"><?php echo htmlspecialchars($viewApplication['position']); ?></span>
                                    </p>
                                </div>
                                
                                <div class="info-item" style="margin-bottom: 25px;">
                                    <label style="font-size: 12px; font-weight: 700; color: var(--primary-color); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                                        <i class="bi bi-calendar"></i> Date Applied
                                    </label>
                                    <p style="font-size: 16px; margin: 0; color: var(--dark-color);">
                                        <?php echo date('F j, Y \a\t g:i A', strtotime($viewApplication['created_at'])); ?>
                                    </p>
                                </div>
                                
                                <div class="info-item" style="margin-bottom: 25px;">
                                    <label style="font-size: 12px; font-weight: 700; color: var(--primary-color); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                                        <i class="bi bi-file-earmark-pdf"></i> CV/Resume
                                    </label>
                                    <?php if ($viewApplication['cv_filename']): ?>
                                        <div style="background: #e8f5e9; padding: 15px; border-left: 4px solid var(--success-color); display: flex; align-items: center; gap: 12px;">
                                            <i class="bi bi-file-earmark-pdf" style="font-size: 32px; color: var(--success-color);"></i>
                                            <div style="flex: 1;">
                                                <p style="margin: 0; font-weight: 600; color: var(--dark-color);">
                                                    <?php echo htmlspecialchars($viewApplication['cv_filename']); ?>
                                                </p>
                                                <a href="../uploads/<?php echo htmlspecialchars($viewApplication['cv_filename']); ?>" target="_blank" style="color: var(--success-color); font-size: 13px; text-decoration: none; font-weight: 600;">
                                                    <i class="bi bi-download"></i> Download File
                                                </a>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <p style="font-size: 16px; margin: 0; color: #999;">No CV uploaded</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div style="margin-top: 30px; padding-top: 30px; border-top: 2px solid var(--border-color);">
                            <label style="font-size: 12px; font-weight: 700; color: var(--primary-color); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 15px; display: block;">
                                <i class="bi bi-chat-left-text"></i> Cover Letter
                            </label>
                            <div style="background: #f8f9fa; padding: 25px; border-left: 4px solid var(--primary-color); font-size: 15px; line-height: 1.8; color: var(--dark-color);">
                                <?php echo nl2br(htmlspecialchars($viewApplication['cover_letter'])); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
            <?php else: ?>
                <!-- Applications List View -->
                <div class="page-header">
                    <h1>Career Applications</h1>
                    <p>Manage all job applications and CVs</p>
                </div>
                
                <?php if (isset($_GET['deleted'])): ?>
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle"></i> Application deleted successfully!
                    </div>
                <?php endif; ?>
                
                <div class="activity-card">
                <div class="card-header">
                    <h5><i class="bi bi-person-check"></i> All Career Applications (<?php echo $totalApplications; ?>)</h5>
                </div>
                <div class="card-body" style="padding: 0;">
                    <?php if (empty($applications)): ?>
                        <div class="no-data">No career applications yet.</div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Position</th>
                                        <th>Experience</th>
                                        <th>CV</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($applications as $application): ?>
                                    <tr>
                                        <td><?php echo date('M j, Y H:i', strtotime($application['created_at'])); ?></td>
                                        <td><strong><?php echo htmlspecialchars($application['name']); ?></strong></td>
                                        <td><?php echo htmlspecialchars($application['email']); ?></td>
                                        <td><?php echo htmlspecialchars($application['phone'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($application['position']); ?></td>
                                        <td><?php echo htmlspecialchars($application['experience'] ?? 'N/A'); ?></td>
                                        <td>
                                            <?php if ($application['cv_filename']): ?>
                                                <a href="../uploads/<?php echo htmlspecialchars($application['cv_filename']); ?>" target="_blank" class="btn-download">
                                                    <i class="bi bi-download"></i> Download
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted">No file</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <div style="display: flex; gap: 5px;">
                                                <a href="?id=<?php echo $application['id']; ?>" class="btn-action btn-edit" title="View Full Application">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="?action=delete&id=<?php echo $application['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Are you sure you want to delete this application?')" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                        <?php if ($totalPages > 1): ?>
                        <div class="pagination-wrapper">
                            <div class="pagination">
                                <?php if ($page > 1): ?>
                                    <a href="?page=<?php echo $page - 1; ?>" class="page-link">
                                        <i class="bi bi-chevron-left"></i> Previous
                                    </a>
                                <?php endif; ?>
                                
                                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                    <?php if ($i == $page): ?>
                                        <span class="page-link active"><?php echo $i; ?></span>
                                    <?php else: ?>
                                        <a href="?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
                                    <?php endif; ?>
                                <?php endfor; ?>
                                
                                <?php if ($page < $totalPages): ?>
                                    <a href="?page=<?php echo $page + 1; ?>" class="page-link">
                                        Next <i class="bi bi-chevron-right"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="pagination-info">
                                Showing page <?php echo $page; ?> of <?php echo $totalPages; ?> (<?php echo $totalApplications; ?> total applications)
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        
        <?php include 'includes/footer.php'; ?>
    </div>
    
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/admin.js"></script>
</body>
</html>
