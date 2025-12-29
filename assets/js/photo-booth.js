/**
 * Prime Academy Digital Photo Booth
 * Photo Booth Camera & Image Processing
 * 
 * Features:
 * - Camera initialization with getUserMedia
 * - Front/back camera switching
 * - Photo capture with frame overlay
 * - Image download
 * - Lead form submission
 * - Error handling
 */

// ============================================
// Global Variables
// ============================================

let videoStream = null;
let currentFacingMode = 'user'; // 'user' = front camera, 'environment' = back camera
let capturedImageBlob = null;
let leadSaved = false;

// Frame overlay configuration
const FRAME_URL = 'assets/img/frame.png';
const CANVAS_WIDTH = 1200;
const CANVAS_HEIGHT = 1600;

// DOM Elements
const video = document.getElementById('video');
const canvas = document.getElementById('canvas');
const startBtn = document.getElementById('startBtn');
const switchBtn = document.getElementById('switchBtn');
const captureBtn = document.getElementById('captureBtn');
const retakeBtn = document.getElementById('retakeBtn');
const downloadBtn = document.getElementById('downloadBtn');
const cameraPlaceholder = document.getElementById('cameraPlaceholder');
const cameraError = document.getElementById('cameraError');
const previewPlaceholder = document.getElementById('previewPlaceholder');
const capturedImage = document.getElementById('capturedImage');
const leadForm = document.getElementById('leadForm');
const leadFormCard = document.getElementById('leadFormCard');
const leadSuccess = document.getElementById('leadSuccess');
const submitLeadBtn = document.getElementById('submitLeadBtn');

// ============================================
// Initialize Event Listeners
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    if (startBtn) startBtn.addEventListener('click', initCamera);
    if (switchBtn) switchBtn.addEventListener('click', switchCamera);
    if (captureBtn) captureBtn.addEventListener('click', capturePhoto);
    if (retakeBtn) retakeBtn.addEventListener('click', retakePhoto);
    if (downloadBtn) downloadBtn.addEventListener('click', downloadImage);
    if (leadForm) leadForm.addEventListener('submit', submitLead);
    
    // Check if HTTPS (required for camera access)
    checkSecureContext();
    
    // Check if camera is supported
    checkCameraSupport();
});

// ============================================
// Security & Compatibility Checks
// ============================================

function checkSecureContext() {
    if (location.protocol !== 'https:' && location.hostname !== 'localhost' && location.hostname !== '127.0.0.1') {
        showCameraError('⚠️ HTTPS Required', 'Camera access requires a secure connection (HTTPS). Please use HTTPS or localhost.');
        if (startBtn) startBtn.disabled = true;
    }
}

function checkCameraSupport() {
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        showCameraError('❌ Camera Not Supported', 'Your browser does not support camera access. Please use Chrome, Firefox, Safari, or Edge.');
        if (startBtn) startBtn.disabled = true;
    }
}

// ============================================
// Camera Initialization
// ============================================

async function initCamera() {
    try {
        // Hide error if showing
        if (cameraError) cameraError.style.display = 'none';
        
        // Show loading state
        if (startBtn) {
            startBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Requesting...';
            startBtn.disabled = true;
        }
        
        // Stop existing stream
        if (videoStream) {
            stopCamera();
        }
        
        // Request camera access
        const constraints = {
            video: {
                facingMode: currentFacingMode,
                width: { ideal: 1920 },
                height: { ideal: 1080 }
            },
            audio: false
        };
        
        videoStream = await navigator.mediaDevices.getUserMedia(constraints);
        
        // Attach stream to video element
        if (video) {
            video.srcObject = videoStream;
            video.style.display = 'block';
        }
        
        // Hide placeholder
        if (cameraPlaceholder) cameraPlaceholder.style.display = 'none';
        
        // Update UI
        if (startBtn) startBtn.style.display = 'none';
        if (captureBtn) captureBtn.style.display = 'block';
        
        // Show switch camera button if multiple cameras available
        checkMultipleCameras();
        
        showToast('Success', 'Camera started successfully!', 'success');
        
    } catch (error) {
        console.error('Camera error:', error);
        handleCameraError(error);
    }
}

