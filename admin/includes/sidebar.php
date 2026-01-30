<aside class="sidebar">
    <div class="sidebar-header">
        <div class="logo-container">
            <img src="../assets/img/logo.png" alt="Buheeri Group" class="sidebar-logo">
        </div>
        <div class="sidebar-brand">
            <h4 class="brand-name">BUHEERI GROUP</h4>
            <span class="brand-subtitle">Administration Portal</span>
        </div>
    </div>
    
    <nav class="sidebar-nav">
        <ul class="nav-list">
            <!-- Main Navigation Section -->
            <li class="nav-section">
                <div class="section-header">
                    <i class="bi bi-grid-fill"></i>
                    <span>MAIN NAVIGATION</span>
                </div>
            </li>
            
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                <a href="index.php" class="nav-link">
                    <div class="nav-icon">
                        <i class="bi bi-speedometer2"></i>
                    </div>
                    <span class="nav-text">Dashboard</span>
                    <div class="nav-indicator"></div>
                </a>
            </li>
            
            <!-- Content Management Section -->
            <li class="nav-section">
                <div class="section-header">
                    <i class="bi bi-folder2-open"></i>
                    <span>CONTENT MANAGEMENT</span>
                </div>
            </li>
            
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'contacts.php' ? 'active' : ''; ?>">
                <a href="contacts.php" class="nav-link">
                    <div class="nav-icon">
                        <i class="bi bi-envelope-fill"></i>
                    </div>
                    <span class="nav-text">Contact Messages</span>
                    <?php if (isset($stats['contacts']) && $stats['contacts'] > 0): ?>
                        <span class="nav-badge"><?php echo $stats['contacts']; ?></span>
                    <?php endif; ?>
                    <div class="nav-indicator"></div>
                </a>
            </li>
            
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'careers.php' ? 'active' : ''; ?>">
                <a href="careers.php" class="nav-link">
                    <div class="nav-icon">
                        <i class="bi bi-file-earmark-person-fill"></i>
                    </div>
                    <span class="nav-text">Career Applications</span>
                    <?php if (isset($stats['careers']) && $stats['careers'] > 0): ?>
                        <span class="nav-badge"><?php echo $stats['careers']; ?></span>
                    <?php endif; ?>
                    <div class="nav-indicator"></div>
                </a>
            </li>
            
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'job-positions.php' ? 'active' : ''; ?>">
                <a href="job-positions.php" class="nav-link">
                    <div class="nav-icon">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>
                    <span class="nav-text">Job Positions</span>
                    <div class="nav-indicator"></div>
                </a>
            </li>
            
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'projects.php' ? 'active' : ''; ?>">
                <a href="projects.php" class="nav-link">
                    <div class="nav-icon">
                        <i class="bi bi-folder-fill"></i>
                    </div>
                    <span class="nav-text">Projects Portfolio</span>
                    <div class="nav-indicator"></div>
                </a>
            </li>
            
            <!-- System Section -->
            <li class="nav-section">
                <div class="section-header">
                    <i class="bi bi-gear-fill"></i>
                    <span>SYSTEM</span>
                </div>
            </li>
            
            <li class="nav-item <?php echo basename($_SERVER['PHP_SELF']) == 'settings.php' ? 'active' : ''; ?>">
                <a href="settings.php" class="nav-link">
                    <div class="nav-icon">
                        <i class="bi bi-sliders"></i>
                    </div>
                    <span class="nav-text">Settings</span>
                    <div class="nav-indicator"></div>
                </a>
            </li>
            
            <li class="nav-item nav-logout">
                <a href="logout.php" class="nav-link">
                    <div class="nav-icon">
                        <i class="bi bi-box-arrow-right"></i>
                    </div>
                    <span class="nav-text">Logout</span>
                    <div class="nav-indicator"></div>
                </a>
            </li>
        </ul>
    </nav>
    
    <div class="sidebar-footer">
        <div class="security-badge">
            <i class="bi bi-shield-check"></i>
            <span>Synthilogic Enterprise</span>
        </div>
    </div>
</aside>
