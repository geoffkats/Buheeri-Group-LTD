<?php
// Page configuration
$page_title = "Projects - Buheeri Group U Ltd";
$page_description = "Explore Buheeri Group's portfolio of completed projects across construction, supply, logistics, and more.";
$page_keywords = "Projects, Portfolio, Construction, Supply, Uganda, Buheeri Group";
$current_page = "projects";

// Include database for dynamic content
require_once 'includes/database.php';
$db = new Database();

// Get filter parameter
$filter = $_GET['filter'] ?? 'all';
$projects = $db->getProjects($filter);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $page_title; ?></title>
  <meta name="description" content="<?php echo $page_description; ?>">
  <meta name="keywords" content="<?php echo $page_keywords; ?>">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body class="projects-page">

  <?php include 'includes/header.php'; ?>

  <main class="main">
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);">
      <div class="container position-relative">
        <h1>Our Projects</h1>
        <p>Explore our portfolio of successful projects across all divisions</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li class="current">Projects</li>
          </ol>
        </nav>
      </div>
    </div>

    <section id="projects" class="section">
      <div class="container section-title" data-aos="fade-up">
        <span>Portfolio</span>
        <h2>Featured Projects</h2>
        <p>A showcase of our work across construction, supply, logistics, and recruitment</p>
      </div>

      <div class="container">
        <!-- Filter Buttons -->
        <div class="projects-filter" data-aos="fade-up" data-aos-delay="100">
          <button class="active" data-filter="all">All</button>
          <button data-filter="construction">Construction</button>
          <button data-filter="supply">Supply</button>
          <button data-filter="logistics">Logistics</button>
          <button data-filter="recruitment">Recruitment</button>
        </div>

        <div class="row gy-4" id="projects-grid">
          <?php if (empty($projects)): ?>
          <div class="col-12">
            <div class="alert alert-info text-center">
              <h4>No Projects Found</h4>
              <p>Projects will appear here once they are added through the admin panel.</p>
              <a href="admin/login.php" class="btn btn-primary">Go to Admin Panel</a>
            </div>
          </div>
          <?php else: ?>
          <?php foreach ($projects as $index => $project): ?>
          <div class="col-lg-4 col-md-6 project-item" data-category="<?php echo htmlspecialchars($project['category']); ?>" data-aos="fade-up" data-aos-delay="<?php echo 100 + ($index % 3) * 100; ?>">
            <div class="project-card">
              <?php if (!empty($project['image_url'])): ?>
                <img src="<?php echo htmlspecialchars($project['image_url']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>">
              <?php else: ?>
                <img src="assets/img/service-1.jpg" alt="<?php echo htmlspecialchars($project['title']); ?>">
              <?php endif; ?>
              <div class="project-content">
                <span class="category"><?php echo ucfirst(htmlspecialchars($project['category'])); ?></span>
                <h4><?php echo htmlspecialchars($project['title']); ?></h4>
                <p><?php echo htmlspecialchars(substr($project['description'], 0, 150)); ?><?php echo strlen($project['description']) > 150 ? '...' : ''; ?></p>
                <?php if (!empty($project['client'])): ?>
                  <p class="client"><strong>Client:</strong> <?php echo htmlspecialchars($project['client']); ?></p>
                <?php endif; ?>
                <?php if (!empty($project['location'])): ?>
                  <p class="location"><strong>Location:</strong> <?php echo htmlspecialchars($project['location']); ?></p>
                <?php endif; ?>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
          <?php endif; ?>
        </div>
      </div>
    </section>

    <section id="cta" class="cta-corporate section">
      <div class="cta-corporate-bg"></div>
      <div class="container">
        <div class="cta-corporate-wrapper" data-aos="fade-up" data-aos-delay="100">
          <div class="row align-items-center">
            <div class="col-lg-8">
              <div class="cta-corporate-content">
                <span class="cta-corporate-badge">GET STARTED TODAY</span>
                <h2 class="cta-corporate-title">Have a Project in Mind?</h2>
                <p class="cta-corporate-text">Let's discuss how Buheeri Group can help bring your project to life. Contact us for a free consultation and discover our comprehensive solutions.</p>
                <div class="cta-corporate-features">
                  <div class="cta-feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Free Consultation</span>
                  </div>
                  <div class="cta-feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Custom Solutions</span>
                  </div>
                  <div class="cta-feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Expert Support</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="cta-corporate-action">
                <a href="contact.php" class="cta-corporate-btn">
                  <span>Start Your Project</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
                <div class="cta-corporate-contact">
                  <div class="cta-contact-item">
                    <i class="bi bi-telephone-fill"></i>
                    <div>
                      <span class="cta-contact-label">Call Us</span>
                      <a href="tel:+256776722138" class="cta-contact-value">+256 776 722 138</a>
                    </div>
                  </div>
                  <div class="cta-contact-item">
                    <i class="bi bi-envelope-fill"></i>
                    <div>
                      <span class="cta-contact-label">Email Us</span>
                      <a href="mailto:buheeri.consults@gmail.com" class="cta-contact-value">buheeri.consults@gmail.com</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

  <?php include 'includes/footer.php'; ?>

  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
  
  <!-- Preloader -->
  <div id="preloader">
    <div class="preloader-content">
      <div class="preloader-logo">
        <img src="assets/img/logo.png" alt="Buheeri Group">
      </div>
      <div class="preloader-spinner">
        <div class="spinner-ring"></div>
        <div class="spinner-ring"></div>
        <div class="spinner-ring"></div>
      </div>
      <div class="preloader-text">BUHEERI GROUP U LTD</div>
      <div class="preloader-tagline">Building Excellence Together</div>
    </div>
  </div>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
  
  <!-- Project Filter Script -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const filterButtons = document.querySelectorAll('.projects-filter button');
      const projectItems = document.querySelectorAll('.project-item');
      
      filterButtons.forEach(button => {
        button.addEventListener('click', function() {
          filterButtons.forEach(btn => btn.classList.remove('active'));
          this.classList.add('active');
          
          const filter = this.getAttribute('data-filter');
          
          projectItems.forEach(item => {
            if (filter === 'all' || item.getAttribute('data-category') === filter) {
              item.style.display = 'block';
            } else {
              item.style.display = 'none';
            }
          });
        });
      });
    });
  </script>
</body>
</html>