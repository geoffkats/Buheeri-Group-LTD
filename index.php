<?php
// Page configuration
$page_title = "Buheeri Group Ltd - Building Uganda's Future";
$page_description = "Buheeri Group Ltd is a Ugandan multi-sector company delivering integrated services in consultancy, general supplies, construction, clearing and forwarding, and human resources and labour supply.";
$page_keywords = "Buheeri Group, Uganda, Consultancy, General Supply, Construction, Clearing Forwarding, Human Resources, Labour Supply";
$current_page = "home";

// Start session for form messages
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database for dynamic content
require_once 'includes/database.php';
$db = new Database();

// Get featured projects and testimonials
$featured_projects = $db->getFeaturedProjects(6);
$testimonials = $db->getTestimonials();

// Get form response from session
$form_response = $_SESSION['form_response'] ?? null;
unset($_SESSION['form_response']);

$success_message = '';
$error_messages = [];

if ($form_response) {
    if ($form_response['success']) {
        $success_message = $form_response['message'];
    } else {
        $error_messages = $form_response['errors'];
    }
}
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

<body class="index-page">

  <?php include 'includes/header.php'; ?>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">
      <img src="assets/img/world-dotted-map.png" alt="" class="hero-bg" data-aos="fade-in">

      <div class="container">
        <div class="row gy-4 d-flex justify-content-between align-items-center">
          <div class="col-lg-7 order-2 order-lg-1 d-flex flex-column justify-content-center">
            <h2 data-aos="fade-up">Building Uganda's Future <span>Together</span></h2>
            <p data-aos="fade-up" data-aos-delay="100">Buheeri Group Ltd is a Ugandan multi-sector company headquartered in Kampala, delivering integrated services in consultancy, general supplies, construction, clearing and forwarding, and human resources and labour supply. We work with government ministries, departments, agencies, and local governments, as well as private sector organizations, development partners, and non-governmental organizations to support Uganda's socio-economic development.</p>

            <div class="hero-cta" data-aos="fade-up" data-aos-delay="200">
              <a href="about.php" class="btn btn-primary">Learn More About Us</a>
              <a href="contact.php" class="btn btn-outline-gold">Contact Us</a>
            </div>

            <!-- Unique Stats Design -->
            <div class="hero-stats-wrapper" data-aos="fade-up" data-aos-delay="300">
              <div class="stats-grid-hero">
                <!-- Stat 1 -->
                <div class="stat-card-hero" data-aos="zoom-in" data-aos-delay="400">
                  <div class="stat-icon-hero">
                    <i class="bi bi-calendar-check"></i>
                  </div>
                  <div class="stat-content-hero">
                    <div class="stat-number-hero">
                      <span data-purecounter-start="0" data-purecounter-end="10" data-purecounter-duration="1" class="purecounter">10</span>
                      <span class="stat-plus">+</span>
                    </div>
                    <div class="stat-label-hero">Years Excellence</div>
                    <div class="stat-bar-hero"></div>
                  </div>
                </div>

                <!-- Stat 2 -->
                <div class="stat-card-hero" data-aos="zoom-in" data-aos-delay="500">
                  <div class="stat-icon-hero">
                    <i class="bi bi-building"></i>
                  </div>
                  <div class="stat-content-hero">
                    <div class="stat-number-hero">
                      <span data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="1" class="purecounter">50</span>
                      <span class="stat-plus">+</span>
                    </div>
                    <div class="stat-label-hero">Projects Completed</div>
                    <div class="stat-bar-hero"></div>
                  </div>
                </div>

                <!-- Stat 3 -->
                <div class="stat-card-hero" data-aos="zoom-in" data-aos-delay="600">
                  <div class="stat-icon-hero">
                    <i class="bi bi-heart-fill"></i>
                  </div>
                  <div class="stat-content-hero">
                    <div class="stat-number-hero">
                      <span data-purecounter-start="0" data-purecounter-end="100" data-purecounter-duration="1" class="purecounter">100</span>
                      <span class="stat-plus">+</span>
                    </div>
                    <div class="stat-label-hero">Happy Clients</div>
                    <div class="stat-bar-hero"></div>
                  </div>
                </div>

                <!-- Stat 4 -->
                <div class="stat-card-hero" data-aos="zoom-in" data-aos-delay="700">
                  <div class="stat-icon-hero">
                    <i class="bi bi-people-fill"></i>
                  </div>
                  <div class="stat-content-hero">
                    <div class="stat-number-hero">
                      <span data-purecounter-start="0" data-purecounter-end="5" data-purecounter-duration="1" class="purecounter">5</span>
                      <span class="stat-plus"></span>
                    </div>
                    <div class="stat-label-hero">Specialized Divisions</div>
                    <div class="stat-bar-hero"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-5 order-1 order-lg-2 hero-img" data-aos="zoom-out">
            <img src="assets/img/hero-img.png" class="img-fluid mb-3 mb-lg-0" alt="Buheeri Group" width="639" height="639" fetchpriority="high">
          </div>
        </div>
      </div>
    </section>
    <!-- /Hero Section -->

    <!-- Four Pillars Section -->
    <section id="four-pillars" class="four-pillars section">
      <div class="container section-title" data-aos="fade-up">
        <span>Our Five Pillars</span>
        <h2>Divisions of Excellence</h2>
        <p>Five specialized divisions working together to deliver comprehensive solutions across Uganda</p>
      </div>

      <div class="container">
        <div class="swiper divisions-swiper" data-aos="fade-up" data-aos-delay="100">
          <div class="swiper-wrapper">
            <div class="swiper-slide">
              <div class="pillar-card consultancy">
                <div class="card-overlay"></div>
                <div class="card-content">
                  <div class="icon-wrapper">
                    <i class="fa-solid fa-lightbulb"></i>
                  </div>
                  <h3>Consultancy Services</h3>
                  <p class="description">Strategic business consulting and advisory services to help organizations achieve their goals. From strategic planning to process optimization, we deliver expert guidance.</p>
                  <a href="division-consultancy.php" class="learn-more-btn" aria-label="Learn more about Consultancy services">
                    Consultancy Services <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="pillar-card general-supply">
                <div class="card-overlay"></div>
                <div class="card-content">
                  <div class="icon-wrapper">
                    <i class="fa-solid fa-boxes-stacked"></i>
                  </div>
                  <h3>General Supply</h3>
                  <p class="description">Comprehensive procurement and supply chain solutions for businesses across all sectors. From office supplies to industrial equipment, we deliver quality products on time.</p>
                  <a href="division-general-supply.php" class="learn-more-btn" aria-label="Learn more about General Supply services">
                    General Supply Services <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="pillar-card construction">
                <div class="card-overlay"></div>
                <div class="card-content">
                  <div class="icon-wrapper">
                    <i class="fa-solid fa-helmet-safety"></i>
                  </div>
                  <h3>Construction & Engineering</h3>
                  <p class="description">Building infrastructure that transforms communities and drives economic growth. From commercial buildings to roads and bridges, we create lasting value.</p>
                  <a href="division-construction.php" class="learn-more-btn" aria-label="Learn more about Construction & Engineering services">
                    Construction Services <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="pillar-card labour">
                <div class="card-overlay"></div>
                <div class="card-content">
                  <div class="icon-wrapper">
                    <i class="fa-solid fa-users-gear"></i>
                  </div>
                  <h3>Labour Recruitment & Training</h3>
                  <p class="description">Connecting skilled professionals with opportunities locally and internationally. We provide comprehensive training and placement services for career advancement.</p>
                  <a href="division-labour.php" class="learn-more-btn" aria-label="Learn more about Labour Recruitment & Training services">
                    Labour Recruitment <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>

            <div class="swiper-slide">
              <div class="pillar-card logistics">
                <div class="card-overlay"></div>
                <div class="card-content">
                  <div class="icon-wrapper">
                    <i class="fa-solid fa-truck-fast"></i>
                  </div>
                  <h3>Clearing & Forwarding</h3>
                  <p class="description">Seamless logistics and customs clearance services across East Africa. We ensure your cargo moves efficiently through complex supply chains.</p>
                  <a href="division-logistics.php" class="learn-more-btn" aria-label="Learn more about Clearing & Forwarding services">
                    Logistics Services <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
          
          <!-- Navigation buttons -->
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          
          <!-- Pagination -->
          <div class="swiper-pagination"></div>
        </div>
      </div>
    </section>
    <!-- /Four Pillars Section -->

    <!-- About Section -->
    <section id="about" style="background-color:navyblue"  class="about section">
      <div class="container">
        <!-- Section Title -->
        <div class="row mb-5">
          <div class="col-12">
            <div class="about-title-wrapper" data-aos="fade-up">
              <span class="section-label">WHO WE ARE</span>
              <h2 class="about-main-title">About Buheeri Group U Ltd</h2>
              <div class="title-underline"></div>
            </div>
          </div>
        </div>

        <!-- Main Content Row -->
        <div class="row g-5 align-items-center mb-5">
          <!-- Left: Image & Stats -->
          <div class="col-lg-6" data-aos="fade-right">
            <div class="about-image-wrapper">
              <img src="assets/img/about.jpg" class="about-main-image" alt="About Buheeri Group">
              
              <!-- Stats Overlay -->
              <div class="stats-overlay-grid">
                <div class="stat-box">
                  <div class="stat-number">2+</div>
                  <div class="stat-label">Years Excellence</div>
                </div>
                <div class="stat-box">
                  <div class="stat-number">50+</div>
                  <div class="stat-label">Projects</div>
                </div>
                <div class="stat-box">
                  <div class="stat-number">100+</div>
                  <div class="stat-label">Clients</div>
                </div>
                <div class="stat-box">
                  <div class="stat-number">5</div>
                  <div class="stat-label">Divisions</div>
                </div>
              </div>
            </div>
          </div>

          <!-- Right: Content -->
          <div class="col-lg-6" data-aos="fade-left">
            <div class="about-content-wrapper">
              <h3 class="content-heading">Delivering Compliant, Competitive, and High-Impact Services</h3>
              <p class="content-lead">Buheeri Group Ltd is a Ugandan multi-sector company headquartered in Kampala, delivering integrated services in consultancy, general supplies, construction, clearing and forwarding, and human resources and labour supply.</p>
              <p class="content-text">The company is structured to provide practical, compliant, and results-oriented solutions that respond to the operational and project needs of both public and private sector clients. Our operations are aligned with Uganda's development priorities, with a strong focus on infrastructure development, efficient service delivery, logistics effectiveness, and job creation.</p>
              
              <!-- Key Points -->
              <div class="key-points-list">
                <div class="key-point-item">
                  <div class="point-number">01</div>
                  <div class="point-content">
                    <h5>Excellence in Every Project</h5>
                    <p>Maintaining the highest standards of quality and professionalism in all our undertakings.</p>
                  </div>
                </div>
                <div class="key-point-item">
                  <div class="point-number">02</div>
                  <div class="point-content">
                    <h5>Community-Focused Approach</h5>
                    <p>Creating jobs, building capacity, and contributing to sustainable community development.</p>
                  </div>
                </div>
                <div class="key-point-item">
                  <div class="point-number">03</div>
                  <div class="point-content">
                    <h5>Regional Expertise</h5>
                    <p>Deep understanding of East African markets, regulations, and business environments.</p>
                  </div>
                </div>
              </div>

              <div class="about-actions">
                <a href="about.php" class="btn-about-primary">Learn More About Us</a>
                <a href="contact.php" class="btn-about-secondary">Get In Touch</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Core Values Section -->
        <div class="row">
          <div class="col-12">
            <div class="core-values-section" data-aos="fade-up">
              <div class="values-header-section">
                <h3>Our Core Values</h3>
                <p>The principles that guide everything we do</p>
              </div>
              
              <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                  <div class="value-card">
                    <div class="value-number">01</div>
                    <div class="value-icon-box">
                      <i class="bi bi-shield-check"></i>
                    </div>
                    <h5 class="value-title">Integrity</h5>
                    <p class="value-description">Underpins all our operations. We promote transparency, fairness, and professionalism in procurement, contracting, and service delivery.</p>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6">
                  <div class="value-card">
                    <div class="value-number">02</div>
                    <div class="value-icon-box">
                      <i class="bi bi-award"></i>
                    </div>
                    <h5 class="value-title">Quality</h5>
                    <p class="value-description">Guides our commitment to delivering services that meet agreed standards and client expectations.</p>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6">
                  <div class="value-card">
                    <div class="value-number">03</div>
                    <div class="value-icon-box">
                      <i class="bi bi-clipboard-check"></i>
                    </div>
                    <h5 class="value-title">Accountability</h5>
                    <p class="value-description">Shapes how we manage responsibilities and performance. We take responsibility for outcomes and maintain proper documentation.</p>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6">
                  <div class="value-card">
                    <div class="value-number">04</div>
                    <div class="value-icon-box">
                      <i class="bi bi-gear"></i>
                    </div>
                    <h5 class="value-title">Competence</h5>
                    <p class="value-description">Reflects our focus on deploying skilled personnel and effective systems to deliver professional services.</p>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6">
                  <div class="value-card">
                    <div class="value-number">05</div>
                    <div class="value-icon-box">
                      <i class="bi bi-people-fill"></i>
                    </div>
                    <h5 class="value-title">Client Focus</h5>
                    <p class="value-description">Drives our approach to service delivery. We engage closely with clients to provide practical, responsive, and results-oriented solutions.</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /About Section -->
    <!-- Why Partner Section -->
    <section id="why-partner" class="why-partner section light-background">
      <div class="container section-title" data-aos="fade-up">
        <span>Why Partner With Us</span>
        <h2>Why Partner With Us</h2>
        <p>Discover the advantages of working with Buheeri Group U Ltd</p>
      </div>

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-shield-check"></i></div>
              <h4>Trusted & Reliable</h4>
              <p>15+ years of proven track record delivering projects on time and within budget.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-graph-up-arrow"></i></div>
              <h4>Quality Assured</h4>
              <p>Rigorous quality control processes ensuring excellence in every deliverable.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-people-fill"></i></div>
              <h4>Expert Team</h4>
              <p>Skilled professionals with deep expertise across all our service areas.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-headset"></i></div>
              <h4>24/7 Support</h4>
              <p>Dedicated customer support ensuring your needs are always addressed promptly.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-currency-dollar"></i></div>
              <h4>Competitive Pricing</h4>
              <p>Best value solutions without compromising on quality or service delivery.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-lightning-charge"></i></div>
              <h4>Fast Turnaround</h4>
              <p>Efficient processes enabling quick delivery and responsive service.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="700">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-recycle"></i></div>
              <h4>Sustainable Practices</h4>
              <p>Committed to environmentally responsible and sustainable business operations.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="800">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-patch-check"></i></div>
              <h4>Certified & Compliant</h4>
              <p>Fully licensed and compliant with all regulatory requirements.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Why Partner Section -->

    <!-- Call To Action Section -->
    <section id="call-to-action" class="cta-corporate section">
      <div class="cta-corporate-bg"></div>
      <div class="container">
        <div class="cta-corporate-wrapper" data-aos="fade-up" data-aos-delay="100">
          <div class="row align-items-center">
            <div class="col-lg-8">
              <div class="cta-corporate-content">
                <span class="cta-corporate-badge">LET'S WORK TOGETHER</span>
                <h2 class="cta-corporate-title">Ready to Start Your Next Project?</h2>
                <p class="cta-corporate-text">Partner with Buheeri Group U Ltd and experience the difference that expertise, dedication, and integrity can make. Let's build something great together.</p>
                <div class="cta-corporate-features">
                  <div class="cta-feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Expert Team</span>
                  </div>
                  <div class="cta-feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Quality Assured</span>
                  </div>
                  <div class="cta-feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>On-Time Delivery</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="cta-corporate-action">
                <a href="contact.php" class="cta-corporate-btn">
                  <span>Contact Us Today</span>
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
    <!-- /Call To Action Section -->

    <!-- Featured Projects Section -->
    <section id="featured-projects" class="featured-projects section">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="projects-header text-center" data-aos="fade-up">
              <span class="projects-label">OUR PORTFOLIO</span>
              <h2 class="projects-title">Featured Projects</h2>
              <p class="projects-description">Explore some of our most impactful projects across Uganda, showcasing our commitment to excellence and innovation</p>
            </div>
          </div>
        </div>

        <div class="row g-4 mt-4">
          <?php foreach ($featured_projects as $index => $project): ?>
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?php echo 100 + ($index * 100); ?>">
            <div class="project-card-new">
              <div class="project-image-wrapper">
                <img src="<?php echo htmlspecialchars($project['image_url']); ?>" alt="<?php echo htmlspecialchars($project['title']); ?>" class="project-image">
                <div class="project-overlay">
                  <div class="overlay-content">
                    <i class="bi bi-arrow-right-circle"></i>
                    <span>View Details</span>
                  </div>
                </div>
              </div>
              <div class="project-content">
                <div class="project-category">
                  <i class="bi bi-tag"></i>
                  <span><?php echo ucfirst(htmlspecialchars($project['category'])); ?></span>
                </div>
                <h4 class="project-title"><?php echo htmlspecialchars($project['title']); ?></h4>
                <p class="project-description"><?php echo htmlspecialchars($project['description']); ?></p>
                <a href="projects.php" class="project-link">
                  <span>View Project Details</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
          <?php endforeach; ?>
        </div>

        <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="400">
          <a href="projects.php" class="btn-view-all">
            <span>View All Projects</span>
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      </div>
    </section>
    <!-- /Featured Projects Section -->

    <!-- Our Impact Section -->
    <section id="our-impact" class="our-impact section">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section-header text-center" data-aos="fade-up">
              <span class="section-label">OUR IMPACT</span>
              <h2 class="section-title">Making a Difference Across Uganda</h2>
              <p class="section-description">Our commitment to excellence translates into measurable results and lasting impact across all sectors we serve.</p>
            </div>
          </div>
        </div>

        <div class="row g-4 mt-4">
          <!-- Impact Card 1 -->
          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="impact-card">
              <div class="impact-icon">
                <i class="bi bi-building"></i>
              </div>
              <div class="impact-number">200+</div>
              <h4>Projects Delivered</h4>
              <p>Successfully completed projects across construction, supply, and logistics sectors</p>
            </div>
          </div>

          <!-- Impact Card 2 -->
          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="impact-card">
              <div class="impact-icon">
                <i class="bi bi-people"></i>
              </div>
              <div class="impact-number">500+</div>
              <h4>Jobs Created</h4>
              <p>Direct employment opportunities provided to skilled professionals nationwide</p>
            </div>
          </div>

          <!-- Impact Card 3 -->
          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="impact-card">
              <div class="impact-icon">
                <i class="bi bi-award"></i>
              </div>
              <div class="impact-number">150+</div>
              <h4>Satisfied Clients</h4>
              <p>Long-term partnerships with government agencies and private enterprises</p>
            </div>
          </div>

          <!-- Impact Card 4 -->
          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="impact-card">
              <div class="impact-icon">
                <i class="bi bi-geo-alt"></i>
              </div>
              <div class="impact-number">10+</div>
              <h4>Districts Served</h4>
              <p>Expanding our reach across Uganda and East African region</p>
            </div>
          </div>
        </div>

        <!-- Additional Impact Info -->
        <div class="row mt-5">
          <div class="col-lg-6" data-aos="fade-right" data-aos-delay="500">
            <div class="impact-highlight">
              <div class="highlight-icon">
                <i class="bi bi-graph-up-arrow"></i>
              </div>
              <div class="highlight-content">
                <h3>Consistent Growth</h3>
                <p>Year-over-year growth in revenue and project portfolio, demonstrating our commitment to excellence and client satisfaction. Our strategic approach ensures sustainable expansion while maintaining quality standards.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-left" data-aos-delay="600">
            <div class="impact-highlight">
              <div class="highlight-icon">
                <i class="bi bi-heart"></i>
              </div>
              <div class="highlight-content">
                <h3>Community Development</h3>
                <p>Beyond business, we invest in community development through skills training, infrastructure projects, and sustainable practices that benefit local communities and contribute to Uganda's economic growth.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Our Impact Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact-section section">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <div class="section-header text-center" data-aos="fade-up">
              <span class="contact-label">GET IN TOUCH</span>
              <h2 class="contact-title">Let's Start Your Next Project</h2>
              <p class="contact-description">Ready to work with us? Contact our team today and let's discuss how we can help bring your vision to life.</p>
            </div>
          </div>
        </div>

        <div class="row g-5 mt-4">
          <!-- Contact Information -->
          <div class="col-lg-5" data-aos="fade-right">
            <div class="contact-info-wrapper">
              <h3>Contact Information</h3>
              <p class="info-subtitle">Reach out to us through any of the following channels</p>

              <div class="contact-info-items">
                <div class="info-item">
                  <div class="info-icon">
                    <i class="bi bi-geo-alt"></i>
                  </div>
                  <div class="info-content">
                    <h5>Our Location</h5>
                    <p><?php echo COMPANY_ADDRESS; ?><br><?php echo COMPANY_CITY; ?></p>
                  </div>
                </div>

                <div class="info-item">
                  <div class="info-icon">
                    <i class="bi bi-telephone"></i>
                  </div>
                  <div class="info-content">
                    <h5>Phone Number</h5>
                    <p><?php echo COMPANY_PHONE; ?></p>
                  </div>
                </div>

                <div class="info-item">
                  <div class="info-icon">
                    <i class="bi bi-envelope"></i>
                  </div>
                  <div class="info-content">
                    <h5>Email Address</h5>
                    <p><?php echo COMPANY_EMAIL; ?></p>
                  </div>
                </div>

                <div class="info-item">
                  <div class="info-icon">
                    <i class="bi bi-clock"></i>
                  </div>
                  <div class="info-content">
                    <h5>Business Hours</h5>
                    <p>Monday - Friday: 8:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 1:00 PM</p>
                  </div>
                </div>
              </div>

              <div class="social-links-contact">
                <h5>Follow Us</h5>
                <div class="social-icons">
                  <a href="<?php echo SOCIAL_FACEBOOK; ?>" target="_blank" aria-label="Follow us on Facebook"><i class="bi bi-facebook"></i></a>
                  <a href="<?php echo SOCIAL_TWITTER; ?>" target="_blank" aria-label="Follow us on Twitter"><i class="bi bi-twitter-x"></i></a>
                  <a href="<?php echo SOCIAL_LINKEDIN; ?>" target="_blank" aria-label="Follow us on LinkedIn"><i class="bi bi-linkedin"></i></a>
                  <a href="<?php echo SOCIAL_INSTAGRAM; ?>" target="_blank" aria-label="Follow us on Instagram"><i class="bi bi-instagram"></i></a>
                </div>
              </div>
            </div>
          </div>

          <!-- Contact Form -->
          <div class="col-lg-7" data-aos="fade-left">
            <div class="contact-form-wrapper">
              <h3>Send Us a Message</h3>
              <p class="form-subtitle">Fill out the form below and we'll get back to you as soon as possible</p>

              <?php if (!empty($success_message)): ?>
                <div class="alert alert-success">
                  <i class="bi bi-check-circle"></i> <?php echo $success_message; ?>
                </div>
              <?php endif; ?>
              
              <?php if (!empty($error_messages)): ?>
                <div class="alert alert-danger">
                  <ul class="mb-0">
                    <?php foreach ($error_messages as $error): ?>
                      <li><?php echo $error; ?></li>
                    <?php endforeach; ?>
                  </ul>
                </div>
              <?php endif; ?>

              <form action="forms/submit-contact.php" method="post">
                <div class="row gy-4">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="name">Full Name *</label>
                      <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="email">Email Address *</label>
                      <input type="email" name="email" id="email" class="form-control" required>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="phone">Phone Number</label>
                      <input type="tel" name="phone" id="phone" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="subject">Subject *</label>
                      <input type="text" name="subject" id="subject" class="form-control" required>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="form-group">
                      <label for="message">Message *</label>
                      <textarea name="message" id="message" rows="6" class="form-control" required></textarea>
                    </div>
                  </div>

                  <div class="col-12">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>
                  </div>

                  <div class="col-12">
                    <button type="submit" class="btn-submit">
                      <span>Send Message</span>
                      <i class="bi bi-arrow-right"></i>
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- /Contact Section -->

  </main>

  <?php include 'includes/footer.php'; ?>

  <!-- Scroll Top -->
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

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- Divisions Swiper Initialization -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      if (typeof Swiper !== 'undefined') {
        const divisionsSwiper = new Swiper('.divisions-swiper', {
          slidesPerView: 1,
          spaceBetween: 30,
          loop: true,
          autoplay: {
            delay: 4000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true
          },
          speed: 800,
          navigation: {
            nextEl: '.divisions-swiper .swiper-button-next',
            prevEl: '.divisions-swiper .swiper-button-prev',
          },
          pagination: {
            el: '.divisions-swiper .swiper-pagination',
            clickable: true,
            dynamicBullets: true
          },
          breakpoints: {
            576: {
              slidesPerView: 2,
              spaceBetween: 20
            },
            768: {
              slidesPerView: 3,
              spaceBetween: 25
            },
            992: {
              slidesPerView: 4,
              spaceBetween: 30
            }
          }
        });
      }
    });
  </script>

</body>
</html>