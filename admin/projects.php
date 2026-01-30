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
    if ($db->deleteProject($_GET['id'])) {
        header('Location: projects.php?deleted=1');
        exit();
    } else {
        $error = 'Failed to delete project';
    }
}

// Handle add/edit project
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $title = $_POST['title'] ?? '';
    $category = $_POST['category'] ?? '';
    $description = $_POST['description'] ?? '';
    $client = $_POST['client'] ?? '';
    $location = $_POST['location'] ?? '';
    $status = $_POST['status'] ?? 'active';
    $featured = isset($_POST['featured']) ? 1 : 0;
    $image = $_POST['existing_image'] ?? '';
    
    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '../assets/img/projects/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileName = time() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $image = 'assets/img/projects/' . $fileName;
        }
    }
    
    if ($id) {
        // Update existing project
        if ($db->updateProject($id, $title, $category, $description, $client, $location, $status, $featured, $image)) {
            $success = 'Project updated successfully!';
        } else {
            $error = 'Failed to update project';
        }
    } else {
        // Add new project
        if ($db->addProject($title, $category, $description, $client, $location, $status, $featured, $image)) {
            $success = 'Project added successfully!';
        } else {
            $error = 'Failed to add project';
        }
    }
}

// Get project for editing
$editProject = null;
if (isset($_GET['edit']) && $_GET['edit']) {
    $editProject = $db->getProjectById($_GET['edit']);
}

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$perPage = 10;

