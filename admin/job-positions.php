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

// Handle delete action
if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
    if ($db->deleteJobPosition($_GET['id'])) {
        header('Location: job-positions.php?deleted=1');
        exit();
    } else {
        $error = 'Failed to delete job position';
    }
}

// Handle add/edit job position
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $title = $_POST['title'] ?? '';
    $division = $_POST['division'] ?? '';
    $location = $_POST['location'] ?? '';
    $type = $_POST['type'] ?? 'full-time';
    $description = $_POST['description'] ?? '';
    $requirements = $_POST['requirements'] ?? '';
    $status = $_POST['status'] ?? 'active';
    
    if ($id) {
        // Update existing position
        if ($db->updateJobPosition($id, $title, $division, $location, $type, $description, $requirements, $status)) {
            $success = 'Job position updated successfully!';
        } else {
            $error = 'Failed to update job position';
        }
    } else {
        // Add new position
        if ($db->addJobPosition($title, $division, $location, $type, $description, $requirements, $status)) {
            $success = 'Job position added successfully!';
        } else {
            $error = 'Failed to add job position';
        }
    }
}

// Get position for editing
$editPosition = null;
if (isset($_GET['edit']) && $_GET['edit']) {
    $editPosition = $db->getJobPositionById($_GET['edit']);
}

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10;

// Get all positions with pagination
$positions = $db->getAllJobPositions($page, $perPage);
$totalPositions = $db->getJobPositionCount();
$totalPages = ceil($totalPositions / $perPage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Positions - Admin Dashboard</title>
    
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
                <h1>Job Positions</h1>
                <p>Manage available job positions and career opportunities</p>
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
            
            <?php if (isset($_GET['deleted'])): ?>
                <div class="alert alert-success">
                    <i class="bi bi-check-circle"></i> Job position deleted successfully!
                </div>
            <?php endif; ?>
            
            <!-- Add/Edit Position Form -->
            <div class="activity-card" style="margin-bottom: 30px;">
                <div class="card-header">
                    <h5><i class="bi bi-plus-circle"></i> <?php echo $editPosition ? 'Edit Job Position' : 'Add New Job Position'; ?></h5>
                </div>
                <div class="card-body" style="padding: 30px;">
                    <form method="POST" action="job-positions.php">
                        <?php if ($editPosition): ?>
                            <input type="hidden" name="id" value="<?php echo $editPosition['id']; ?>">
                        <?php endif; ?>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label>Job Title *</label>
                                    <input type="text" name="title" class="form-control" required 
                                           value="<?php echo htmlspecialchars($editPosition['title'] ?? ''); ?>"
                                           style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label>Division *</label>
                                    <select name="division" class="form-control" required 
                                            style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                        <option value="">Select Division</option>
                                        <option value="consultancy" <?php echo (isset($editPosition['division']) && $editPosition['division'] === 'consultancy') ? 'selected' : ''; ?>>Consultancy Services</option>
                                        <option value="construction" <?php echo (isset($editPosition['division']) && $editPosition['division'] === 'construction') ? 'selected' : ''; ?>>Construction</option>
                                        <option value="logistics" <?php echo (isset($editPosition['division']) && $editPosition['division'] === 'logistics') ? 'selected' : ''; ?>>Logistics & Freight</option>
                                        <option value="labour" <?php echo (isset($editPosition['division']) && $editPosition['division'] === 'labour') ? 'selected' : ''; ?>>Labour Recruitment</option>
                                        <option value="supply" <?php echo (isset($editPosition['division']) && $editPosition['division'] === 'supply') ? 'selected' : ''; ?>>General Supply</option>
                                        <option value="general" <?php echo (isset($editPosition['division']) && $editPosition['division'] === 'general') ? 'selected' : ''; ?>>General/Admin</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label>Location</label>
                                    <input type="text" name="location" class="form-control" 
                                           value="<?php echo htmlspecialchars($editPosition['location'] ?? 'Tororo, Uganda'); ?>"
                                           style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label>Employment Type</label>
                                    <select name="type" class="form-control" 
                                            style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                        <option value="full-time" <?php echo (isset($editPosition['type']) && $editPosition['type'] === 'full-time') ? 'selected' : ''; ?>>Full-time</option>
                                        <option value="part-time" <?php echo (isset($editPosition['type']) && $editPosition['type'] === 'part-time') ? 'selected' : ''; ?>>Part-time</option>
                                        <option value="contract" <?php echo (isset($editPosition['type']) && $editPosition['type'] === 'contract') ? 'selected' : ''; ?>>Contract</option>
                                        <option value="internship" <?php echo (isset($editPosition['type']) && $editPosition['type'] === 'internship') ? 'selected' : ''; ?>>Internship</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label>Status</label>
                                    <select name="status" class="form-control" 
                                            style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                        <option value="active" <?php echo (isset($editPosition['status']) && $editPosition['status'] === 'active') ? 'selected' : ''; ?>>Active</option>
                                        <option value="closed" <?php echo (isset($editPosition['status']) && $editPosition['status'] === 'closed') ? 'selected' : ''; ?>>Closed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label>Job Description</label>
                            <textarea name="description" class="form-control" rows="4" 
                                      style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;"><?php echo htmlspecialchars($editPosition['description'] ?? ''); ?></textarea>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label>Requirements</label>
                            <textarea name="requirements" class="form-control" rows="4" 
                                      style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;"><?php echo htmlspecialchars($editPosition['requirements'] ?? ''); ?></textarea>
                        </div>
                        
                        <div style="display: flex; gap: 10px;">
                            <button type="submit" class="btn-primary">
                                <i class="bi bi-check-circle"></i> <?php echo $editPosition ? 'Update Position' : 'Add Position'; ?>
                            </button>
                            <?php if ($editPosition): ?>
                                <a href="job-positions.php" class="btn-secondary">
                                    <i class="bi bi-x-circle"></i> Cancel
                                </a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Positions List -->
            <div class="activity-card">
                <div class="card-header">
                    <h5><i class="bi bi-briefcase"></i> All Job Positions (<?php echo $totalPositions; ?>)</h5>
                </div>
                <div class="card-body" style="padding: 0;">
                    <?php if (empty($positions)): ?>
                        <div class="no-data">No job positions yet.</div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Division</th>
                                        <th>Location</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Posted</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($positions as $position): ?>
                                    <tr>
                                        <td><strong><?php echo htmlspecialchars($position['title']); ?></strong></td>
                                        <td><span class="badge-category"><?php echo ucfirst(htmlspecialchars($position['division'])); ?></span></td>
                                        <td><?php echo htmlspecialchars($position['location'] ?? 'N/A'); ?></td>
                                        <td><?php echo ucfirst(htmlspecialchars($position['type'])); ?></td>
                                        <td>
                                            <?php if ($position['status'] === 'active'): ?>
                                                <span class="badge-status status-active">Active</span>
                                            <?php else: ?>
                                                <span class="badge-status status-completed">Closed</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo date('M j, Y', strtotime($position['created_at'])); ?></td>
                                        <td>
                                            <div style="display: flex; gap: 5px;">
                                                <a href="?edit=<?php echo $position['id']; ?>" class="btn-action btn-edit" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="?action=delete&id=<?php echo $position['id']; ?>" class="btn-action btn-delete" 
                                                   onclick="return confirm('Are you sure you want to delete this position?')" title="Delete">
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
                                Showing page <?php echo $page; ?> of <?php echo $totalPages; ?> (<?php echo $totalPositions; ?> total positions)
                            </div>
                        </div>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        
        <?php include 'includes/footer.php'; ?>
    </div>
    
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/admin.js"></script>
</body>
</html>
