<?php
// Load configuration if not already loaded
if (!defined('CONFIG_LOADED')) {
    require_once __DIR__ . '/../config.php';
}

// Footer configuration from config
$company_info = [
    'name' => COMPANY_NAME,
    'description' => SITE_DESCRIPTION,
    'address' => COMPANY_ADDRESS,
    'city' => COMPANY_CITY,
    'phone' => COMPANY_PHONE,
    'email' => COMPANY_EMAIL
];

$quick_links = [
    ['url' => 'index.php', 'title' => 'Home'],
    ['url' => 'about.php', 'title' => 'About Us'],
    ['url' => 'projects.php', 'title' => 'Projects'],
    ['url' => 'careers.php', 'title' => 'Careers'],
    ['url' => 'contact.php', 'title' => 'Contact']
];

$divisions = [
    ['url' => 'division-consultancy.php', 'title' => 'Consultancy'],
    ['url' => 'division-general-supply.php', 'title' => 'General Supplies'],
    ['url' => 'division-construction.php', 'title' => 'Construction'],
    ['url' => 'division-labour.php', 'title' => 'Human Resources & Labour Supply'],
    ['url' => 'division-logistics.php', 'title' => 'Clearing & Forwarding']
];

$social_links = [
    ['url' => SOCIAL_TWITTER, 'icon' => 'bi-twitter-x'],
    ['url' => SOCIAL_FACEBOOK, 'icon' => 'bi-facebook'],
    ['url' => SOCIAL_INSTAGRAM, 'icon' => 'bi-instagram'],
    ['url' => SOCIAL_LINKEDIN, 'icon' => 'bi-linkedin']
];
?>

<footer id="footer" class="footer dark-background">
    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.php" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="<?php echo $company_info['name']; ?>">
            <span class="sitename"><?php echo $company_info['name']; ?></span>
          </a>
          <p><?php echo $company_info['description']; ?></p>
          <div class="social-links d-flex mt-4">
            <?php foreach ($social_links as $social): ?>
              <a href="<?php echo $social['url']; ?>"><i class="bi <?php echo $social['icon']; ?>"></i></a>
            <?php endforeach; ?>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Quick Links</h4>
          <ul>
            <?php foreach ($quick_links as $link): ?>
              <li><a href="<?php echo $link['url']; ?>"><?php echo $link['title']; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Our Divisions</h4>
          <ul>
            <?php foreach ($divisions as $division): ?>
              <li><a href="<?php echo $division['url']; ?>"><?php echo $division['title']; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>

        <div class="col-lg-4 col-md-6 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <div class="contact-info">
            <p><strong>Head Office:</strong></p>
            <p><?php echo $company_info['address']; ?></p>
            <p><?php echo $company_info['city']; ?></p>
            <p><strong>Branch Office:</strong></p>
            <p><?php echo defined('COMPANY_BRANCH') ? COMPANY_BRANCH : 'Ntinda, Kampala, Uganda'; ?></p>
            <p class="mt-3"><strong>Phone:</strong> <span><?php echo $company_info['phone']; ?></span></p>
            <?php if (defined('COMPANY_PHONE_ALT')): ?>
            <p><strong>Alt Phone:</strong> <span><?php echo COMPANY_PHONE_ALT; ?></span></p>
            <?php endif; ?>
            <p><strong>Email:</strong> <span><?php echo $company_info['email']; ?></span></p>
            <?php if (defined('COMPANY_EMAIL_ALT')): ?>
            <p><strong>Alt Email:</strong> <span><?php echo COMPANY_EMAIL_ALT; ?></span></p>
            <?php endif; ?>
            <p class="mt-3">
              <a href="https://maps.google.com/?q=Plot+No.+7,+Asinge+Road,+Amagoro+A+South+Village,+Eastern+Division,+Tororo,+Uganda" 
                 target="_blank" 
                 style="color: #D4A017; text-decoration: none;">
                <i class="bi bi-geo-alt-fill"></i> <strong>View on Google Maps</strong>
              </a>
            </p>
          </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename"><?php echo $company_info['name']; ?></strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <p style="margin: 5px 0;">Designed by <a href="https://akaattechnologies.com/" target="_blank" style="color: #D4A017; font-weight: 600;">Akaat Technologies</a> | Security by <strong style="color: #D4A017;">Synthilogic Enterprise</strong></p>
      </div>
    </div>
</footer>