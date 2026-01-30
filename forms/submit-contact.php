<?php
/**
 * Contact Form Submission Handler
 * Handles contact form submissions
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
    $required_fields = ['name', 'email', 'subject', 'message'];
    foreach ($required_fields as $field) {
        if (empty($_POST[$field])) {
            $response['errors'][] = ucfirst(str_replace('_', ' ', $field)) . ' is required';
        }
    }
    
    // Validate email format
    if (!empty($_POST['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $response['errors'][] = 'Invalid email format';
    }
    
    // If no errors, save to database
    if (empty($response['errors'])) {
        // Sanitize input data
        $data = [
            'name' => htmlspecialchars(strip_tags(trim($_POST['name'])), ENT_QUOTES, 'UTF-8'),
            'email' => htmlspecialchars(strip_tags(trim($_POST['email'])), ENT_QUOTES, 'UTF-8'),
            'phone' => htmlspecialchars(strip_tags(trim($_POST['phone'] ?? '')), ENT_QUOTES, 'UTF-8'),
            'division' => htmlspecialchars(strip_tags(trim($_POST['division'] ?? 'General')), ENT_QUOTES, 'UTF-8'),
            'subject' => htmlspecialchars(strip_tags(trim($_POST['subject'])), ENT_QUOTES, 'UTF-8'),
            'message' => htmlspecialchars(strip_tags(trim($_POST['message'])), ENT_QUOTES, 'UTF-8')
        ];
        
        // Save to database
        if ($db->saveContactSubmission($data)) {
            $response['success'] = true;
            $response['message'] = 'Thank you for contacting us! We will get back to you soon.';
            
            // Send email notification using PHPMailer
            try {
                $mailer = new Mailer();
                $mailer->sendContactNotification($data);
            } catch (Exception $e) {
                // Log error but don't fail the submission
                error_log("Email notification failed: " . $e->getMessage());
            }
            
        } else {
            $response['errors'][] = 'Failed to send your message. Please try again.';
        }
    }
    
} catch (Exception $e) {
    $response['errors'][] = 'An error occurred: ' . $e->getMessage();
}

// Store response in session for redirect
$_SESSION['form_response'] = $response;

// Redirect back to homepage contact section
header('Location: ../index.php#contact');
exit;
?>
