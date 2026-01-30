<?php
// Load configuration
require_once 'config.php';

// Page configuration
$page_title = "Contact Us - " . SITE_NAME;
$page_description = "Get in touch with " . SITE_NAME . ". Contact us for inquiries, quotes, or partnership opportunities.";
$page_keywords = "Contact, Buheeri Group, Uganda, Kampala, Get in Touch";
$current_page = "contact";

// Start session to get form response
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Get form response from session
$form_response = $_SESSION['form_response'] ?? null;
unset($_SESSION['form_response']); // Clear after reading

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

<body class="contact-page">

  <?php include 'includes/header.php'; ?>

  <main class="main">
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);">
      <div class="container position-relative">
        <h1>Contact Us</h1>
        <p>Get in touch with Buheeri Group Ltd - Head Office: Tororo | Branch: Ntinda, Kampala | Call: +256 776 722 138</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li class="current">Contact</li>
          </ol>
        </nav>
      </div>
    </div>

    <section id="contact" class="contact section">
      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="mb-5" data-aos="fade-up" data-aos-delay="200">
          <iframe style="border:0; width: 100%; height: 350px;" src="<?php echo GOOGLE_MAPS_EMBED; ?>" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="row gy-4">
          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Head Office</h3>
                <p>Plot No. 7, Asinge Road, Amagoro 'A' South Village<br>Eastern Division, Tororo<br>P.O. Box 300200, Tororo, Uganda</p>
                <p class="mt-2">
                  <a href="https://maps.google.com/?q=Plot+No.+7,+Asinge+Road,+Amagoro+A+South+Village,+Eastern+Division,+Tororo,+Uganda" 
                     target="_blank" 
                     class="btn btn-outline-primary btn-sm">
                    <i class="bi bi-geo-alt-fill"></i> View on Google Maps
                  </a>
                </p>
              </div>
            </div>

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="350">
              <i class="bi bi-building flex-shrink-0"></i>
              <div>
                <h3>Branch Office</h3>
                <p>Ntinda, Kampala, Uganda</p>
              </div>
            </div>

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Call Us</h3>
                <p>+256 776 722 138<br>+256 772 459 386</p>
              </div>
            </div>

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Email Us</h3>
                <p>buheeri.consults@gmail.com<br>info@buheeri.co.ug</p>
              </div>
            </div>

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="600">
              <i class="bi bi-clock flex-shrink-0"></i>
              <div>
                <h3>Business Hours</h3>
                <p>Monday - Friday: 8:00 AM - 5:00 PM<br>Saturday: 9:00 AM - 1:00 PM</p>
              </div>
            </div>
          </div>

          <div class="col-lg-8">
            <?php if (!empty($success_message)): ?>
              <div class="alert alert-success"><?php echo $success_message; ?></div>
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

            <form action="forms/submit-contact.php" method="post" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">
                <div class="col-md-6">
                  <input type="text" name="name" class="form-control" placeholder="Your Name" required value="<?php echo $_POST['name'] ?? ''; ?>">
                </div>

                <div class="col-md-6">
                  <input type="email" class="form-control" name="email" placeholder="Your Email" required value="<?php echo $_POST['email'] ?? ''; ?>">
                </div>

                <div class="col-md-6">
                  <input type="tel" class="form-control" name="phone" placeholder="Your Phone Number" value="<?php echo $_POST['phone'] ?? ''; ?>">
                </div>

                <div class="col-md-6">
                  <select name="division" class="form-control">
                    <option value="">Select Division (Optional)</option>
                    <option value="general-supply" <?php echo (($_POST['division'] ?? '') == 'general-supply') ? 'selected' : ''; ?>>General Supply</option>
                    <option value="construction" <?php echo (($_POST['division'] ?? '') == 'construction') ? 'selected' : ''; ?>>Construction & Engineering</option>
                    <option value="labour" <?php echo (($_POST['division'] ?? '') == 'labour') ? 'selected' : ''; ?>>Labour Recruitment & Training</option>
                    <option value="logistics" <?php echo (($_POST['division'] ?? '') == 'logistics') ? 'selected' : ''; ?>>Clearing & Forwarding / Logistics</option>
                    <option value="general" <?php echo (($_POST['division'] ?? '') == 'general') ? 'selected' : ''; ?>>General Inquiry</option>
                  </select>
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" placeholder="Subject" required value="<?php echo $_POST['subject'] ?? ''; ?>">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" rows="6" placeholder="Message" required><?php echo $_POST['message'] ?? ''; ?></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <button type="submit">Send Message</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Division Contacts Section -->
    <section id="division-contacts" class="section light-background">
      <div class="container section-title" data-aos="fade-up">
        <span>Our Divisions</span>
        <h2>Four Specialized Divisions</h2>
        <p>Comprehensive solutions across all sectors</p>
      </div>

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
            <div class="division-info-card">
              <i class="fa-solid fa-boxes-stacked"></i>
              <div>
                <h3>General Supply Division</h3>
                <p>Comprehensive procurement and supply chain solutions for businesses across all sectors.</p>
                <a href="division-general-supply.php" class="learn-more">Learn More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
            <div class="division-info-card">
              <i class="fa-solid fa-helmet-safety"></i>
              <div>
                <h3>Construction & Engineering</h3>
                <p>Building infrastructure that transforms communities and drives economic growth.</p>
                <a href="division-construction.php" class="learn-more">Learn More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
            <div class="division-info-card">
              <i class="fa-solid fa-users-gear"></i>
              <div>
                <h3>Labour Recruitment & Training</h3>
                <p>Connecting skilled professionals with opportunities locally and internationally.</p>
                <a href="division-labour.php" class="learn-more">Learn More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div>

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">
            <div class="division-info-card">
              <i class="fa-solid fa-truck-fast"></i>
              <div>
                <h3>Clearing & Forwarding / Logistics</h3>
                <p>Seamless logistics and customs clearance services across East Africa.</p>
                <a href="division-logistics.php" class="learn-more">Learn More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="500">
          <p class="contact-note">For all division inquiries, please use the contact form above or reach us at:</p>
          <p class="contact-details">
            <strong>Email:</strong> buheeri.consults@gmail.com | info@buheeri.co.ug<br>
            <strong>Phone:</strong> +256 776 722 138 | +256 772 459 386
          </p>
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
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>