<?php
/**
 * Configuration File for Buheeri Group U Ltd Website
 * Centralized configuration settings for the entire application
 */

// Prevent direct access
if (!defined('BUHEERI_CONFIG')) {
    define('BUHEERI_CONFIG', true);
}

// =============================================================================
// SITE CONFIGURATION
// =============================================================================

// Site Information
define('SITE_NAME', 'Buheeri Group Ltd');
define('SITE_TAGLINE', 'Building Uganda\'s Future');
define('SITE_URL', 'http://www.buheeri.co.ug');
define('SITE_DESCRIPTION', 'Buheeri Group Ltd is a Ugandan multi-sector company delivering integrated services in consultancy, general supplies, construction, clearing and forwarding, and human resources and labour supply.');

// Company Information
define('COMPANY_NAME', 'Buheeri Group Ltd');
define('COMPANY_ADDRESS', 'Plot No. 7, Asinge Road, Amagoro \'A\' South Village, Eastern Division, Tororo');
define('COMPANY_CITY', 'Tororo, Uganda');
define('COMPANY_PO_BOX', 'P.O. Box 300200');
define('COMPANY_PHONE', '+256 776 722 138');
define('COMPANY_PHONE_ALT', '+256 772 459 386');
define('COMPANY_EMAIL', 'buheeri.consults@gmail.com');
define('COMPANY_EMAIL_ALT', 'info@buheeri.co.ug');
define('COMPANY_WEBSITE', 'http://www.buheeri.co.ug');
define('COMPANY_REGISTRATION', '1029026844');
define('COMPANY_BRANCH', 'Ntinda, Kampala, Uganda');

// Business Hours
define('BUSINESS_HOURS_WEEKDAY', 'Monday - Friday: 8:00 AM - 5:00 PM');
define('BUSINESS_HOURS_SATURDAY', 'Saturday: 9:00 AM - 1:00 PM');
define('BUSINESS_HOURS_SUNDAY', 'Sunday: Closed');

// =============================================================================
// DATABASE CONFIGURATION
// =============================================================================

// Database Settings
define('DB_TYPE', 'mysql'); // sqlite, mysql, pgsql
define('DB_HOST', 'localhost'); // For MySQL/PostgreSQL
define('DB_NAME', 'buheeri'); // For MySQL/PostgreSQL
define('DB_USER', 'root'); // For MySQL/PostgreSQL
define('DB_PASS', ''); // For MySQL/PostgreSQL
define('DB_CHARSET', 'utf8mb4');

// =============================================================================
// EMAIL CONFIGURATION
// =============================================================================

// Email Settings
define('SMTP_ENABLED', false); // Set to true to use SMTP
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_USERNAME', 'your-email@gmail.com');
define('SMTP_PASSWORD', 'your-app-password');
define('SMTP_ENCRYPTION', 'tls'); // tls or ssl

// Email Addresses
define('EMAIL_FROM', 'noreply@buheeri.co.ug');
define('EMAIL_FROM_NAME', 'Buheeri Group Ltd');
define('EMAIL_CONTACT', 'info@buheeri.co.ug');
define('EMAIL_RECRUITMENT', 'buheeri.consults@gmail.com');
define('EMAIL_SUPPLY', 'info@buheeri.co.ug');
define('EMAIL_CONSTRUCTION', 'info@buheeri.co.ug');
define('EMAIL_LOGISTICS', 'info@buheeri.co.ug');

// =============================================================================
// FILE UPLOAD CONFIGURATION
// =============================================================================

// Upload Settings
define('UPLOAD_DIR', 'uploads/');
define('MAX_FILE_SIZE', 5 * 1024 * 1024); // 5MB in bytes
define('ALLOWED_EXTENSIONS', ['pdf', 'doc', 'docx']);
define('UPLOAD_ENABLED', true);

// =============================================================================
// SECURITY CONFIGURATION
// =============================================================================

// Security Settings
define('ADMIN_PASSWORD', 'buheeri2024'); // Change this in production!
define('SESSION_TIMEOUT', 3600); // 1 hour in seconds
define('CSRF_PROTECTION', true);
define('XSS_PROTECTION', true);

// Rate Limiting
define('RATE_LIMIT_ENABLED', true);
define('RATE_LIMIT_REQUESTS', 10); // Max requests per time window
define('RATE_LIMIT_WINDOW', 300); // Time window in seconds (5 minutes)

// =============================================================================
// SOCIAL MEDIA LINKS
// =============================================================================

// Social Media URLs
define('SOCIAL_FACEBOOK', 'https://facebook.com/buheerigroup');
define('SOCIAL_TWITTER', 'https://twitter.com/buheerigroup');
define('SOCIAL_LINKEDIN', 'https://linkedin.com/company/buheeri-group');
define('SOCIAL_INSTAGRAM', 'https://instagram.com/buheerigroup');

// =============================================================================
// DIVISION CONTACT INFORMATION
// =============================================================================

