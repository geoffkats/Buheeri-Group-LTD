<?php
// Page configuration
$page_title = "About Us - Buheeri Group Ltd";
$page_description = "Learn about Buheeri Group Ltd's mission, vision, values, and leadership team.";
$page_keywords = "Buheeri Group, About, Uganda, Company, Leadership";
$current_page = "about";
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

<body class="about-page">

  <?php include 'includes/header.php'; ?>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);">
      <div class="container position-relative">
        <h1>About Us</h1>
        <p>Discover the story, values, and people behind Buheeri Group Ltd</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li class="current">About Us</li>
          </ol>
        </nav>
      </div>
    </div>

    <!-- Company Overview Section -->
    <section id="about" class="about section">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6 position-relative align-self-start order-lg-last order-first" data-aos="fade-up" data-aos-delay="200">
            <img src="assets/img/about.jpg" class="img-fluid" alt="About Buheeri Group">
          </div>

          <div class="col-lg-6 content order-last order-lg-first" data-aos="fade-up" data-aos-delay="100">
            <h3>Company Overview</h3>
            <p>
              Buheeri Group Ltd is a Ugandan multi-sector company headquartered in Kampala, delivering integrated services in consultancy, general supplies, construction, clearing and forwarding, and human resources and labour supply. The company is structured to provide practical, compliant, and results-oriented solutions that respond to the operational and project needs of both public and private sector clients.
            </p>
            <p>
              We work with government ministries, departments, agencies, and local governments, as well as private sector organizations, development partners, and non-governmental organizations. Through these engagements, the company supports planning, project implementation, procurement, logistics, infrastructure development, and workforce deployment across a range of sectors.
            </p>
            <p>
              The company's operations are aligned with Uganda's development priorities, with a strong focus on infrastructure development, efficient service delivery, logistics effectiveness, and job creation. By combining technical expertise, sector experience, and structured systems, Buheeri Group Ltd contributes to Uganda's socio-economic development while delivering reliable and accountable services to its clients.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Mission Vision Values Section -->
    <section id="mission-vision" class="mission-vision-professional section light-background">
      <div class="container section-title" data-aos="fade-up">
        <span>Our Foundation</span>
        <h2>Mission, Vision & Values</h2>
        <p>The principles that guide everything we do</p>
      </div>

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="mvv-card">
              <div class="icon-wrapper">
                <i class="bi bi-bullseye"></i>
              </div>
              <h4>OUR MISSION</h4>
              <p>To deliver practical consultancy, quality supplies, reliable construction, efficient clearing and forwarding, and professional HR and labour services that meet client needs while promoting transparency, competitiveness, and accountability in line with Uganda's development priorities.</p>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
            <div class="mvv-card">
              <div class="icon-wrapper">
                <i class="bi bi-eye"></i>
              </div>
              <h4>OUR VISION</h4>
              <p>To be a trusted Ugandan firm delivering compliant, competitive, and high-impact services that contribute to national development goals and sustainable service delivery.</p>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
            <div class="mvv-card">
              <div class="icon-wrapper">
                <i class="bi bi-heart"></i>
              </div>
              <h4>OUR VALUES</h4>
              <ul class="values-list">
                <li><i class="bi bi-check-circle"></i> Integrity - Transparency & Professionalism</li>
                <li><i class="bi bi-check-circle"></i> Quality - Meeting Agreed Standards</li>
                <li><i class="bi bi-check-circle"></i> Accountability - Responsibility for Outcomes</li>
                <li><i class="bi bi-check-circle"></i> Competence - Skilled Personnel & Systems</li>
                <li><i class="bi bi-check-circle"></i> Client Focus - Responsive Solutions</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Stats Section -->
    <section id="stats" class="stats-professional section">
      <div class="container">
        <div class="stats-grid-professional">
          <div class="stat-card-professional" data-aos="fade-up" data-aos-delay="100">
            <div class="stat-number-professional">
              <span data-purecounter-start="0" data-purecounter-end="2" data-purecounter-duration="1" class="purecounter"></span>
              <span class="plus-sign-professional">+</span>
            </div>
            <div class="stat-label-professional">Years of Excellence</div>
          </div>

          <div class="stat-card-professional" data-aos="fade-up" data-aos-delay="200">
            <div class="stat-number-professional">
              <span data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="1" class="purecounter"></span>
              <span class="plus-sign-professional">+</span>
            </div>
            <div class="stat-label-professional">Projects Completed</div>
          </div>

          <div class="stat-card-professional" data-aos="fade-up" data-aos-delay="300">
            <div class="stat-number-professional">
              <span data-purecounter-start="0" data-purecounter-end="100" data-purecounter-duration="1" class="purecounter"></span>
              <span class="plus-sign-professional">+</span>
            </div>
            <div class="stat-label-professional">Satisfied Clients</div>
          </div>

          <div class="stat-card-professional" data-aos="fade-up" data-aos-delay="400">
            <div class="stat-number-professional">
              <span data-purecounter-start="0" data-purecounter-end="5" data-purecounter-duration="1" class="purecounter"></span>
              <span class="plus-sign-professional"></span>
            </div>
            <div class="stat-label-professional">Specialized Divisions</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Leadership Team Section -->
    <section id="team" class="team-professional section light-background">
      <div class="container section-title" data-aos="fade-up">
        <span>Our Team</span>
        <h2>Leadership Team</h2>
        <p>Meet the experienced professionals guiding Buheeri Group Ltd</p>
      </div>

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="team-member-card">
              <div class="member-image">
                <img src="assets/img/team/team-1.jpg" alt="Managing Director">
              </div>
              <div class="member-info">
                <h4>MR. WAFULA ELIAS ONYANGO</h4>
                <span class="position">Managing Director</span>
                <p>MBA (Marketing) – Africa Graduate University; B. Com - MUBS. Leads overall strategy and operations with extensive experience in business management and marketing.</p>
                <div class="social-links">
                  <a href="#"><i class="bi bi-twitter-x"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="team-member-card">
              <div class="member-image">
                <img src="assets/img/team/team-2.jpg" alt="Director">
              </div>
              <div class="member-info">
                <h4>MRS. NAMPUUGA JACQUELINE LINDA</h4>
                <span class="position">Director</span>
                <p>Procurement and Logistics – Nkumba University. Oversees procurement and logistics functions, ensuring compliance and efficient supply chain operations.</p>
                <div class="social-links">
                  <a href="#"><i class="bi bi-twitter-x"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="team-member-card">
              <div class="member-image">
                <img src="assets/img/team/team-3.jpg" alt="Senior Consultant">
              </div>
              <div class="member-info">
                <h4>MR. MUKULU MILTON GEORGE</h4>
                <span class="position">Senior Consultant</span>
                <p>CIM-UK LERU7; MBA (Marketing); BBA Marketing; UDBS – Makerere University. Provides business advisory and consultancy services with expertise in marketing and institutional development.</p>
                <div class="social-links">
                  <a href="#"><i class="bi bi-twitter-x"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="team-member-card">
              <div class="member-image">
                <img src="assets/img/team/team-4.jpg" alt="Engineer">
              </div>
              <div class="member-info">
                <h4>ENG. MUGENI JOB</h4>
                <span class="position">Engineer</span>
                <p>Bachelor of Civil Engineering – Ndejje University. Provides technical oversight for civil and structural works, site supervision, and infrastructure project delivery.</p>
                <div class="social-links">
                  <a href="#"><i class="bi bi-twitter-x"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="team-member-card">
              <div class="member-image">
                <img src="assets/img/team/team-5.jpg" alt="Company Chief Advisor">
              </div>
              <div class="member-info">
                <h4>MR. JULIUS CEASER TUSINGWIRE</h4>
                <span class="position">Company Chief Advisor</span>
                <p>Bachelor of Public Administration and Management. Provides senior advisory support on governance, institutional relations, and public sector engagement.</p>
                <div class="social-links">
                  <a href="#"><i class="bi bi-twitter-x"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="team-member-card">
              <div class="member-image">
                <img src="assets/img/team/team-6.jpg" alt="Human Resource Manager">
              </div>
              <div class="member-info">
                <h4>MR. OCEN BONIFACE</h4>
                <span class="position">Human Resource Manager</span>
                <p>Bachelor of Human Resource Management – Makerere Business School. Manages recruitment, labour deployment, workforce administration, and HR compliance.</p>
                <div class="social-links">
                  <a href="#"><i class="bi bi-twitter-x"></i></a>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Company Timeline Section -->
    <section id="timeline" class="timeline-professional section">
      <div class="container section-title" data-aos="fade-up">
        <span>Our Approach</span>
        <h2>Compliance and Standards</h2>
        <p>Our commitment to excellence and regulatory compliance</p>
      </div>

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="compliance-card">
              <div class="compliance-icon">
                <i class="bi bi-shield-check"></i>
              </div>
              <h4>PPDA Compliance</h4>
              <p>We operate in line with Uganda's Public Procurement and Disposal of Public Assets (PPDA) requirements, embedding fair competition, transparency, value for money, and accountability across all procurement and service delivery activities.</p>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="compliance-card">
              <div class="compliance-icon">
                <i class="bi bi-graph-up-arrow"></i>
              </div>
              <h4>National Development Alignment</h4>
              <p>Our operations align with the National Development Plan IV (NDP IV) by supporting priority areas that contribute to Uganda's socio-economic development through infrastructure, logistics, and employment creation.</p>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="compliance-card">
              <div class="compliance-icon">
                <i class="bi bi-clipboard-check"></i>
              </div>
              <h4>Quality Assurance</h4>
              <p>We maintain internal procedures that guide quality assurance, health and safety, contract management, and performance monitoring across all our service divisions.</p>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="compliance-card">
              <div class="compliance-icon">
                <i class="bi bi-people-fill"></i>
              </div>
              <h4>Professional Standards</h4>
              <p>Through this compliance-focused approach, we provide clients with reliable, accountable, and professionally delivered services that meet regulatory expectations while contributing to national development objectives.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Call To Action Section -->
    <section id="call-to-action" class="cta-corporate section">
      <div class="cta-corporate-bg"></div>
      <div class="container">
        <div class="cta-corporate-wrapper" data-aos="fade-up" data-aos-delay="100">
          <div class="row align-items-center">
            <div class="col-lg-8">
              <div class="cta-corporate-content">
                <span class="cta-corporate-badge">JOIN OUR TEAM</span>
                <h2 class="cta-corporate-title">Build Your Career With Us</h2>
                <p class="cta-corporate-text">We're always looking for talented individuals who share our passion for excellence. Explore career opportunities with Buheeri Group Ltd and be part of something great.</p>
                <div class="cta-corporate-features">
                  <div class="cta-feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Growth Opportunities</span>
                  </div>
                  <div class="cta-feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Competitive Benefits</span>
                  </div>
                  <div class="cta-feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Professional Development</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="cta-corporate-action">
                <a href="careers.php" class="cta-corporate-btn">
                  <span>View Open Positions</span>
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
      <div class="preloader-text">BUHEERI GROUP LTD</div>
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

</body>
</html>