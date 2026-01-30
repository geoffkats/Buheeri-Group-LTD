<?php
/**
 * Database Configuration and Connection Handler
 * Uses centralized configuration from config.php
 */

// Load configuration if not already loaded
if (!defined('CONFIG_LOADED')) {
    require_once __DIR__ . '/../config.php';
}

class Database {
    private $pdo;
    
    public function __construct() {
        $this->connect();
        $this->createTables();
        $this->createAdminTable();
    }
    
    /**
     * Get PDO connection (for admin operations)
     */
    public function getPdo() {
        return $this->pdo;
    }
    
    /**
     * Create admin credentials table
     */
    private function createAdminTable() {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS admin_credentials (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(100) NOT NULL UNIQUE,
                password VARCHAR(255) NOT NULL,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255),
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        
        // Insert default admin if table is empty
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM admin_credentials");
        if ($stmt->fetchColumn() == 0) {
            $this->pdo->exec("INSERT INTO admin_credentials (username, password, name, email) VALUES ('admin', 'buheeri2024', 'Administrator', 'admin@buheeri.co.ug')");
        }
    }
    
    /**
     * Get admin credentials
     */
    public function getAdminCredentials() {
        $stmt = $this->pdo->query("SELECT * FROM admin_credentials LIMIT 1");
        return $stmt->fetch();
    }
    
    /**
     * Verify admin login
     */
    public function verifyAdminLogin($username, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM admin_credentials WHERE username = ? AND password = ?");
        $stmt->execute([$username, $password]);
        return $stmt->fetch();
    }
    
    /**
     * Update admin username
     */
    public function updateAdminUsername($id, $username) {
        $stmt = $this->pdo->prepare("UPDATE admin_credentials SET username = ? WHERE id = ?");
        return $stmt->execute([$username, $id]);
    }
    
    /**
     * Update admin password
     */
    public function updateAdminPassword($id, $password) {
        $stmt = $this->pdo->prepare("UPDATE admin_credentials SET password = ? WHERE id = ?");
        return $stmt->execute([$password, $id]);
    }
    
    /**
     * Update admin profile
     */
    public function updateAdminProfile($id, $name, $email) {
        $stmt = $this->pdo->prepare("UPDATE admin_credentials SET name = ?, email = ? WHERE id = ?");
        return $stmt->execute([$name, $email, $id]);
    }
    