// Get all projects with pagination
$projects = $db->getAllProjects($page, $perPage);
$totalProjects = $db->getProjectCount();
$totalPages = ceil($totalProjects / $perPage);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Featured Projects - Admin Dashboard</title>
    
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
                <h1>Featured Projects</h1>
                <p>Manage all company projects and portfolio</p>
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
                    <i class="bi bi-check-circle"></i> Project deleted successfully!
                </div>
            <?php endif; ?>
            
            <!-- Add/Edit Project Form -->
            <div class="activity-card" style="margin-bottom: 30px;">
                <div class="card-header">
                    <h5><i class="bi bi-plus-circle"></i> <?php echo $editProject ? 'Edit Project' : 'Add New Project'; ?></h5>
                </div>
                <div class="card-body" style="padding: 30px;">
                    <form method="POST" action="projects.php" enctype="multipart/form-data">
                        <?php if ($editProject): ?>
                            <input type="hidden" name="id" value="<?php echo $editProject['id']; ?>">
                            <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($editProject['image_url'] ?? ''); ?>">
                        <?php endif; ?>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label>Project Title *</label>
                                    <input type="text" name="title" class="form-control" required 
                                           value="<?php echo htmlspecialchars($editProject['title'] ?? ''); ?>"
                                           style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label>Category *</label>
                                    <select name="category" class="form-control" required 
                                            style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                        <option value="">Select Category</option>
                                        <option value="construction" <?php echo (isset($editProject['category']) && $editProject['category'] === 'construction') ? 'selected' : ''; ?>>Construction</option>
                                        <option value="logistics" <?php echo (isset($editProject['category']) && $editProject['category'] === 'logistics') ? 'selected' : ''; ?>>Logistics</option>
                                        <option value="labour" <?php echo (isset($editProject['category']) && $editProject['category'] === 'labour') ? 'selected' : ''; ?>>Labour</option>
                                        <option value="supply" <?php echo (isset($editProject['category']) && $editProject['category'] === 'supply') ? 'selected' : ''; ?>>General Supply</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label>Client</label>
                                    <input type="text" name="client" class="form-control" 
                                           value="<?php echo htmlspecialchars($editProject['client'] ?? ''); ?>"
                                           style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label>Location</label>
                                    <input type="text" name="location" class="form-control" 
                                           value="<?php echo htmlspecialchars($editProject['location'] ?? ''); ?>"
                                           style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group" style="margin-bottom: 20px;">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="4" 
                                      style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;"><?php echo htmlspecialchars($editProject['description'] ?? ''); ?></textarea>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label>Status</label>
                                    <select name="status" class="form-control" 
                                            style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                        <option value="active" <?php echo (isset($editProject['status']) && $editProject['status'] === 'active') ? 'selected' : ''; ?>>Active</option>
                                        <option value="ongoing" <?php echo (isset($editProject['status']) && $editProject['status'] === 'ongoing') ? 'selected' : ''; ?>>Ongoing</option>
                                        <option value="completed" <?php echo (isset($editProject['status']) && $editProject['status'] === 'completed') ? 'selected' : ''; ?>>Completed</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label>Project Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/*"
                                           style="width: 100%; padding: 10px; border: 2px solid #e0e0e0;">
                                    <?php if ($editProject && isset($editProject['image_url']) && $editProject['image_url']): ?>
                                        <small style="color: #666;">Current: <?php echo basename($editProject['image_url']); ?></small>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <label style="display: block;">Featured Project</label>
                                    <label style="display: flex; align-items: center; gap: 10px; margin-top: 10px;">
                                        <input type="checkbox" name="featured" value="1" 
                                               <?php echo (isset($editProject['featured']) && $editProject['featured']) ? 'checked' : ''; ?>
                                               style="width: 20px; height: 20px;">
                                        <span>Mark as featured</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <div style="display: flex; gap: 10px;">
                            <button type="submit" class="btn-primary">
                                <i class="bi bi-check-circle"></i> <?php echo $editProject ? 'Update Project' : 'Add Project'; ?>
                            </button>
                            <?php if ($editProject): ?>
                                <a href="projects.php" class="btn-secondary">
                                    <i class="bi bi-x-circle"></i> Cancel
                                </a>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Projects List -->
            <div class="activity-card">
                <div class="card-header">
                    <h5><i class="bi bi-briefcase"></i> All Projects (<?php echo $totalProjects; ?>)</h5>
                </div>
                <div class="card-body" style="padding: 0;">
                    <?php if (empty($projects)): ?>
                        <div class="no-data">No projects yet.</div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="admin-table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Client</th>
                                        <th>Location</th>
                                        <th>Status</th>
                                        <th>Featured</th>
                                        <th>Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($projects as $project): ?>
                                    <tr>
                                        <td>
                                            <?php if (isset($project['image_url']) && $project['image_url']): ?>
                                                <img src="../<?php echo htmlspecialchars($project['image_url']); ?>" alt="Project" class="project-thumb">
                                            <?php else: ?>
                                                <div class="project-thumb-placeholder">
                                                    <i class="bi bi-image"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td><strong><?php echo htmlspecialchars($project['title']); ?></strong></td>
                                        <td><span class="badge-category"><?php echo ucfirst(htmlspecialchars($project['category'])); ?></span></td>
                                        <td><?php echo htmlspecialchars($project['client'] ?? 'N/A'); ?></td>
                                        <td><?php echo htmlspecialchars($project['location'] ?? 'N/A'); ?></td>
                                        <td>
                                            <?php if (isset($project['status']) && $project['status'] === 'completed'): ?>
                                                <span class="badge-status status-completed">Completed</span>
                                            <?php elseif (isset($project['status']) && $project['status'] === 'ongoing'): ?>
                                                <span class="badge-status status-ongoing">Ongoing</span>
                                            <?php else: ?>
                                                <span class="badge-status status-active">Active</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php if (isset($project['featured']) && $project['featured']): ?>
                                                <span class="badge-featured"><i class="bi bi-star-fill"></i> Featured</span>
                                            <?php else: ?>
                                                <span class="text-muted">No</span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo date('M j, Y', strtotime($project['created_at'])); ?></td>
                                        <td>
                                            <div style="display: flex; gap: 5px;">
                                                <a href="?edit=<?php echo $project['id']; ?>" class="btn-action btn-edit" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="?action=delete&id=<?php echo $project['id']; ?>" class="btn-action btn-delete" 
                                                   onclick="return confirm('Are you sure you want to delete this project?')" title="Delete">
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
                                Showing page <?php echo $page; ?> of <?php echo $totalPages; ?> (<?php echo $totalProjects; ?> total projects)
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
