<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prime Academy Digital Photo Booth - Take a Photo, Post & Earn Rewards</title>
    <meta name="description" content="Join Prime Academy Bangladesh community campaign. Take a photo with our digital frame, post on Facebook, and earn exciting rewards!">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.css">
    
    <!-- Google Fonts - Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="assets/img/logo.png" alt="Prime Academy Bangladesh" height="50">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#how-it-works">How it Works</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#rewards">Rewards</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#rules">Rules</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn btn-accent text-primary px-3 ms-lg-2" href="photo-booth.php">
                            <i class="bi bi-camera-fill me-1"></i> Photo Booth
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center min-vh-75">
                <div class="col-lg-6 text-center text-lg-start mb-4 mb-lg-0">
                    <h1 class="display-4 fw-bold mb-3">Take a Photo. Post on Facebook. <span class="text-accent">Earn Rewards!</span></h1>
                    <p class="lead mb-4">Join Prime Academy Bangladesh community campaign and showcase your journey towards a brighter future. Capture your moment with our exclusive digital frame!</p>
                    <div class="d-grid d-sm-flex justify-content-center justify-content-lg-start gap-3 mb-4">
                        <a href="photo-booth.php" class="btn btn-accent btn-lg px-5">
                            <i class="bi bi-camera-fill me-2"></i>Start Photo Booth
                        </a>
                    </div>
                    <div class="countdown-box">
                        <i class="bi bi-clock-fill me-2"></i>
                        <strong>Campaign ends in:</strong> 
                        <span id="countdown" class="text-accent fw-bold">7 days</span>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="hero-image-placeholder">
                        <i class="bi bi-camera-fill display-1 text-accent"></i>
                        <p class="mt-3">Digital Photo Booth</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section id="how-it-works" class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">How It Works</h2>
                <p class="text-muted">Three simple steps to earn your rewards</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="card-body">
                            <div class="icon-box mb-3">
                                <i class="bi bi-qr-code display-3 text-primary"></i>
                            </div>
                            <h5 class="card-title fw-bold">Step 1: Open Link</h5>
                            <p class="card-text text-muted">Scan QR code or click the link to access our digital photo booth platform</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="card-body">
                            <div class="icon-box mb-3">
                                <i class="bi bi-camera-fill display-3 text-secondary"></i>
                            </div>
                            <h5 class="card-title fw-bold">Step 2: Take Photo</h5>
                            <p class="card-text text-muted">Capture your best shot with our exclusive Prime Academy frame overlay</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm text-center p-4">
                        <div class="card-body">
                            <div class="icon-box mb-3">
                                <i class="bi bi-facebook display-3 text-accent"></i>
                            </div>
                            <h5 class="card-title fw-bold">Step 3: Post & Earn</h5>
                            <p class="card-text text-muted">Share on Facebook following our rules and claim your exciting rewards</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rewards Section -->
    <section id="rewards" class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold">Exciting Rewards</h2>
                <p class="text-muted">What you can win by participating</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow reward-card">
                        <div class="card-body text-center p-4">
                            <div class="reward-icon mb-3">
                                <i class="bi bi-gift-fill display-1 text-primary"></i>
                            </div>
                            <h5 class="card-title fw-bold">Instant Gift</h5>
                            <p class="card-text">Receive an instant digital gift upon successful participation and posting</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow reward-card">
                        <div class="card-body text-center p-4">
                            <div class="reward-icon mb-3">
                                <i class="bi bi-ticket-perforated-fill display-1 text-secondary"></i>
                            </div>
                            <h5 class="card-title fw-bold">Discount Voucher</h5>
                            <p class="card-text">Get exclusive discount vouchers on Prime Academy courses of your choice</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow reward-card">
                        <div class="card-body text-center p-4">
                            <div class="reward-icon mb-3">
                                <i class="bi bi-trophy-fill display-1 text-accent"></i>
                            </div>
                            <h5 class="card-title fw-bold">Best Photo Prize</h5>
                            <p class="card-text">Weekly contest for the most creative photo with amazing grand prizes</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rules Section -->
    <section id="rules" class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Campaign Rules</h2>
                        <p class="text-muted">Please follow these simple rules to qualify for rewards</p>
                    </div>
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <ul class="rules-list">
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>Follow <strong>Prime Academy Bangladesh</strong> Facebook Page</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>Post the photo <strong>publicly</strong> on your timeline</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>Tag <strong>@Prime Academy Bangladesh</strong> in your post</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>Use hashtag <strong>#PrimeFutureStartsHere</strong></li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>Keep the post public for at least 7 days</li>
                                <li><i class="bi bi-check-circle-fill text-success me-2"></i>One entry per person during campaign period</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Caption Generator Section -->
    <section id="caption" class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Ready-Made Caption</h2>
                        <p class="text-muted">Copy this caption for your Facebook post</p>
                    </div>
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <textarea id="captionText" class="form-control caption-textarea mb-3" rows="6" readonly>📸 My future starts here with Prime Academy Bangladesh! 💙

