================================================================================
PRIME ACADEMY DIGITAL PHOTO BOOTH
Installation & Deployment Guide for cPanel / Shared Hosting
================================================================================

PROJECT OVERVIEW
----------------
This is a complete web-based digital photo booth application built for Prime
Academy Bangladesh's community campaign. Users can take photos with a branded
frame overlay, save their information, and download the final image to post
on Facebook for rewards.

TECHNOLOGY STACK
----------------
- Backend: Pure PHP 7.4+ (no frameworks)
- Frontend: HTML5, CSS3, Bootstrap 5, Vanilla JavaScript
- Camera: HTML5 getUserMedia API
- Image Processing: HTML5 Canvas
- Data Storage: JSON file-based database
- Server: Apache with .htaccess


================================================================================
INSTALLATION INSTRUCTIONS
================================================================================

METHOD 1: cPanel File Manager
------------------------------
1. Log in to your cPanel account
2. Open "File Manager"
3. Navigate to public_html (or your domain's root directory)
4. Upload all files maintaining the folder structure:
   - index.php
   - photo-booth.php
   - submit-lead.php
   - .htaccess
   - assets/ (folder with all subfolders)
   - storage/ (empty folder, will auto-create if missing)

5. Set permissions:
   - Files: 644
   - Folders: 755
   - storage/ folder: 755 (writable)

6. Replace placeholder images:
   - Upload your logo.png to assets/img/
   - Upload your frame.png to assets/img/
   
   Frame requirements:
   - Transparent PNG format
   - Recommended size: 1200x1600 pixels (3:4 ratio)
   - Keep important content away from edges

METHOD 2: FTP Upload
--------------------
1. Use an FTP client (FileZilla, WinSCP, etc.)
2. Connect to your hosting server
3. Upload all files to public_html or domain root
4. Set correct permissions (same as Method 1)
5. Replace placeholder images


================================================================================
CONFIGURATION
================================================================================

1. SSL/HTTPS Setup (REQUIRED for camera access)
   ----------------------------------------------
   - Camera access requires HTTPS (except on localhost)
   - In cPanel, go to "SSL/TLS Status" and enable AutoSSL
   - Or install Let's Encrypt certificate (free)
   - Uncomment HTTPS redirect lines in .htaccess:
     
     RewriteCond %{HTTPS} off
     RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

2. PHP Settings
   ------------
   - Minimum PHP version: 7.4
   - Required extensions: json, fileinfo
   - Check in cPanel > "Select PHP Version"
   - Ensure these settings in .htaccess or php.ini:
     memory_limit = 128M
     upload_max_filesize = 10M
     post_max_size = 10M

3. Brand Customization
   -------------------
   - Logo: Replace assets/img/logo.png with your logo
   - Frame: Replace assets/img/frame.png with your branded frame
   - Colors: Edit assets/css/style.css (lines 10-14) if needed:
     --primary-color: #053867
     --secondary-color: #253985
     --accent-color: #F7BA23
     --accent2-color: #F3CE49

4. Campaign Settings
   -----------------
   - Countdown timer: Set in index.php or defaults to 7 days
   - Caption text: Edit in index.php and photo-booth.php
   - Rewards description: Edit in index.php
   - Course options: Edit in photo-booth.php (line ~95)

5. Email Notifications (Optional)
   ------------------------------
   - Uncomment email code in submit-lead.php (lines 148-159)
   - Configure SMTP settings in cPanel if needed
   - Update email addresses


================================================================================
FOLDER STRUCTURE
================================================================================

photobooth/
│
├── index.php                  # Landing page
├── photo-booth.php           # Main photo booth interface
├── submit-lead.php           # Backend API for lead submission
├── .htaccess                 # Apache configuration
├── README.txt                # This file
│
├── assets/
│   ├── css/
│   │   └── style.css         # Custom styles with Prime branding
│   │
│   ├── js/
│   │   ├── app.js           # Shared utilities & helpers
│   │   └── photo-booth.js   # Camera & image processing
│   │
│   └── img/
│       ├── logo.png          # YOUR LOGO HERE (placeholder)
│       └── frame.png         # YOUR FRAME HERE (placeholder)
│
└── storage/
    ├── leads.json            # Auto-created lead database
    └── .htaccess             # Auto-created protection


================================================================================
CREATING YOUR FRAME IMAGE
================================================================================

Frame Design Guidelines:
-----------------------
1. Software: Use Photoshop, Figma, or Canva
2. Canvas Size: 1200 x 1600 pixels (3:4 portrait ratio)
3. Format: PNG with transparent background
4. DPI: 72-150 (web optimized)

Design Tips:
-----------
- Keep center area clear for the photo
- Add branding at top and/or bottom
- Include Prime Academy logo
- Use campaign hashtag #PrimeFutureStartsHere
- Add decorative elements around edges
- Keep file size under 500KB for fast loading

Example Frame Layout:
--------------------
┌─────────────────────┐
│  [PRIME ACADEMY]    │  ← Top branding
│                     │
│                     │
│   [Photo Area]      │  ← Keep this transparent/clear
│                     │
│                     │
│  #PrimeFutureStarts │  ← Bottom text/hashtag
│        Here         │
└─────────────────────┘

Export Settings:
---------------
- Photoshop: File > Export > Export As > PNG, Transparency: ON
- Figma: Select frame > Export > PNG > Export
- Canva: Download > PNG with transparent background


================================================================================
TESTING CHECKLIST
================================================================================

Before Going Live:
-----------------
☐ Upload all files with correct permissions
☐ Replace placeholder logo.png and frame.png
☐ Enable HTTPS/SSL certificate
☐ Test on desktop browser (Chrome, Firefox, Safari)
☐ Test on mobile devices (iOS Safari, Android Chrome)
☐ Verify camera permissions dialog appears
☐ Capture test photo and verify frame overlay
☐ Submit test lead and check storage/leads.json
☐ Test download functionality
☐ Verify responsive design on all screen sizes
☐ Test all navigation links
☐ Check FAQ accordion functionality
☐ Test caption copy button
☐ Verify countdown timer displays correctly

Browser Compatibility:
---------------------
✓ Chrome 60+
✓ Firefox 55+
✓ Safari 11+
✓ Edge 79+
✓ iOS Safari 11+
✓ Chrome for Android 60+


================================================================================
TROUBLESHOOTING
================================================================================

Problem: Camera not working
---------------------------
Solution 1: Ensure site uses HTTPS (required for camera access)
Solution 2: Check browser permissions (Settings > Site Settings > Camera)
Solution 3: Try different browser (Chrome recommended)
Solution 4: Verify camera is not in use by another app

Problem: Permission denied error
--------------------------------
Solution: User must manually allow camera access in browser
          Show instruction to click "Allow" when prompted

Problem: Frame not appearing
----------------------------
Solution 1: Check frame.png exists in assets/img/
Solution 2: Verify PNG has transparent background
Solution 3: Check browser console for loading errors
Solution 4: Clear browser cache

Problem: Leads not saving
-------------------------
Solution 1: Check storage/ folder has write permissions (755)
Solution 2: Verify PHP has permission to create files
Solution 3: Check PHP error logs in cPanel
Solution 4: Ensure JSON extension is enabled

Problem: Download not working
------------------------------
Solution 1: Submit lead form first (required)
Solution 2: Check browser allows downloads
Solution 3: Try different browser
Solution 4: Verify capturedImageBlob exists

Problem: Page not loading
------------------------
Solution 1: Check .htaccess syntax
Solution 2: Verify PHP version 7.4+
Solution 3: Check file permissions (644 for files, 755 for folders)
Solution 4: Review error logs in cPanel


================================================================================
MAINTENANCE
================================================================================

View Submitted Leads:
--------------------
1. Log in to cPanel
2. File Manager > storage/leads.json
3. Download and open in text editor
4. Data format: JSON array of objects

Export Leads to Excel:
---------------------
- Optional: Uncomment CSV export code in submit-lead.php
- File will be saved as storage/leads.csv
- Download and open in Excel/Google Sheets

Backup Data:
-----------
- Regularly download storage/leads.json
- Keep backups of frame.png and logo.png
- Backup entire folder before major updates

Update Campaign Settings:
------------------------
- Edit countdown date in assets/js/app.js
- Modify rewards in index.php
- Update rules and FAQ as needed

Monitor Performance:
-------------------
- Check storage folder size
- Monitor leads.json file growth
- Review PHP error logs
- Test periodically on mobile devices


================================================================================
SECURITY BEST PRACTICES
================================================================================

1. File Permissions:
   - Files: 644 (read/write owner, read others)
   - Folders: 755 (read/write/execute owner, read/execute others)
   - Never use 777 permissions

2. Data Protection:
   - storage/ folder protected by .htaccess
   - No direct URL access to leads.json
   - Phone numbers and emails sanitized

3. Input Validation:
   - All user inputs sanitized in submit-lead.php
   - XSS protection enabled
   - SQL injection not applicable (no database)

4. HTTPS:
   - Always use SSL certificate
   - Force HTTPS redirect in .htaccess
   - Required for camera access

5. Privacy:
   - Photos not stored on server (user downloads locally)
   - Only lead info stored
   - Add privacy policy link in footer


================================================================================
ADVANCED CUSTOMIZATION
================================================================================

Add Image Storage (Optional):
-----------------------------
- Uncomment image storage code in photo-booth.js
- Create uploads/ folder with write permissions
- Update submit-lead.php to handle image uploads
- Consider storage space limits on shared hosting

Multiple Camera Support:
-----------------------
- Already implemented in photo-booth.js
- Switch button appears if multiple cameras detected
- Supports front/back camera on mobile

Analytics Integration:
---------------------
- Add Google Analytics code before </head> in both PHP files
- Track photo captures, downloads, lead submissions
- Monitor campaign performance

Email Automation:
----------------
- Uncomment email code in submit-lead.php
- Configure SMTP in cPanel
- Send confirmation emails to users
- Send admin notifications for new leads

Database Migration:
------------------
- For high traffic, consider MySQL database
- Create table: leads (id, name, phone, course, consent, created_at)
- Update submit-lead.php to use PDO/mysqli
- Benefits: better performance, query capabilities


================================================================================
SUPPORT & CONTACT
================================================================================

Technical Issues:
----------------
- Check hosting provider's PHP documentation
- Review cPanel video tutorials
- Contact hosting support for server issues

Project Customization:
---------------------
- Hire a developer familiar with PHP/JavaScript
- Provide this README for context
- Test thoroughly after any changes

Browser Issues:
--------------
- Test on latest browser versions
- Use Chrome/Firefox developer tools for debugging
- Check browser console for JavaScript errors


================================================================================
VERSION HISTORY
================================================================================

Version 1.0 (2025-01-29)
-----------------------
- Initial release
- Core photo booth functionality
- Lead form and JSON storage
- Mobile-responsive design
- Bootstrap 5 integration
- Prime Academy branding


================================================================================
LICENSE & CREDITS
================================================================================

This application is built for Prime Academy Bangladesh.
All rights reserved © 2025 Prime Academy Bangladesh

Technologies Used:
- Bootstrap 5 (MIT License)
- Bootstrap Icons (MIT License)
- Google Fonts - Poppins (Open Font License)

================================================================================
END OF README
================================================================================