    /**
     * Connect to MySQL database
     */
    private function connect() {
        try {
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=" . DB_CHARSET;
            $this->pdo = new PDO($dsn, DB_USER, DB_PASS);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }
    
    /**
     * Create necessary tables
     */
    private function createTables() {
        // Contact submissions table
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS contact_submissions (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                phone VARCHAR(50),
                division VARCHAR(100),
                subject VARCHAR(255) NOT NULL,
                message TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        
        // Career applications table
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS career_applications (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                phone VARCHAR(50) NOT NULL,
                position VARCHAR(255) NOT NULL,
                cover_letter TEXT NOT NULL,
                cv_filename VARCHAR(255),
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        
        // Projects table
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS projects (
                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                description TEXT,
                category VARCHAR(100) NOT NULL,
                image_url VARCHAR(255),
                status VARCHAR(50) DEFAULT 'active',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        
        // Testimonials table
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS testimonials (
                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                position VARCHAR(255) NOT NULL,
                company VARCHAR(255),
                message TEXT NOT NULL,
                image_url VARCHAR(255),
                rating INT DEFAULT 5,
                status VARCHAR(50) DEFAULT 'active',
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
        
        // Insert sample data if tables are empty
        $this->insertSampleData();
    }
    
    /**
     * Insert sample data
     */
    private function insertSampleData() {
        // Check if projects table is empty
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM projects");
        if ($stmt->fetchColumn() == 0) {
            $this->insertSampleProjects();
        }
        
        // Check if testimonials table is empty
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM testimonials");
        if ($stmt->fetchColumn() == 0) {
            $this->insertSampleTestimonials();
        }
    }
    
    /**
     * Insert sample projects
     */
    private function insertSampleProjects() {
        $projects = [
            ['Kampala Commercial Complex', 'A 10-story mixed-use development featuring office spaces and retail outlets in the heart of Kampala.', 'construction', 'assets/img/service-1.jpg'],
            ['Jinja-Iganga Road Rehabilitation', '25km road rehabilitation project improving connectivity in Eastern Uganda.', 'construction', 'assets/img/service-2.jpg'],
            ['Mbarara Secondary School', 'Construction of a modern secondary school facility with classrooms, labs, and dormitories.', 'construction', 'assets/img/service-3.jpg'],
            ['Regional Hospital Equipment Supply', 'Supply and installation of medical equipment to 15 regional referral hospitals.', 'supply', 'assets/img/service-4.jpg'],
            ['Government Office Furnishing', 'Complete office furniture and equipment supply for new government ministry buildings.', 'supply', 'assets/img/service-5.jpg'],
            ['Agricultural Inputs Distribution', 'Large-scale distribution of seeds, fertilizers, and farming equipment to rural cooperatives.', 'supply', 'assets/img/service-6.jpg'],
            ['Cross-Border Trade Facilitation', 'Managed customs clearance and logistics for major import/export operations.', 'logistics', 'assets/img/features-1.jpg'],
            ['Heavy Equipment Import', 'Coordinated import and delivery of construction machinery from overseas suppliers.', 'logistics', 'assets/img/features-2.jpg'],
            ['Healthcare Worker Deployment', 'Recruited and deployed 200+ healthcare workers to facilities in the Middle East.', 'recruitment', 'assets/img/features-3.jpg']
        ];
        
        $stmt = $this->pdo->prepare("INSERT INTO projects (title, description, category, image_url) VALUES (?, ?, ?, ?)");
        foreach ($projects as $project) {
            $stmt->execute($project);
        }
    }
    
    /**
     * Insert sample testimonials
     */
    private function insertSampleTestimonials() {
        $testimonials = [
            ['James Mukasa', 'CEO', 'Kampala Industries', 'Buheeri Group has been our trusted partner for over 5 years. Their professionalism and commitment to quality is unmatched. They consistently deliver on time and exceed expectations.', 'assets/img/testimonials/testimonials-1.jpg'],
            ['Sarah Nambi', 'Procurement Manager', 'Ministry of Health', 'Working with Buheeri Group on our medical supply contracts has been excellent. Their attention to detail and compliance with all requirements makes them a reliable government contractor.', 'assets/img/testimonials/testimonials-2.jpg'],
            ['Peter Ochieng', 'Director', 'East Africa Exports Ltd', 'Their clearing and forwarding services have streamlined our cross-border operations significantly. Professional team, competitive rates, and excellent communication throughout.', 'assets/img/testimonials/testimonials-3.jpg']
        ];
        
        $stmt = $this->pdo->prepare("INSERT INTO testimonials (name, position, company, message, image_url) VALUES (?, ?, ?, ?, ?)");
        foreach ($testimonials as $testimonial) {
            $stmt->execute($testimonial);
        }
    }
    
    /**
     * Save contact submission
     */
    public function saveContactSubmission($data) {
        $stmt = $this->pdo->prepare("
            INSERT INTO contact_submissions (name, email, phone, division, subject, message) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'] ?? null,
            $data['division'] ?? null,
            $data['subject'],
            $data['message']
        ]);
    }
    
    /**
     * Save career application
     */
    public function saveCareerApplication($data, $cv_filename = null) {
        $stmt = $this->pdo->prepare("
            INSERT INTO career_applications (name, email, phone, position, cover_letter, cv_filename) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['name'],
            $data['email'],
            $data['phone'],
            $data['position'],
            $data['cover_letter'],
            $cv_filename
        ]);
    }
    
    /**
     * Get projects by category
     */
    public function getProjects($category = null, $limit = null) {
        $sql = "SELECT * FROM projects WHERE status = 'active'";
        $params = [];
        
        if ($category && $category !== 'all') {
            $sql .= " AND category = ?";
            $params[] = $category;
        }
        
        $sql .= " ORDER BY created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }
        
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get featured projects only
     */
    public function getFeaturedProjects($limit = 6) {
        $sql = "SELECT * FROM projects WHERE status = 'active' AND featured = 1 ORDER BY created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }
        
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get testimonials
     */
    public function getTestimonials($limit = null) {
        $sql = "SELECT * FROM testimonials WHERE status = 'active' ORDER BY created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }
        
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get all contact submissions
     */
    public function getContactSubmissions($limit = null) {
        $sql = "SELECT * FROM contact_submissions ORDER BY created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }
        
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get all career applications
     */
    public function getCareerApplications($limit = null) {
        $sql = "SELECT * FROM career_applications ORDER BY created_at DESC";
        
        if ($limit) {
            $sql .= " LIMIT " . (int)$limit;
        }
        
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Get database connection
     */
    public function getConnection() {
        return $this->pdo;
    }
    
    // ========================================
    // ADMIN DASHBOARD METHODS
    // ========================================
    
    /**
     * Get contact count
     */
    public function getContactCount() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM contact_submissions");
        return $stmt->fetchColumn();
    }
    
    /**
     * Get career application count
     */
    public function getCareerApplicationCount() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM career_applications");
        return $stmt->fetchColumn();
    }
    
    /**
     * Get project count
     */
    public function getProjectCount() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM projects WHERE status = 'active'");
        return $stmt->fetchColumn();
    }
    
    /**
     * Get recent contacts
     */
    public function getRecentContacts($limit = 5) {
        $limit = (int)$limit;
        $stmt = $this->pdo->query("SELECT * FROM contact_submissions ORDER BY created_at DESC LIMIT " . $limit);
        return $stmt->fetchAll();
    }
    
    /**
     * Get recent career applications
     */
    public function getRecentApplications($limit = 5) {
        $limit = (int)$limit;
        $stmt = $this->pdo->query("SELECT * FROM career_applications ORDER BY created_at DESC LIMIT " . $limit);
        return $stmt->fetchAll();
    }
    
    /**
     * Get all contacts with pagination
     */
    public function getAllContacts($page = 1, $perPage = 20) {
        $page = (int)$page;
        $perPage = (int)$perPage;
        $offset = ($page - 1) * $perPage;
        $stmt = $this->pdo->query("SELECT * FROM contact_submissions ORDER BY created_at DESC LIMIT " . $perPage . " OFFSET " . $offset);
        return $stmt->fetchAll();
    }
    
    /**
     * Get contact by ID
     */
    public function getContactById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM contact_submissions WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    /**
     * Delete contact
     */
    public function deleteContact($id) {
        $stmt = $this->pdo->prepare("DELETE FROM contact_submissions WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    /**
     * Get all career applications with pagination
     */
    public function getAllApplications($page = 1, $perPage = 20) {
        $page = (int)$page;
        $perPage = (int)$perPage;
        $offset = ($page - 1) * $perPage;
        $stmt = $this->pdo->query("SELECT * FROM career_applications ORDER BY created_at DESC LIMIT " . $perPage . " OFFSET " . $offset);
        return $stmt->fetchAll();
    }
    
    /**
     * Get application by ID
     */
    public function getApplicationById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM career_applications WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    /**
     * Delete application
     */
    public function deleteApplication($id) {
        $stmt = $this->pdo->prepare("DELETE FROM career_applications WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    /**
     * Get all projects
     */
    public function getAllProjectsAdmin() {
        $stmt = $this->pdo->query("SELECT * FROM projects ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }
    
    /**
     * Get all projects with pagination
     */
    public function getAllProjects($page = 1, $perPage = 10) {
        $page = (int)$page;
        $perPage = (int)$perPage;
        $offset = ($page - 1) * $perPage;
        $stmt = $this->pdo->query("SELECT * FROM projects ORDER BY created_at DESC LIMIT " . $perPage . " OFFSET " . $offset);
        return $stmt->fetchAll();
    }
    
    /**
     * Get project by ID
     */
    public function getProjectById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM projects WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    /**
     * Add new project
     */
    public function addProject($title, $category, $description, $client, $location, $status, $featured, $image) {
        $stmt = $this->pdo->prepare("
            INSERT INTO projects (title, category, description, client, location, status, featured, image_url, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        return $stmt->execute([$title, $category, $description, $client, $location, $status, $featured, $image]);
    }
    
    /**
     * Update project
     */
    public function updateProject($id, $title, $category, $description, $client, $location, $status, $featured, $image) {
        $stmt = $this->pdo->prepare("
            UPDATE projects 
            SET title = ?, category = ?, description = ?, client = ?, location = ?, status = ?, featured = ?, image_url = ?
            WHERE id = ?
        ");
        return $stmt->execute([$title, $category, $description, $client, $location, $status, $featured, $image, $id]);
    }
    
    /**
     * Delete project
     */
    public function deleteProject($id) {
        $stmt = $this->pdo->prepare("DELETE FROM projects WHERE id = ?");
        return $stmt->execute([$id]);
    }
    
    // ========================================
    // JOB POSITIONS METHODS
    // ========================================
    
    /**
     * Get all job positions with pagination
     */
    public function getAllJobPositions($page = 1, $perPage = 10) {
        $page = (int)$page;
        $perPage = (int)$perPage;
        $offset = ($page - 1) * $perPage;
        $stmt = $this->pdo->query("SELECT * FROM job_positions ORDER BY created_at DESC LIMIT " . $perPage . " OFFSET " . $offset);
        return $stmt->fetchAll();
    }
    
    /**
     * Get active job positions
     */
    public function getActiveJobPositions() {
        $stmt = $this->pdo->query("SELECT * FROM job_positions WHERE status = 'active' ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }
    
    /**
     * Get job position by ID
     */
    public function getJobPositionById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM job_positions WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    /**
     * Get job position count
     */
    public function getJobPositionCount() {
        $stmt = $this->pdo->query("SELECT COUNT(*) FROM job_positions");
        return $stmt->fetchColumn();
    }
    
    /**
     * Add new job position
     */
    public function addJobPosition($title, $division, $location, $type, $description, $requirements, $status) {
        $stmt = $this->pdo->prepare("
            INSERT INTO job_positions (title, division, location, type, description, requirements, status, created_at) 
            VALUES (?, ?, ?, ?, ?, ?, ?, NOW())
        ");
        return $stmt->execute([$title, $division, $location, $type, $description, $requirements, $status]);
    }
    
    /**
     * Update job position
     */
    public function updateJobPosition($id, $title, $division, $location, $type, $description, $requirements, $status) {
        $stmt = $this->pdo->prepare("
            UPDATE job_positions 
            SET title = ?, division = ?, location = ?, type = ?, description = ?, requirements = ?, status = ?
            WHERE id = ?
        ");
        return $stmt->execute([$title, $division, $location, $type, $description, $requirements, $status, $id]);
    }
    
    /**
     * Delete job position
     */
    public function deleteJobPosition($id) {
        $stmt = $this->pdo->prepare("DELETE FROM job_positions WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
