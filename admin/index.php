<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

require_once '../includes/database.php';
$db = new Database();

// Get dashboard statistics
$stats = [
    'contacts' => $db->getContactCount(),
    'careers' => $db->getCareerApplicationCount(),
    'projects' => $db->getProjectCount(),
    'recent_contacts' => $db->getRecentContacts(5),
    'recent_applications' => $db->getRecentApplications(5)
];

$page_title = "Admin Dashboard - Buheeri Group U Ltd";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page_title; ?></title>
    
    <!-- Vendor CSS -->
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Admin CSS -->
    <link href="assets/css/admin.css" rel="stylesheet">
</head>
<body>
    
    <?php include 'includes/sidebar.php'; ?>
    
    <div class="main-content">
        <?php include 'includes/topbar.php'; ?>
        
        <div class="content-wrapper">
            <div class="container-fluid">
                
                <!-- Page Header -->
                <div class="page-header">
                    <h1>Dashboard</h1>
                    <p>Welcome back, <?php echo htmlspecialchars($_SESSION['admin_name'] ?? 'Admin'); ?></p>
                </div>
                
                <!-- Statistics Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon contacts">
                                <i class="bi bi-envelope"></i>
                            </div>
                            <div class="stat-details">
                                <h3><?php echo $stats['contacts']; ?></h3>
                                <p>Contact Messages</p>
                            </div>
                            <a href="contacts.php" class="stat-link">View All <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon careers">
                                <i class="bi bi-briefcase"></i>
                            </div>
                            <div class="stat-details">
                                <h3><?php echo $stats['careers']; ?></h3>
                                <p>Career Applications</p>
                            </div>
                            <a href="careers.php" class="stat-link">View All <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon projects">
                                <i class="bi bi-folder"></i>
                            </div>
                            <div class="stat-details">
                                <h3><?php echo $stats['projects']; ?></h3>
                                <p>Featured Projects</p>
                            </div>
                            <a href="projects.php" class="stat-link">Manage <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon settings">
                                <i class="bi bi-gear"></i>
                            </div>
                            <div class="stat-details">
                                <h3>Settings</h3>
                                <p>System Configuration</p>
                            </div>
                            <a href="settings.php" class="stat-link">Configure <i class="bi bi-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
                
                <!-- Recent Activity -->
                <div class="row g-4">
                    <!-- Recent Contacts -->
                    <div class="col-lg-6">
                        <div class="activity-card">
                            <div class="card-header">
                                <h5><i class="bi bi-envelope"></i> Recent Contact Messages</h5>
                                <a href="contacts.php" class="view-all">View All</a>
                            </div>
                            <div class="card-body">
                                <?php if (empty($stats['recent_contacts'])): ?>
                                    <p class="no-data">No contact messages yet</p>
                                <?php else: ?>
                                    <div class="activity-list">
                                        <?php foreach ($stats['recent_contacts'] as $contact): ?>
                                            <div class="activity-item">
                                                <div class="activity-icon">
                                                    <i class="bi bi-person-circle"></i>
                                                </div>
                                                <div class="activity-content">
                                                    <h6><?php echo htmlspecialchars($contact['name']); ?></h6>
                                                    <p><?php echo htmlspecialchars($contact['subject']); ?></p>
                                                    <span class="activity-time"><?php echo date('M d, Y', strtotime($contact['created_at'])); ?></span>
                                                </div>
                                                <a href="contacts.php?id=<?php echo $contact['id']; ?>" class="activity-action">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Recent Career Applications -->
                    <div class="col-lg-6">
                        <div class="activity-card">
                            <div class="card-header">
                                <h5><i class="bi bi-briefcase"></i> Recent Career Applications</h5>
                                <a href="careers.php" class="view-all">View All</a>
                            </div>
                            <div class="card-body">
                                <?php if (empty($stats['recent_applications'])): ?>
                                    <p class="no-data">No career applications yet</p>
                                <?php else: ?>
                                    <div class="activity-list">
                                        <?php foreach ($stats['recent_applications'] as $application): ?>
                                            <div class="activity-item">
                                                <div class="activity-icon">
                                                    <i class="bi bi-person-badge"></i>
                                                </div>
                                                <div class="activity-content">
                                                    <h6><?php echo htmlspecialchars($application['name']); ?></h6>
                                                    <p><?php echo htmlspecialchars($application['position']); ?></p>
                                                    <span class="activity-time"><?php echo date('M d, Y', strtotime($application['created_at'])); ?></span>
                                                </div>
                                                <a href="careers.php?id=<?php echo $application['id']; ?>" class="activity-action">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
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