Captured via Prime Digital Photo Booth.

আমার স্বপ্ন, আমার যাত্রা - Prime Academy Bangladesh এর সাথে!

#PrimeFutureStartsHere @Prime Academy Bangladesh

Join the campaign: [Your Photo Booth Link Here]</textarea>
                            <button class="btn btn-accent w-100" onclick="copyCaption()">
                                <i class="bi bi-clipboard-fill me-2"></i>Copy Caption
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center mb-4">
                        <h2 class="fw-bold">Frequently Asked Questions</h2>
                        <p class="text-muted">Got questions? We've got answers</p>
                    </div>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Is this campaign completely free?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes! Participation is 100% free. There are no hidden costs. Simply take your photo, post it following our rules, and claim your rewards.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    How do I receive my rewards?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    After posting your photo following all rules, our team will verify your submission within 24-48 hours. Rewards will be sent via email or Facebook message. Make sure to provide accurate contact information.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Why must I post publicly?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Public posts help spread awareness about Prime Academy and our community. It also allows us to verify your participation and engagement. Your privacy is important - you can delete the post after the campaign period if you wish.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    What if my camera doesn't work?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Make sure you're using HTTPS and have granted camera permissions. Try using a different browser (Chrome or Safari recommended). If issues persist, ensure your device camera is functional and no other app is using it. For further assistance, contact our support team.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    Can I participate multiple times?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Each person can participate once during the campaign period. Multiple entries from the same person will be disqualified. However, you can retake your photo as many times as you want before posting.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="cta-section py-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-3">Ready to Get Started?</h2>
            <p class="lead mb-4">Take your photo now and join hundreds of others in the Prime Academy community!</p>
            <a href="photo-booth.php" class="btn btn-accent btn-lg px-5">
                <i class="bi bi-camera-fill me-2"></i>Launch Photo Booth
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="fw-bold mb-3">Prime Academy Bangladesh</h5>
                    <p>Empowering futures through quality education in UI/UX, Graphic Design, IELTS, Digital Marketing, and Web Development.</p>
                    <div class="social-links mt-3">
                        <a href="#" class="me-3"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="me-3"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="me-3"><i class="bi bi-youtube"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="fw-bold mb-3">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#how-it-works">How It Works</a></li>
                        <li><a href="#rewards">Rewards</a></li>
                        <li><a href="#rules">Campaign Rules</a></li>
                        <li><a href="#faq">FAQ</a></li>
                        <li><a href="photo-booth.php">Photo Booth</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">Contact Us</h5>
                    <ul class="list-unstyled">
                        <li><i class="bi bi-geo-alt-fill me-2"></i>Dhaka, Bangladesh</li>
                        <li><i class="bi bi-telephone-fill me-2"></i>+880 1XXX-XXXXXX</li>
                        <li><i class="bi bi-envelope-fill me-2"></i>info@primeacademy.com</li>
                        <li><i class="bi bi-clock-fill me-2"></i>Sat - Thu: 9AM - 9PM</li>
                    </ul>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2025 Prime Academy Bangladesh. All rights reserved. | <a href="#" class="text-white">Privacy Policy</a> | <a href="#" class="text-white">Terms of Service</a></p>
            </div>
        </div>
    </footer>

    <!-- Toast Container -->
    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="successToast" class="toast" role="alert">
            <div class="toast-header bg-success text-white">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script src="assets/js/app.js"></script>
    
    <script>
        // Initialize countdown on page load
        document.addEventListener('DOMContentLoaded', function() {
            initCountdown();
        });
    </script>

</body>
</html>
