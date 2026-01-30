<?php
// Page configuration
$page_title = "Careers - Buheeri Group U Ltd";
$page_description = "Join the Buheeri Group team. Explore career opportunities across our divisions.";
$page_keywords = "Careers, Jobs, Employment, Opportunities, Uganda, Buheeri Group";
$current_page = "careers";

// Start session to get form response
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database
require_once 'includes/database.php';

$db = new Database();

// Get active job positions from database
$jobPositions = $db->getActiveJobPositions();

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

<body class="careers-page">

  <?php include 'includes/header.php'; ?>

  <main class="main">
    <div class="page-title dark-background" data-aos="fade" style="background-image: url(assets/img/page-title-bg.jpg);">
      <div class="container position-relative">
        <h1>Careers</h1>
        <p>Join our team and build your future with Buheeri Group U Ltd</p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.php">Home</a></li>
            <li class="current">Careers</li>
          </ol>
        </nav>
      </div>
    </div>

    <!-- Why Work With Us Section -->
    <section id="culture" class="section light-background">
      <div class="container section-title" data-aos="fade-up">
        <span>Our Culture</span>
        <h2>Why Work With Us</h2>
        <p>Discover what makes Buheeri Group a great place to build your career</p>
      </div>

      <div class="container">
        <div class="row gy-4">
          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="culture-item">
              <div class="icon"><i class="bi bi-graph-up-arrow"></i></div>
              <h4>Career Growth</h4>
              <p>Clear career progression paths and opportunities for advancement across all divisions.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
            <div class="culture-item">
              <div class="icon"><i class="bi bi-mortarboard"></i></div>
              <h4>Learning & Development</h4>
              <p>Continuous training programs and skills development opportunities.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="culture-item">
              <div class="icon"><i class="bi bi-people"></i></div>
              <h4>Collaborative Environment</h4>
              <p>Work with talented professionals in a supportive team atmosphere.</p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="culture-item">
              <div class="icon"><i class="bi bi-award"></i></div>
              <h4>Competitive Benefits</h4>
              <p>Attractive compensation packages and comprehensive employee benefits.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Open Positions Section -->
    <section id="jobs" class="section">
      <div class="container section-title" data-aos="fade-up">
        <span>Open Positions</span>
        <h2>Current Opportunities</h2>
        <p>Explore available positions across our divisions</p>
      </div>

      <div class="container">
        <?php if (empty($jobPositions)): ?>
          <div class="alert alert-info text-center" data-aos="fade-up">
            <h4>No Open Positions Currently</h4>
            <p>We don't have any open positions at the moment, but we're always looking for talented individuals. Please check back later or submit your application below for future opportunities.</p>
          </div>
        <?php else: ?>
          <?php foreach ($jobPositions as $index => $job): ?>
          <div class="job-card" data-aos="fade-up" data-aos-delay="<?php echo 100 + ($index * 100); ?>">
            <h4><?php echo htmlspecialchars($job['title']); ?></h4>
            <div class="job-meta">
              <span><i class="bi bi-briefcase"></i> <?php echo ucfirst(htmlspecialchars($job['division'])); ?></span>
              <span><i class="bi bi-geo-alt"></i> <?php echo htmlspecialchars($job['location'] ?? 'Uganda'); ?></span>
              <span><i class="bi bi-clock"></i> <?php echo ucfirst(str_replace('-', ' ', htmlspecialchars($job['type']))); ?></span>
            </div>
            <?php if (!empty($job['description'])): ?>
              <p><?php echo htmlspecialchars($job['description']); ?></p>
            <?php endif; ?>
            <?php if (!empty($job['requirements'])): ?>
              <p><strong>Requirements:</strong> <?php echo htmlspecialchars($job['requirements']); ?></p>
            <?php endif; ?>
            <a href="#apply" class="btn btn-primary">Apply Now</a>
          </div>
          <?php endforeach; ?>
        <?php endif; ?>
      </div>
    </section>

    <!-- Application Form Section -->
    <section id="apply" class="section light-background">
      <div class="container section-title" data-aos="fade-up">
        <span>Apply</span>
        <h2>Submit Your Application</h2>
        <p>Fill out the form below to apply for any position</p>
      </div>

      <div class="container">
        <div class="row justify-content-center">
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

            <div class="application-form" data-aos="fade-up" data-aos-delay="100">
              <h3>Application Form</h3>
              <form action="forms/submit-career.php" method="post" enctype="multipart/form-data">
                <div class="row gy-4">
                  <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Full Name" required value="<?php echo $_POST['name'] ?? ''; ?>">
                  </div>
                  <div class="col-md-6">
                    <input type="email" class="form-control" name="email" placeholder="Email Address" required value="<?php echo $_POST['email'] ?? ''; ?>">
                  </div>
                  <div class="col-md-6">
                    <input type="tel" class="form-control" name="phone" placeholder="Phone Number" required value="<?php echo $_POST['phone'] ?? ''; ?>">
                  </div>
                  <div class="col-md-6">
                    <select name="position" class="form-control" required>
                      <option value="">Select Position</option>
                      <?php foreach ($jobPositions as $job): ?>
                        <option value="<?php echo htmlspecialchars($job['title']); ?>" 
                                <?php echo (($_POST['position'] ?? '') == $job['title']) ? 'selected' : ''; ?>>
                          <?php echo htmlspecialchars($job['title']); ?>
                        </option>
                      <?php endforeach; ?>
                      <option value="Other Position" <?php echo (($_POST['position'] ?? '') == 'Other Position') ? 'selected' : ''; ?>>Other Position</option>
                    </select>
                  </div>
                  <div class="col-12">
                    <textarea class="form-control" name="cover_letter" rows="6" placeholder="Cover Letter / Why you're interested in this position" required><?php echo $_POST['cover_letter'] ?? ''; ?></textarea>
                  </div>
                  <div class="col-12">
                    <label class="form-label">Upload CV/Resume (PDF format)</label>
                    <input type="file" class="form-control" name="cv" accept=".pdf" required>
                  </div>
                  <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit Application</button>
                  </div>
                </div>
              </form>
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
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/js/main.js"></script>
</body>
</html>