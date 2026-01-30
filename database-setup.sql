-- Buheeri Group U Ltd Database Setup
-- MySQL Database Schema
-- Version: 2.0
-- Last Updated: January 2025

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS buheeri CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE buheeri;

-- ============================================
-- Contact Submissions Table
-- ============================================
DROP TABLE IF EXISTS contact_submissions;
CREATE TABLE contact_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50),
    division VARCHAR(100),
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    ip_address VARCHAR(45),
    user_agent TEXT,
    status ENUM('new', 'read', 'replied', 'archived') DEFAULT 'new',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_created (created_at),
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Career Applications Table
-- ============================================
DROP TABLE IF EXISTS career_applications;
CREATE TABLE career_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    position VARCHAR(255) NOT NULL,
    division VARCHAR(100),
    experience_years INT,
    education VARCHAR(255),
    cover_letter TEXT NOT NULL,
    cv_filename VARCHAR(255),
    cv_path VARCHAR(500),
    status ENUM('new', 'reviewing', 'shortlisted', 'interviewed', 'rejected', 'hired') DEFAULT 'new',
    notes TEXT,
    ip_address VARCHAR(45),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_position (position),
    INDEX idx_created (created_at),
    INDEX idx_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Projects Table
-- ============================================
DROP TABLE IF EXISTS projects;
CREATE TABLE projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    category ENUM('construction', 'supply', 'logistics', 'recruitment', 'general') NOT NULL,
    client VARCHAR(255),
    location VARCHAR(255),
    start_date DATE,
    end_date DATE,
    budget DECIMAL(15,2),
    image_url VARCHAR(500),
    gallery_images TEXT COMMENT 'JSON array of image URLs',
    status ENUM('active', 'completed', 'ongoing', 'inactive') DEFAULT 'active',
    featured BOOLEAN DEFAULT FALSE,
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_category (category),
    INDEX idx_status (status),
    INDEX idx_featured (featured),
    INDEX idx_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Testimonials Table
-- ============================================
DROP TABLE IF EXISTS testimonials;
CREATE TABLE testimonials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    position VARCHAR(255) NOT NULL,
    company VARCHAR(255),
    message TEXT NOT NULL,
    image_url VARCHAR(500),
    rating INT DEFAULT 5 CHECK (rating >= 1 AND rating <= 5),
    status ENUM('active', 'inactive', 'pending') DEFAULT 'pending',
    featured BOOLEAN DEFAULT FALSE,
    display_order INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status),
    INDEX idx_featured (featured),
    INDEX idx_order (display_order)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Admin Users Table
-- ============================================
DROP TABLE IF EXISTS admin_users;
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    role ENUM('super_admin', 'admin', 'editor', 'viewer') DEFAULT 'admin',
    status ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
    last_login TIMESTAMP NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_username (username),
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Activity Log Table
-- ============================================
DROP TABLE IF EXISTS activity_log;
CREATE TABLE activity_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    admin_id INT,
    action VARCHAR(100) NOT NULL,
    entity_type VARCHAR(50) NOT NULL,
    entity_id INT,
    description TEXT,
    ip_address VARCHAR(45),
    user_agent TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_admin (admin_id),
    INDEX idx_entity (entity_type, entity_id),
    INDEX idx_created (created_at),
    FOREIGN KEY (admin_id) REFERENCES admin_users(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- Insert Sample Data
-- ============================================

-- Sample Projects
INSERT INTO projects (title, description, category, client, location, status, featured, display_order, image_url) VALUES
('4 Classroom Block - Rock View Primary School', 'Construction of a modern 4-classroom block with proper ventilation, lighting, and sanitation facilities. Project commenced August 2023 and completed February 2024.', 'construction', 'Tororo Local Government', 'Tororo, Uganda', 'completed', TRUE, 1, 'assets/img/service-2.jpg'),
('Medical Supplies to Tororo Hospital', 'Supply of essential medical equipment and consumables including surgical instruments, diagnostic equipment, and pharmaceutical supplies.', 'supply', 'Tororo General Hospital', 'Tororo, Uganda', 'completed', TRUE, 2, 'assets/img/service-1.jpg'),
('Labour Supply - Construction Project', 'Recruitment and deployment of 50+ skilled construction workers for major infrastructure project. Included training and safety certification.', 'recruitment', 'Private Developer', 'Kampala, Uganda', 'completed', TRUE, 3, 'assets/img/service-3.jpg'),
('Cross-Border Logistics - Kenya', 'Clearing and forwarding services for 20+ containers of industrial equipment from Mombasa to Kampala with full customs clearance.', 'logistics', 'Manufacturing Company', 'Mombasa - Kampala', 'completed', FALSE, 4, 'assets/img/service-4.jpg'),
('Office Furniture Supply - NGO', 'Complete office furniture supply including desks, chairs, filing cabinets, and conference room equipment for new NGO office.', 'supply', 'International NGO', 'Kampala, Uganda', 'completed', FALSE, 5, 'assets/img/service-5.jpg'),
('Road Rehabilitation Project', 'Rehabilitation of 5km rural access road including drainage systems and culvert construction.', 'construction', 'District Local Government', 'Eastern Uganda', 'ongoing', FALSE, 6, 'assets/img/service-6.jpg');

-- Sample Testimonials
INSERT INTO testimonials (name, position, company, message, rating, status, featured, display_order) VALUES
('John Okello', 'Project Manager', 'Tororo Local Government', 'Buheeri Group delivered exceptional quality on our school construction project. Their professionalism and attention to detail exceeded our expectations.', 5, 'active', TRUE, 1),
('Sarah Namukasa', 'Procurement Officer', 'Tororo General Hospital', 'Reliable and efficient supply services. They consistently deliver quality products on time and within budget.', 5, 'active', TRUE, 2),
('David Musoke', 'Operations Director', 'Manufacturing Ltd', 'Their logistics services are outstanding. They handled our complex shipment with expertise and ensured timely delivery.', 5, 'active', TRUE, 3),
('Grace Achieng', 'HR Manager', 'Construction Firm', 'The labour recruitment services provided skilled and reliable workers. Their training programs are comprehensive and effective.', 4, 'active', FALSE, 4);

-- Default Admin User (password: buheeri2024)
INSERT INTO admin_users (username, password_hash, full_name, email, role, status) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'System Administrator', 'admin@buheeri.co.ug', 'super_admin', 'active');

-- ============================================
-- Success Message
-- ============================================
SELECT 'Database setup completed successfully!' as message;
SELECT 'Tables created: contact_submissions, career_applications, projects, testimonials, admin_users, activity_log' as info;
SELECT 'Sample data inserted for projects and testimonials' as info;
SELECT 'Default admin user created - Username: admin, Password: buheeri2024' as info;
