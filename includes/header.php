<?php
// Load configuration
require_once __DIR__ . '/../config.php';

// Get navigation items from config
$nav_items = getMainNavigation();
?>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

      <a href="index.php" class="logo d-flex align-items-center me-auto">
        <img src="assets/img/logo.png" alt="<?php echo SITE_NAME; ?>">
        <h1 class="sitename"><?php echo SITE_NAME; ?></h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <?php foreach ($nav_items as $key => $item): ?>
            <?php if (isset($item['dropdown'])): ?>
              <li class="dropdown">
                <a href="#" <?php echo (isset($current_page) && $current_page == $key) ? 'class="active"' : ''; ?>>
                  <span><?php echo $item['title']; ?></span> 
                  <i class="bi bi-chevron-down toggle-dropdown"></i>
                </a>
                <ul>
                  <?php foreach ($item['dropdown'] as $dropdown_item): ?>
                    <li><a href="<?php echo $dropdown_item['url']; ?>"><?php echo $dropdown_item['title']; ?></a></li>
                  <?php endforeach; ?>
                </ul>
              </li>
            <?php else: ?>
              <li>
                <a href="<?php echo $item['url']; ?>" <?php echo (isset($current_page) && $current_page == $key) ? 'class="active"' : ''; ?>>
                  <?php echo $item['title']; ?>
                </a>
              </li>
            <?php endif; ?>
          <?php endforeach; ?>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="contact.php">Get in Touch</a>

    </div>
</header>