/**
 * Prime Academy Digital Photo Booth
 * Shared JavaScript Utilities
 * 
 * Includes:
 * - Smooth scrolling
 * - Active navigation highlighting
 * - Countdown timer
 * - Copy caption function
 * - Toast notifications
 */

// ============================================
// Smooth Scrolling for Navigation Links
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    // Smooth scroll for all anchor links
    const smoothScrollLinks = document.querySelectorAll('a[href^="#"]');
    
    smoothScrollLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            
            // Skip if href is just "#"
            if (href === '#') return;
            
            const target = document.querySelector(href);
            
            if (target) {
                e.preventDefault();
                
                // Get navbar height for offset
                const navbar = document.querySelector('.navbar');
                const navbarHeight = navbar ? navbar.offsetHeight : 0;
                
                const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - navbarHeight - 20;
                
                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });
                
                // Update active nav link
                updateActiveNavLink(href);
                
                // Close mobile menu if open
                const navbarCollapse = document.querySelector('.navbar-collapse');
                if (navbarCollapse && navbarCollapse.classList.contains('show')) {
                    const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                        toggle: true
                    });
                }
            }
        });
    });
    
    // Highlight active section on scroll
    window.addEventListener('scroll', highlightActiveSection);
});

// ============================================
// Active Navigation Highlighting
// ============================================

function updateActiveNavLink(href) {
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
    navLinks.forEach(link => {
        link.classList.remove('active');
        if (link.getAttribute('href') === href) {
            link.classList.add('active');
        }
    });
}

function highlightActiveSection() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.navbar-nav .nav-link[href^="#"]');
    
    if (sections.length === 0) return;
    
    const scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
    const navbar = document.querySelector('.navbar');
    const navbarHeight = navbar ? navbar.offsetHeight : 0;
    
    sections.forEach(section => {
        const sectionTop = section.offsetTop - navbarHeight - 100;
        const sectionBottom = sectionTop + section.offsetHeight;
        const sectionId = section.getAttribute('id');
        
        if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
            navLinks.forEach(link => {
                link.classList.remove('active');
                if (link.getAttribute('href') === '#' + sectionId) {
                    link.classList.add('active');
                }
            });
        }
    });
}

// ============================================
// Countdown Timer
// ============================================

function initCountdown() {
    const countdownElement = document.getElementById('countdown');
    
    if (!countdownElement) return;
    
    // Set campaign end date (7 days from now)
    const endDate = new Date();
    endDate.setDate(endDate.getDate() + 7);
    endDate.setHours(23, 59, 59, 999);
    
    function updateCountdown() {
        const now = new Date().getTime();
        const distance = endDate.getTime() - now;
        
        if (distance < 0) {
            countdownElement.innerHTML = 'Campaign Ended';
            return;
        }
        
        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        let countdownText = '';
        
        if (days > 0) {
            countdownText = `${days}d ${hours}h ${minutes}m`;
        } else if (hours > 0) {
            countdownText = `${hours}h ${minutes}m ${seconds}s`;
        } else {
            countdownText = `${minutes}m ${seconds}s`;
        }
        
        countdownElement.innerHTML = countdownText;
    }
    
    // Update immediately
    updateCountdown();
    
    // Update every second
    setInterval(updateCountdown, 1000);
}

// ============================================
// Copy Caption Function
// ============================================

function copyCaption() {
    const captionTextarea = document.getElementById('captionText');
    
    if (!captionTextarea) {
        showToast('Error', 'Caption text not found', 'error');
        return;
    }
    
    // Select the text
    captionTextarea.select();
    captionTextarea.setSelectionRange(0, 99999); // For mobile devices
    
    // Copy to clipboard
    try {
        // Modern approach
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(captionTextarea.value)
                .then(() => {
                    showToast('Success', 'Caption copied to clipboard!', 'success');
                })
                .catch(() => {
                    // Fallback
                    fallbackCopy(captionTextarea);
                });
        } else {
            // Fallback for older browsers or non-secure contexts
            fallbackCopy(captionTextarea);
        }
    } catch (err) {
        fallbackCopy(captionTextarea);
    }
}