// Division-specific contact information
$DIVISION_CONTACTS = [
    'consultancy' => [
        'name' => 'Consultancy Services',
        'email' => EMAIL_CONTACT,
        'phone' => '+256 700 000 111',
        'icon' => 'fa-solid fa-lightbulb'
    ],
    'general-supply' => [
        'name' => 'General Supply Division',
        'email' => EMAIL_SUPPLY,
        'phone' => '+256 700 111 222',
        'icon' => 'fa-solid fa-boxes-stacked'
    ],
    'construction' => [
        'name' => 'Construction & Engineering',
        'email' => EMAIL_CONSTRUCTION,
        'phone' => '+256 700 222 333',
        'icon' => 'fa-solid fa-helmet-safety'
    ],
    'labour' => [
        'name' => 'Labour Recruitment & Training',
        'email' => EMAIL_RECRUITMENT,
        'phone' => '+256 700 333 444',
        'icon' => 'fa-solid fa-users-gear'
    ],
    'logistics' => [
        'name' => 'Clearing & Forwarding / Logistics',
        'email' => EMAIL_LOGISTICS,
        'phone' => '+256 700 444 555',
        'icon' => 'fa-solid fa-truck-fast'
    ]
];

// =============================================================================
// NAVIGATION CONFIGURATION
// =============================================================================

// Main navigation structure
$MAIN_NAVIGATION = [
    'home' => ['url' => 'index.php', 'title' => 'Home'],
    'about' => ['url' => 'about.php', 'title' => 'About Us'],
    'divisions' => [
        'title' => 'Divisions',
        'dropdown' => [
            ['url' => 'division-consultancy.php', 'title' => 'Consultancy Services'],
            ['url' => 'division-general-supply.php', 'title' => 'General Supply'],
            ['url' => 'division-construction.php', 'title' => 'Construction & Engineering'],
            ['url' => 'division-labour.php', 'title' => 'Labour Recruitment & Training'],
            ['url' => 'division-logistics.php', 'title' => 'Clearing & Forwarding / Logistics']
        ]
    ],
    'projects' => ['url' => 'projects.php', 'title' => 'Projects'],
    'careers' => ['url' => 'careers.php', 'title' => 'Careers'],
    'contact' => ['url' => 'contact.php', 'title' => 'Contact']
];

// =============================================================================
// DEVELOPMENT SETTINGS
// =============================================================================

// Development/Debug Settings
define('DEBUG_MODE', true); // Set to true for development
define('SHOW_ERRORS', DEBUG_MODE);
define('LOG_ERRORS', true);
define('ERROR_LOG_FILE', 'logs/error.log');

// Cache Settings
define('CACHE_ENABLED', !DEBUG_MODE);
define('CACHE_DURATION', 3600); // 1 hour

// =============================================================================
// GOOGLE SERVICES
// =============================================================================

// Google Maps
define('GOOGLE_MAPS_API_KEY', 'your-google-maps-api-key');
define('GOOGLE_MAPS_EMBED', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.756328583059!2d34.1825!3d0.6876!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMMKwNDEnMTUuNCJOIDM0wrAxMCc1Ny4wIkU!5e0!3m2!1sen!2sug!4v1234567890');

// Google Analytics
define('GOOGLE_ANALYTICS_ID', 'G-XXXXXXXXXX'); // Replace with actual ID

// =============================================================================
// UTILITY FUNCTIONS
// =============================================================================

/**
 * Get configuration value with fallback
 */
function getConfig($key, $default = null) {
    return defined($key) ? constant($key) : $default;
}

/**
 * Get division contact information
 */
function getDivisionContact($division) {
    global $DIVISION_CONTACTS;
    return isset($DIVISION_CONTACTS[$division]) ? $DIVISION_CONTACTS[$division] : null;
}

/**
 * Get main navigation structure
 */
function getMainNavigation() {
    global $MAIN_NAVIGATION;
    return $MAIN_NAVIGATION;
}

/**
 * Initialize error reporting based on debug mode
 */
function initializeErrorReporting() {
    if (SHOW_ERRORS) {
        error_reporting(E_ALL);
        ini_set('display_errors', 1);
    } else {
        error_reporting(0);
        ini_set('display_errors', 0);
    }
    
    if (LOG_ERRORS) {
        ini_set('log_errors', 1);
        if (defined('ERROR_LOG_FILE')) {
            ini_set('error_log', ERROR_LOG_FILE);
        }
    }
}

/**
 * Create necessary directories
 */
function createDirectories() {
    $directories = [
        UPLOAD_DIR,
        'logs'
    ];
    
    foreach ($directories as $dir) {
        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }
    }
}

// =============================================================================
// INITIALIZATION
// =============================================================================

// Initialize error reporting
initializeErrorReporting();

// Create necessary directories
createDirectories();

// Set timezone
date_default_timezone_set('Africa/Kampala');

// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// =============================================================================
// VERSION INFORMATION
// =============================================================================

define('BUHEERI_VERSION', '1.0.0');
define('BUHEERI_BUILD_DATE', '2024-12-22');
define('BUHEERI_BUILD_NUMBER', '001');

// Configuration loaded successfully
define('CONFIG_LOADED', true);
?>
