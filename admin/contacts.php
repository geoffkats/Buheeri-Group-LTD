<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit();
}

require_once '../config.php';
require_once '../includes/database.php';

$db = new Database();

// Check if viewing single contact
$viewContact = null;
if (isset($_GET['id']) && !isset($_GET['action'])) {
    $viewContact = $db->getContactById($_GET['id']);
}

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    $db->deleteContact($_GET['id']);
    header('Location: contacts.php?deleted=1');
    exit();
}

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 20;

// Get all contacts with pagination
$contacts = $db->getAllContacts($page, $perPage);
$totalContacts = $db->getContactCount();
$totalPages = ceil($totalContacts / $perPage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages - Admin Dashboard</title>
    
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/css/admin.css" rel="stylesheet">
</head>
<body>
    
    <?php include 'includes/sidebar.php'; ?>
    
    <div class="main-content">
        <?php include 'includes/topbar.php'; ?>
        
        <div class="content-wrapper">
            <?php if ($viewContact): ?>
                <!-- Single Contact View -->
                <div class="page-header">
                    <h1>Contact Message Details</h1>
                    <p>Full message information</p>
                </div>
                
                <div style="margin-bottom: 20px;">
                    <a href="contacts.php" class="btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back to All Messages
                    </a>
                </div>
                
                <div class="activity-card">
                    <div class="card-header">
                        <h5><i class="bi bi-envelope-open"></i> Message from <?php echo htmlspecialchars($viewContact['name']); ?></h5>
                        <div style="display: flex; gap: 10px;">
                            <a href="mailto:<?php echo htmlspecialchars($viewContact['email']); ?>" class="btn-primary" style="padding: 8px 16px; font-size: 13px;">
                                <i class="bi bi-reply"></i> Reply via Email
                            </a>
                            <a href="?action=delete&id=<?php echo $viewContact['id']; ?>" class="btn-action btn-delete" 
                               onclick="return confirm('Are you sure you want to delete this message?')" 
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
                                        <?php echo htmlspecialchars($viewContact['name']); ?>
                                    </p>
                                </div>
                                
                                <div class="info-item" style="margin-bottom: 25px;">
                                    <label style="font-size: 12px; font-weight: 700; color: var(--primary-color); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                                        <i class="bi bi-envelope"></i> Email Address
                                    </label>
                                    <p style="font-size: 16px; margin: 0;">
                                        <a href="mailto:<?php echo htmlspecialchars($viewContact['email']); ?>" style="color: var(--primary-color); text-decoration: none; font-weight: 500;">
                                            <?php echo htmlspecialchars($viewContact['email']); ?>
                                        </a>
                                    </p>
                                </div>
                                
                                <div class="info-item" style="margin-bottom: 25px;">
                                    <label style="font-size: 12px; font-weight: 700; color: var(--primary-color); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                                        <i class="bi bi-telephone"></i> Phone Number
                                    </label>
                                    <p style="font-size: 16px; margin: 0; color: var(--dark-color);">
                                        <?php echo htmlspecialchars($viewContact['phone'] ?? 'Not provided'); ?>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="info-item" style="margin-bottom: 25px;">
                                    <label style="font-size: 12px; font-weight: 700; color: var(--primary-color); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                                        <i class="bi bi-building"></i> Division
                                    </label>
                                    <p style="font-size: 16px; margin: 0;">
                                        <span class="badge-division"><?php echo htmlspecialchars($viewContact['division'] ?? 'General Inquiry'); ?></span>
                                    </p>
                                </div>
                                
                                <div class="info-item" style="margin-bottom: 25px;">
                                    <label style="font-size: 12px; font-weight: 700; color: var(--primary-color); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                                        <i class="bi bi-calendar"></i> Date Received
                                    </label>
                                    <p style="font-size: 16px; margin: 0; color: var(--dark-color);">
                                        <?php echo date('F j, Y \a\t g:i A', strtotime($viewContact['created_at'])); ?>
                                    </p>
                                </div>
                                
                                <div class="info-item" style="margin-bottom: 25px;">
                                    <label style="font-size: 12px; font-weight: 700; color: var(--primary-color); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 8px; display: block;">
                                        <i class="bi bi-tag"></i> Subject
                                    </label>
                                    <p style="font-size: 16px; font-weight: 600; margin: 0; color: var(--dark-color);">
                                        <?php echo htmlspecialchars($viewContact['subject']); ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div style="margin-top: 30px; padding-top: 30px; border-top: 2px solid var(--border-color);">
                            <label style="font-size: 12px; font-weight: 700; color: var(--primary-color); text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 15px; display: block;">
                                <i class="bi bi-chat-left-text"></i> Full Message
                            </label>
                            <div style="background: #f8f9fa; padding: 25px; border-left: 4px solid var(--primary-color); font-size: 15px; line-height: 1.8; color: var(--dark-color);">
                                <?php echo nl2br(htmlspecialchars($viewContact['message'])); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
            <?php else: ?>
                <!-- Contact List View -->
                <div class="page-header">
                    <h1>Contact Messages</h1>
                    <p>Manage all contact form submissions</p>
                </div>
                
                <?php if (isset($_GET['deleted'])): ?>
                    <div class="alert alert-success">
                        <i class="bi bi-check-circle"></i> Contact message deleted successfully!
                    </div>
                <?php endif; ?>
                
                <div class="activity-card">
                <div class="card-header">
                    <h5><i class="bi bi-envelope"></i> All Contact Messages (<?php echo $totalContacts; ?>)</h5>
                </div>
                <div class="card-body" style="padding: 0;">
                    <?php if (empty($contacts)): ?>
                        <div class="no-data">No contact messages yet.</div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Subject</th>
                                        <th>Division</th>
                                        <th>Message</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($contacts as $contact): ?>
                                    <tr>
                                        <td><?php echo date('M j, Y H:i', strtotime($contact['created_at'])); ?></td>
                                        <td><strong><?php echo htmlspecialchars($contact['name']); ?></strong></td>
                                        <td><?php echo htmlspecialchars($contact['email']); ?></td>
                                        <td><?php echo htmlspecialchars($contact['phone'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($contact['subject']); ?></td>
                                        <td><span class="badge-division"><?php echo htmlspecialchars($contact['division'] ?? 'General'); ?></span></td>
                                        <td class="message-cell"><?php echo htmlspecialchars(substr($contact['message'], 0, 100)) . (strlen($contact['message']) > 100 ? '...' : ''); ?></td>
                                        <td>
                                            <div style="display: flex; gap: 5px;">
                                                <a href="?id=<?php echo $contact['id']; ?>" class="btn-action btn-edit" title="View Full Message">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                                <a href="?action=delete&id=<?php echo $contact['id']; ?>" class="btn-action btn-delete" onclick="return confirm('Are you sure you want to delete this message?')" title="Delete">
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
                                Showing page <?php echo $page; ?> of <?php echo $totalPages; ?> (<?php echo $totalContacts; ?> total messages)
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
