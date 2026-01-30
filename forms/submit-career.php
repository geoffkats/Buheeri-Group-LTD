<?php
/**
 * Career Application Form Submission Handler
 * Handles career application form submissions and file uploads
 */

session_start();

// Load configuration and dependencies
require_once '../config.php';
require_once '../includes/database.php';
require_once '../includes/mailer.php';

// Initialize response
$response = [
    'success' => false,
    'message' => '',
    'errors' => []
];

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['errors'][] = 'Invalid request method';
    echo json_encode($response);
    exit;
}

try {
    $db = new Database();
    
    // Validate required fields
    $required_fields = ['name', 'email', 'phone', 'position', 'cover_letter'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $response['errors'][] = ucfirst(str_replace('_', ' ', $field)) . ' is required';
        }
    }
    
    // Validate email format
    if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $response['errors'][] = 'Invalid email format';
    }
    
    // Handle CV file upload
    $cv_filename = null;
    $cv_path = null;
    
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
        $upload_dir = '../uploads/';
        
        // Create uploads directory if it doesn't exist
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        
        // Validate file size (5MB max)
        $max_size = 5 * 1024 * 1024; // 5MB
        if ($_FILES['cv']['size'] > $max_size) {
            $response['errors'][] = 'CV file size must be less than 5MB';
        }
        
        // Validate file extension
        $allowed_extensions = ['pdf', 'doc', 'docx'];
        $file_extension = strtolower(pathinfo($_FILES['cv']['name'], PATHINFO_EXTENSION));
        
        if (!in_array($file_extension, $allowed_extensions)) {
            $response['errors'][] = 'Only PDF, DOC, and DOCX files are allowed';
        }
        
        // If no errors, upload the file
        if (empty($response['errors'])) {
            $cv_filename = 'cv_' . date('Y-m-d_H-i-s') . '_' . uniqid() . '.' . $file_extension;
            $cv_path = $upload_dir . $cv_filename;
            
            if (!move_uploaded_file($_FILES['cv']['tmp_name'], $cv_path)) {
                $response['errors'][] = 'Failed to upload CV file';
            }
        }
    } else {
        $response['errors'][] = 'CV/Resume is required';
    }
    
    // If no errors, save to database
    if (empty($response['errors'])) {
        // Sanitize input data
        $data = [
            'name' => htmlspecialchars(strip_tags(trim($_POST['name'])), ENT_QUOTES, 'UTF-8'),
            'email' => htmlspecialchars(strip_tags(trim($_POST['email'])), ENT_QUOTES, 'UTF-8'),
            'phone' => htmlspecialchars(strip_tags(trim($_POST['phone'])), ENT_QUOTES, 'UTF-8'),
            'position' => htmlspecialchars(strip_tags(trim($_POST['position'])), ENT_QUOTES, 'UTF-8'),
            'cover_letter' => htmlspecialchars(strip_tags(trim($_POST['cover_letter'])), ENT_QUOTES, 'UTF-8')
        ];
        
        // Save to database
        if ($db->saveCareerApplication($data, $cv_filename)) {
            $response['success'] = true;
            $response['message'] = 'Thank you for your application! We will review it and get back to you soon.';
            
            // Send email notification using PHPMailer
            try {
                $mailer = new Mailer();
                $mailer->sendCareerNotification($data, $cv_filename);
            } catch (Exception $e) {
                // Log error but don't fail the submission
                error_log("Email notification failed: " . $e->getMessage());
            }
            
        } else {
            $response['errors'][] = 'Failed to save your application. Please try again.';
        }
    }
    
} catch (Exception $e) {
    $response['errors'][] = 'An error occurred: ' . $e->getMessage();
}

// Store response in session for redirect
$_SESSION['form_response'] = $response;

// Redirect back to careers page
header('Location: ../careers.php#apply');
exit;
?>
