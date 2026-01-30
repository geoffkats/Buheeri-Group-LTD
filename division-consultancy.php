<?php
// Page configuration
$page_title = "Consultancy Services Division - Buheeri Group Ltd";
$page_description = "Buheeri Group's Consultancy Division provides expert business advisory, strategic planning, and professional consulting services.";
$page_keywords = "Consultancy, Business Advisory, Strategic Planning, Management Consulting, Uganda, Buheeri Group";
$current_page = "divisions";
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

<body class="services-page">

  <?php include 'includes/header.php'; ?>

  <main class="main">
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);">
      <div class="container position-relative">
        <h1>Consultancy Services</h1>
        <p>Strategic insights and expert guidance for business excellence</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li><a href="#">Divisions</a></li>
            <li class="current">Consultancy Services</li>
          </ol>
        </nav>
      </div>
    </div>

    <section id="overview" class="about section">
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <h3>Division Overview</h3>
            <p>Buheeri Group Ltd offers structured consultancy services designed to support institutions and businesses to plan effectively, manage projects, and meet technical and compliance requirements. We work with public sector entities, private companies, and development-oriented organizations across Uganda, providing practical advisory support that responds to real operational and regulatory needs.</p>
            <p>Our business advisory services focus on strengthening organizational performance and decision-making. We support clients through organizational assessments, business planning, strategy development, and systems improvement. Our advisory work helps institutions align programmes with policy requirements, improve internal processes, and translate strategic plans into clear, actionable activities that can be implemented and measured.</p>
            <p>Through project management services, we support clients to deliver projects efficiently and responsibly. We provide project planning, coordination of stakeholders and service providers, progress tracking, and performance reporting. Our approach emphasizes timely delivery, budget control, and clear documentation, helping clients maintain accountability and oversight throughout the project lifecycle.</p>
            <p>Our technical and compliance consulting services help organizations meet regulatory, procurement, and operational standards while reducing risk. We provide advisory support on procurement and contract management, compliance with institutional and PPDA requirements, development of procedures and manuals, and technical reviews. We work closely with client teams to ensure compliance processes are understood, applied correctly, and properly documented.</p>
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <img src="assets/img/features-2.jpg" class="img-fluid rounded" alt="Consultancy Services">
          </div>
        </div>
      </div>
    </section>

    <section id="services-list" class="section light-background">
      <div class="container section-title" data-aos="fade-up">
        <span>Our Services</span>
        <h2>Consultancy Solutions</h2>
        <p>Structured consultancy services for institutions and businesses</p>
      </div>
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <ul class="service-list">
              <li><i class="bi bi-check-circle-fill"></i> Business Advisory Services</li>
              <li><i class="bi bi-check-circle-fill"></i> Organizational Assessments</li>
              <li><i class="bi bi-check-circle-fill"></i> Business Planning & Strategy Development</li>
              <li><i class="bi bi-check-circle-fill"></i> Systems Improvement</li>
              <li><i class="bi bi-check-circle-fill"></i> Project Management Services</li>
              <li><i class="bi bi-check-circle-fill"></i> Project Planning & Coordination</li>
            </ul>
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <ul class="service-list">
              <li><i class="bi bi-check-circle-fill"></i> Progress Tracking & Performance Reporting</li>
              <li><i class="bi bi-check-circle-fill"></i> Technical & Compliance Consulting</li>
              <li><i class="bi bi-check-circle-fill"></i> Procurement & Contract Management</li>
              <li><i class="bi bi-check-circle-fill"></i> PPDA Compliance Advisory</li>
              <li><i class="bi bi-check-circle-fill"></i> Procedures & Manuals Development</li>
              <li><i class="bi bi-check-circle-fill"></i> Technical Reviews</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section id="key-strengths" class="key-strengths section">
      <div class="container section-title" data-aos="fade-up">
        <span>Why Choose Us</span>
        <h2>Our Consulting Approach</h2>
      </div>
      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="strength-item">
              <div class="icon"><i class="bi bi-lightbulb"></i></div>
              <div>
                <h5>Strategic Thinking</h5>
                <p>Data-driven insights and innovative solutions tailored to your business objectives.</p>
              </div>
            </div>
            <div class="strength-item">
              <div class="icon"><i class="bi bi-people"></i></div>
              <div>
                <h5>Expert Team</h5>
                <p>Seasoned consultants with diverse industry experience and proven track records.</p>
              </div>
            </div>
            <div class="strength-item">
              <div class="icon"><i class="bi bi-graph-up-arrow"></i></div>
              <div>
                <h5>Results-Oriented</h5>
                <p>Focus on measurable outcomes and sustainable business improvements.</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="strength-item">
              <div class="icon"><i class="bi bi-people-fill"></i></div>
              <div>
                <h5>Collaborative Partnership</h5>
                <p>Working closely with your team to ensure knowledge transfer and capability building.</p>
              </div>
            </div>
            <div class="strength-item">
              <div class="icon"><i class="bi bi-shield-check"></i></div>
              <div>
                <h5>Confidentiality</h5>
                <p>Strict adherence to professional ethics and client confidentiality standards.</p>
              </div>
            </div>
            <div class="strength-item">
              <div class="icon"><i class="bi bi-globe"></i></div>
              <div>
                <h5>Local & Regional Expertise</h5>
                <p>Deep understanding of East African markets and business environments.</p>
              </div>
            </div>
          </div>
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
                <span class="cta-corporate-badge">CONSULTANCY SERVICES</span>
                <h2 class="cta-corporate-title">Ready to Transform Your Business?</h2>
                <p class="cta-corporate-text">Partner with our expert consultants to unlock your organization's full potential. Get strategic insights and actionable solutions tailored to your unique challenges.</p>
                <div class="cta-corporate-features">
                  <div class="cta-feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Free Initial Consultation</span>
                  </div>
                  <div class="cta-feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Customized Solutions</span>
                  </div>
                  <div class="cta-feature-item">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>Proven Methodologies</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4">
              <div class="cta-corporate-action">
                <a href="contact.php" class="cta-corporate-btn">
                  <span>Schedule Consultation</span>
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
</body>
</html>
