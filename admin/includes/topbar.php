<header class="topbar">
    <div class="topbar-left">
        <button class="sidebar-toggle" id="sidebarToggle">
            <i class="bi bi-list"></i>
        </button>
        <h5 class="page-title-mobile"><?php echo $page_title ?? 'Admin Dashboard'; ?></h5>
    </div>
    
    <div class="topbar-right">
        <div class="topbar-item">
            <a href="../index.php" target="_blank" class="btn-view-site">
                <i class="bi bi-globe"></i>
                <span>View Website</span>
            </a>
        </div>
        
        <div class="topbar-item dropdown">
            <button class="user-menu" data-bs-toggle="dropdown">
                <div class="user-avatar">
                    <i class="bi bi-person-circle"></i>
                </div>
                <div class="user-info">
                    <span class="user-name"><?php echo htmlspecialchars($_SESSION['admin_name'] ?? 'Admin'); ?></span>
                    <span class="user-role">Administrator</span>
                </div>
                <i class="bi bi-chevron-down"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="settings.php"><i class="bi bi-gear"></i> Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a></li>
            </ul>
        </div>
    </div>
</header>