// ============================================
// Check Multiple Cameras
// ============================================

async function checkMultipleCameras() {
    try {
        const devices = await navigator.mediaDevices.enumerateDevices();
        const videoDevices = devices.filter(device => device.kind === 'videoinput');
        
        if (videoDevices.length > 1 && switchBtn) {
            switchBtn.style.display = 'block';
        }
    } catch (error) {
        console.error('Error checking cameras:', error);
    }
}

// ============================================
// Switch Camera (Front/Back)
// ============================================

async function switchCamera() {
    currentFacingMode = currentFacingMode === 'user' ? 'environment' : 'user';
    await initCamera();
}

// ============================================
// Capture Photo
// ============================================

async function capturePhoto() {
    if (!video || !canvas) {
        showToast('Error', 'Camera elements not found', 'error');
        return;
    }
    
    try {
        // Show loading state
        if (captureBtn) {
            captureBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Capturing...';
            captureBtn.disabled = true;
        }
        
        // Set canvas dimensions
        canvas.width = CANVAS_WIDTH;
        canvas.height = CANVAS_HEIGHT;
        
        const ctx = canvas.getContext('2d');
        
        // Calculate video aspect ratio and positioning
        const videoAspect = video.videoWidth / video.videoHeight;
        const canvasAspect = CANVAS_WIDTH / CANVAS_HEIGHT;
        
        let drawWidth, drawHeight, offsetX, offsetY;
        
        if (videoAspect > canvasAspect) {
            // Video is wider - fit height
            drawHeight = CANVAS_HEIGHT;
            drawWidth = drawHeight * videoAspect;
            offsetX = (CANVAS_WIDTH - drawWidth) / 2;
            offsetY = 0;
        } else {
            // Video is taller - fit width
            drawWidth = CANVAS_WIDTH;
            drawHeight = drawWidth / videoAspect;
            offsetX = 0;
            offsetY = (CANVAS_HEIGHT - drawHeight) / 2;
        }
        
        // Draw video frame (fill canvas, center crop)
        ctx.fillStyle = '#000';
        ctx.fillRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
        ctx.drawImage(video, offsetX, offsetY, drawWidth, drawHeight);
        
        // Load and draw frame overlay
        await drawFrameOverlay(ctx);
        
        // Convert canvas to blob
        capturedImageBlob = await new Promise(resolve => {
            canvas.toBlob(resolve, 'image/png', 0.95);
        });
        
        // Display captured image
        const imageUrl = URL.createObjectURL(capturedImageBlob);
        if (capturedImage) {
            capturedImage.src = imageUrl;
            capturedImage.style.display = 'block';
        }
        if (previewPlaceholder) {
            previewPlaceholder.style.display = 'none';
        }
        
        // Update UI
        if (captureBtn) {
            captureBtn.style.display = 'none';
        }
        if (retakeBtn) {
            retakeBtn.style.display = 'block';
        }
        if (downloadBtn) {
            downloadBtn.style.display = 'block';
            // Keep disabled until lead is saved
            if (!leadSaved) {
                downloadBtn.disabled = true;
            }
        }
        
        // Scroll to lead form
        if (leadFormCard && !leadSaved) {
            leadFormCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        
        showToast('Success', 'Photo captured! Fill in your info to download.', 'success');
        
    } catch (error) {
        console.error('Capture error:', error);
        showToast('Error', 'Failed to capture photo. Please try again.', 'error');
        
        // Reset button
        if (captureBtn) {
            captureBtn.innerHTML = '<i class="bi bi-camera-fill me-1"></i> Capture Photo';
            captureBtn.disabled = false;
        }
    }
}

// ============================================
// Draw Frame Overlay on Canvas
// ============================================

async function drawFrameOverlay(ctx) {
    return new Promise((resolve, reject) => {
        const frameImage = new Image();
        
        frameImage.onload = function() {
            // Draw frame overlay on top
            ctx.drawImage(frameImage, 0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
            resolve();
        };
        
        frameImage.onerror = function() {
            console.warn('Frame image not found. Proceeding without frame overlay.');
            // Continue without frame if image not found
            resolve();
        };
        
        // Set frame source
        frameImage.src = FRAME_URL;
        
        // Timeout fallback
        setTimeout(() => {
            console.warn('Frame loading timeout. Proceeding without frame.');
            resolve();
        }, 3000);
    });
}

// ============================================
// Retake Photo
// ============================================

function retakePhoto() {
    // Hide captured image
    if (capturedImage) {
        capturedImage.style.display = 'none';
    }
    if (previewPlaceholder) {
        previewPlaceholder.style.display = 'flex';
    }
    
    // Reset UI
    if (captureBtn) {
        captureBtn.style.display = 'block';
        captureBtn.innerHTML = '<i class="bi bi-camera-fill me-1"></i> Capture Photo';
        captureBtn.disabled = false;
    }
    if (retakeBtn) {
        retakeBtn.style.display = 'none';
    }
    if (downloadBtn) {
        downloadBtn.style.display = 'none';
    }
    
    // Clear captured image
    capturedImageBlob = null;
}

// ============================================
// Download Image
// ============================================

function downloadImage() {
    if (!capturedImageBlob) {
        showToast('Error', 'No image to download', 'error');
        return;
    }
    
    if (!leadSaved) {
        showToast('Error', 'Please fill in your information first', 'error');
        leadFormCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
        return;
    }
    
    try {
        // Create download link
        const url = URL.createObjectURL(capturedImageBlob);
        const link = document.createElement('a');
        const timestamp = new Date().getTime();
        link.href = url;
        link.download = `PrimeAcademy_PhotoBooth_${timestamp}.png`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        
        // Clean up URL
        setTimeout(() => URL.revokeObjectURL(url), 100);
        
        showToast('Success', 'Image downloaded! Now post it on Facebook.', 'success');
        
    } catch (error) {
        console.error('Download error:', error);
        showToast('Error', 'Failed to download image', 'error');
    }
}

// ============================================
// Submit Lead Form
// ============================================

async function submitLead(event) {
    event.preventDefault();
    
    if (leadSaved) {
        showToast('Info', 'Your information is already saved', 'success');
        return;
    }
    
    // Get form data
    const formData = new FormData(leadForm);
    const data = {
        name: formData.get('name'),
        phone: formData.get('phone'),
        course: formData.get('course'),
        consent: formData.get('consent') ? 'true' : 'false'
    };
    
    // Validate
    if (!data.name || data.name.trim().length < 2) {
        showToast('Error', 'Please enter a valid name', 'error');
        return;
    }
    
    if (!data.phone || data.phone.trim().length < 10) {
        showToast('Error', 'Please enter a valid phone number', 'error');
        return;
    }
    
    if (!data.course) {
        showToast('Error', 'Please select a course', 'error');
        return;
    }
    
    if (data.consent !== 'true') {
        showToast('Error', 'Please agree to the campaign rules', 'error');
        return;
    }
    
    // Show loading state
    setButtonLoading(submitLeadBtn, true);
    
    try {
        // Submit to backend
        const response = await fetch('submit-lead.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });
        
        const result = await response.json();
        
        if (result.ok) {
            leadSaved = true;
            
            // Hide form, show success
            if (leadForm) leadForm.style.display = 'none';
            if (leadSuccess) leadSuccess.style.display = 'block';
            
            // Enable download button
            if (downloadBtn) {
                downloadBtn.disabled = false;
            }
            
            showToast('Success', result.message || 'Information saved successfully!', 'success');
            
            // Save to localStorage
            saveToLocalStorage('prime_lead_saved', true);
            saveToLocalStorage('prime_lead_name', data.name);
            
        } else {
            showToast('Error', result.message || 'Failed to save information', 'error');
        }
        
    } catch (error) {
        console.error('Submit error:', error);
        showToast('Error', 'Network error. Please check your connection.', 'error');
    } finally {
        setButtonLoading(submitLeadBtn, false);
    }
}

// ============================================
// Stop Camera
// ============================================

function stopCamera() {
    if (videoStream) {
        videoStream.getTracks().forEach(track => track.stop());
        videoStream = null;
    }
    
    if (video) {
        video.srcObject = null;
        video.style.display = 'none';
    }
}

// ============================================
// Show Camera Error
// ============================================

function showCameraError(title, message) {
    if (cameraError) {
        const errorText = cameraError.querySelector('p');
        if (errorText) {
            errorText.innerHTML = `<strong>${title}</strong><br>${message}`;
        }
        cameraError.style.display = 'flex';
    }
    
    if (cameraPlaceholder) {
        cameraPlaceholder.style.display = 'none';
    }
}

// ============================================
// Handle Camera Errors
// ============================================

function handleCameraError(error) {
    let title = 'Camera Error';
    let message = 'Unable to access camera. ';
    
    if (error.name === 'NotAllowedError' || error.name === 'PermissionDeniedError') {
        title = 'Permission Denied';
        message = 'Camera access was denied. Please allow camera permission in your browser settings and refresh the page.';
    } else if (error.name === 'NotFoundError' || error.name === 'DevicesNotFoundError') {
        title = 'No Camera Found';
        message = 'No camera device was found on your device. Please connect a camera and try again.';
    } else if (error.name === 'NotReadableError' || error.name === 'TrackStartError') {
        title = 'Camera In Use';
        message = 'Camera is already in use by another application. Please close other apps and try again.';
    } else if (error.name === 'OverconstrainedError' || error.name === 'ConstraintNotSatisfiedError') {
        title = 'Camera Not Compatible';
        message = 'Your camera does not meet the requirements. Try using a different camera.';
    } else if (error.name === 'TypeError') {
        title = 'Configuration Error';
        message = 'Camera configuration error. Please try a different browser.';
    } else {
        message += error.message || 'Unknown error occurred.';
    }
    
    showCameraError(title, message);
    showToast('Error', message, 'error');
    
    // Reset button
    if (startBtn) {
        startBtn.innerHTML = '<i class="bi bi-camera-fill me-1"></i> Try Again';
        startBtn.disabled = false;
        startBtn.style.display = 'block';
    }
    if (captureBtn) {
        captureBtn.style.display = 'none';
    }
}

// ============================================
// Check if Lead Already Saved
// ============================================

function checkLeadStatus() {
    const saved = getFromLocalStorage('prime_lead_saved');
    if (saved) {
        leadSaved = true;
        if (leadForm) leadForm.style.display = 'none';
        if (leadSuccess) {
            leadSuccess.style.display = 'block';
            const name = getFromLocalStorage('prime_lead_name') || 'there';
            leadSuccess.innerHTML = `<i class="bi bi-check-circle-fill me-2"></i>Welcome back, ${name}! You can now download your photo.`;
        }
        if (downloadBtn) {
            downloadBtn.disabled = false;
        }
    }
}

// ============================================
// Cleanup on Page Unload
// ============================================

window.addEventListener('beforeunload', function() {
    stopCamera();
});

// ============================================
// Initialize on Load
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    checkLeadStatus();
});

// ============================================
// Helper Functions from app.js
// ============================================

function showToast(title, message, type) {
    if (window.PrimeApp && window.PrimeApp.showToast) {
        window.PrimeApp.showToast(title, message, type);
    }
}

function setButtonLoading(button, isLoading) {
    if (window.PrimeApp && window.PrimeApp.setButtonLoading) {
        window.PrimeApp.setButtonLoading(button, isLoading);
    }
}

function saveToLocalStorage(key, value) {
    if (window.PrimeApp && window.PrimeApp.saveToLocalStorage) {
        return window.PrimeApp.saveToLocalStorage(key, value);
    }
    return false;
}

function getFromLocalStorage(key) {
    if (window.PrimeApp && window.PrimeApp.getFromLocalStorage) {
        return window.PrimeApp.getFromLocalStorage(key);
    }
    return null;
}