function fallbackCopy(textarea) {
    try {
        document.execCommand('copy');
        showToast('Success', 'Caption copied to clipboard!', 'success');
    } catch (err) {
        showToast('Error', 'Failed to copy caption. Please copy manually.', 'error');
    }
}

// ============================================
// Toast Notification System
// ============================================

function showToast(title, message, type = 'success') {
    let toastElement;
    
    if (type === 'success') {
        toastElement = document.getElementById('successToast');
    } else if (type === 'error') {
        toastElement = document.getElementById('errorToast');
    } else {
        toastElement = document.getElementById('successToast');
    }
    
    if (!toastElement) {
        console.error('Toast element not found');
        return;
    }
    
    // Update toast content
    const toastBody = toastElement.querySelector('.toast-body');
    const toastTitle = toastElement.querySelector('.toast-header strong');
    
    if (toastBody) {
        toastBody.textContent = message;
    }
    
    if (toastTitle) {
        toastTitle.textContent = title;
    }
    
    // Show toast
    const toast = new bootstrap.Toast(toastElement, {
        autohide: true,
        delay: 3000
    });
    
    toast.show();
}

// ============================================
// Form Validation Helper
// ============================================

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(String(email).toLowerCase());
}

function validatePhone(phone) {
    // Bangladesh phone number validation (basic)
    const re = /^[\d\s\-\+\(\)]+$/;
    return re.test(phone) && phone.replace(/\D/g, '').length >= 10;
}

// ============================================
// Loading Button State
// ============================================

function setButtonLoading(button, isLoading, originalText = '') {
    if (isLoading) {
        button.dataset.originalText = button.innerHTML;
        button.disabled = true;
        button.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Loading...';
    } else {
        button.disabled = false;
        button.innerHTML = button.dataset.originalText || originalText;
    }
}

// ============================================
// Device Detection
// ============================================

function isMobile() {
    return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
}

function isIOS() {
    return /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
}

// ============================================
// Local Storage Helpers
// ============================================

function saveToLocalStorage(key, value) {
    try {
        localStorage.setItem(key, JSON.stringify(value));
        return true;
    } catch (e) {
        console.error('LocalStorage error:', e);
        return false;
    }
}

function getFromLocalStorage(key) {
    try {
        const item = localStorage.getItem(key);
        return item ? JSON.parse(item) : null;
    } catch (e) {
        console.error('LocalStorage error:', e);
        return null;
    }
}

function removeFromLocalStorage(key) {
    try {
        localStorage.removeItem(key);
        return true;
    } catch (e) {
        console.error('LocalStorage error:', e);
        return false;
    }
}

// ============================================
// URL Parameter Helpers
// ============================================

function getURLParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

function setURLParameter(name, value) {
    const url = new URL(window.location.href);
    url.searchParams.set(name, value);
    window.history.pushState({}, '', url);
}

// ============================================
// Debug Mode
// ============================================

const DEBUG_MODE = false; // Set to true for development

function debugLog(...args) {
    if (DEBUG_MODE) {
        console.log('[DEBUG]', ...args);
    }
}

// ============================================
// Initialize on Load
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    debugLog('App.js initialized');
    
    // Add any global initialization here
    
    // Example: Add smooth fade-in animation to cards
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        
        setTimeout(() => {
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});

// ============================================
// Export functions for use in other scripts
// ============================================

window.PrimeApp = {
    showToast,
    copyCaption,
    initCountdown,
    validateEmail,
    validatePhone,
    setButtonLoading,
    isMobile,
    isIOS,
    saveToLocalStorage,
    getFromLocalStorage,
    removeFromLocalStorage,
    getURLParameter,
    setURLParameter,
    debugLog
};
