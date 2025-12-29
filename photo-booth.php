<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Booth - Prime Academy Bangladesh</title>
    
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
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="index.php">
                <img src="assets/img/logo.png" alt="Prime Academy Bangladesh" height="40" class="me-2" onerror="this.style.display='none'">
                <span class="fw-bold">Prime Academy</span>
            </a>
            <a href="index.php" class="btn btn-outline-light btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Back to Home
            </a>
        </div>
    </nav>

    <!-- Photo Booth Section -->
    <section class="py-4">
        <div class="container">
            <div class="text-center mb-4">
                <h2 class="fw-bold">📸 Digital Photo Booth</h2>
                <p class="text-muted">Capture your moment with Prime Academy frame</p>
            </div>

            <div class="row g-4">
                <!-- Camera Preview Column -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-camera-video-fill me-2"></i>Camera Preview</h5>
                        </div>
                        <div class="card-body p-0 position-relative">
                            <div id="cameraContainer" class="camera-container">
                                <video id="video" autoplay playsinline></video>
                                <canvas id="canvas" style="display: none;"></canvas>
                                <div id="cameraPlaceholder" class="camera-placeholder">
                                    <i class="bi bi-camera-fill display-1 text-muted"></i>
                                    <p class="text-muted mt-3">Click "Allow Camera" to start</p>
                                </div>
                                <div id="cameraError" class="camera-error" style="display: none;">
                                    <i class="bi bi-exclamation-triangle-fill display-4 text-danger"></i>
                                    <p class="text-danger mt-3 px-3"></p>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex flex-wrap gap-2">
                                <button id="startBtn" class="btn btn-accent flex-fill">
                                    <i class="bi bi-camera-fill me-1"></i> Allow Camera
                                </button>
                                <button id="switchBtn" class="btn btn-secondary" style="display: none;" title="Switch Camera">
                                    <i class="bi bi-arrow-repeat"></i>
                                </button>
                                <button id="captureBtn" class="btn btn-success flex-fill" style="display: none;">
                                    <i class="bi bi-camera-fill me-1"></i> Capture Photo
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Captured Preview Column -->
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-secondary text-white">
                            <h5 class="mb-0"><i class="bi bi-image-fill me-2"></i>Your Photo</h5>
                        </div>
                        <div class="card-body p-0">
                            <div id="previewContainer" class="preview-container">
                                <div id="previewPlaceholder" class="preview-placeholder">
                                    <i class="bi bi-image display-1 text-muted"></i>
                                    <p class="text-muted mt-3">Your captured photo will appear here</p>
                                </div>
                                <img id="capturedImage" style="display: none;" alt="Captured Photo">
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex gap-2">
                                <button id="retakeBtn" class="btn btn-warning flex-fill" style="display: none;">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Retake
                                </button>
                                <button id="downloadBtn" class="btn btn-accent flex-fill" style="display: none;" disabled>
                                    <i class="bi bi-download me-1"></i> Download Image
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Lead Form Section -->
            <div class="row mt-4">
                <div class="col-lg-8 mx-auto">
                    <div class="card shadow-sm" id="leadFormCard">
                        <div class="card-header bg-success text-white">
                            <h5 class="mb-0"><i class="bi bi-person-fill me-2"></i>Save Your Info to Download</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-3">Please provide your information to unlock the download button and receive campaign updates.</p>
                            <form id="leadForm">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="phone" class="form-label">Phone Number <span class="text-danger">*</span></label>
                                        <input type="tel" class="form-control" id="phone" name="phone" required placeholder="01XXX-XXXXXX">
                                    </div>
                                    <div class="col-12">
                                        <label for="course" class="form-label">Course Interest <span class="text-danger">*</span></label>
                                        <select class="form-select" id="course" name="course" required>
                                            <option value="">-- Select a course --</option>
                                            <option value="UI/UX Design">UI/UX Design</option>
                                            <option value="Graphic Design">Graphic Design</option>
                                            <option value="IELTS Preparation">IELTS Preparation</option>
                                            <option value="Digital Marketing">Digital Marketing</option>
                                            <option value="Web Development">Web Development</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="consent" name="consent" required>
                                            <label class="form-check-label" for="consent">
                                                I agree to post this photo on Facebook and follow all campaign rules <span class="text-danger">*</span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-success w-100" id="submitLeadBtn">
                                            <i class="bi bi-check-circle-fill me-2"></i>Save & Enable Download
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div id="leadSuccess" style="display: none;" class="alert alert-success mt-3 mb-0">
                                <i class="bi bi-check-circle-fill me-2"></i>Information saved! You can now download your photo.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Caption Section -->
            <div class="row mt-4">
                <div class="col-lg-8 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="bi bi-chat-quote-fill me-2"></i>Ready-Made Caption</h5>
                        </div>
                        <div class="card-body">
                            <p class="mb-2">Copy this caption for your Facebook post:</p>
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

            <!-- Instructions -->
            <div class="row mt-4">
                <div class="col-lg-8 mx-auto">
                    <div class="alert alert-info">
                        <h6 class="alert-heading"><i class="bi bi-info-circle-fill me-2"></i>Instructions</h6>
                        <ol class="mb-0 ps-3">
                            <li>Click "Allow Camera" and grant camera permission</li>
                            <li>Position yourself and click "Capture Photo"</li>
                            <li>Fill in your information and submit the form</li>
                            <li>Download your photo with the Prime Academy frame</li>
                            <li>Post to Facebook following the campaign rules</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer mt-5">
        <div class="container text-center">
            <p class="mb-2">&copy; 2025 Prime Academy Bangladesh. All rights reserved.</p>
            <a href="index.php" class="text-white">Back to Campaign Page</a>
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
        <div id="errorToast" class="toast" role="alert">
            <div class="toast-header bg-danger text-white">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong class="me-auto">Error</strong>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
            </div>
            <div class="toast-body"></div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Shared JS -->
    <script src="assets/js/app.js"></script>
    
    <!-- Photo Booth JS -->
    <script src="assets/js/photo-booth.js"></script>

</body>
</html>
