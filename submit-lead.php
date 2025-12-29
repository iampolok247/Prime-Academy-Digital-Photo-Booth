<?php
/**
 * Prime Academy Digital Photo Booth
 * Lead Submission Handler
 * 
 * Accepts lead information from the photo booth form
 * Stores data in JSON format
 */

// Set headers
header('Content-Type: application/json');

// Enable error reporting for development (disable in production)
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

// CORS headers (if needed for AJAX requests from different domains)
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Only allow POST requests
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'ok' => false,
        'message' => 'Method not allowed. Use POST.'
    ]);
    exit;
}

// Get JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

// If JSON decode fails, try getting from POST data
if (json_last_error() !== JSON_ERROR_NONE) {
    $data = $_POST;
}

// Validate required fields
$required_fields = ['name', 'phone', 'course', 'consent'];
$errors = [];

foreach ($required_fields as $field) {
    if (empty($data[$field])) {
        $errors[] = ucfirst($field) . ' is required';
    }
}

if (!empty($errors)) {
    http_response_code(400);
    echo json_encode([
        'ok' => false,
        'message' => 'Validation failed: ' . implode(', ', $errors)
    ]);
    exit;
}

// Validate consent
if ($data['consent'] !== 'true' && $data['consent'] !== true && $data['consent'] !== '1') {
    http_response_code(400);
    echo json_encode([
        'ok' => false,
        'message' => 'You must agree to the campaign rules'
    ]);
    exit;
}

// Sanitize inputs
$name = htmlspecialchars(strip_tags(trim($data['name'])), ENT_QUOTES, 'UTF-8');
$phone = htmlspecialchars(strip_tags(trim($data['phone'])), ENT_QUOTES, 'UTF-8');
$course = htmlspecialchars(strip_tags(trim($data['course'])), ENT_QUOTES, 'UTF-8');

// Validate phone format (Bangladesh number)
if (!preg_match('/^[\d\s\-\+\(\)]+$/', $phone)) {
    http_response_code(400);
    echo json_encode([
        'ok' => false,
        'message' => 'Invalid phone number format'
    ]);
    exit;
}

// Validate name length
if (strlen($name) < 2 || strlen($name) > 100) {
    http_response_code(400);
    echo json_encode([
        'ok' => false,
        'message' => 'Name must be between 2 and 100 characters'
    ]);
    exit;
}

// Prepare lead data
$lead = [
    'name' => $name,
    'phone' => $phone,
    'course' => $course,
    'consent' => true,
    'created_at' => date('Y-m-d H:i:s'),
    'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
    'user_agent' => $_SERVER['HTTP_USER_AGENT'] ?? 'unknown'
];

// Define storage path
$storage_dir = __DIR__ . '/storage';
$storage_file = $storage_dir . '/leads.json';

// Create storage directory if it doesn't exist
if (!file_exists($storage_dir)) {
    if (!mkdir($storage_dir, 0755, true)) {
        http_response_code(500);
        echo json_encode([
            'ok' => false,
            'message' => 'Failed to create storage directory'
        ]);
        exit;
    }
}

// Create .htaccess in storage to prevent direct access
$htaccess_file = $storage_dir . '/.htaccess';
if (!file_exists($htaccess_file)) {
    $htaccess_content = "Order deny,allow\nDeny from all";
    file_put_contents($htaccess_file, $htaccess_content);
}

// Read existing leads
$leads = [];
if (file_exists($storage_file)) {
    $json_content = file_get_contents($storage_file);
    $leads = json_decode($json_content, true);
    
    // If decode fails, initialize empty array
    if (json_last_error() !== JSON_ERROR_NONE) {
        $leads = [];
    }
}

// Check for duplicate phone number (optional - comment out if allowing duplicates)
foreach ($leads as $existing_lead) {
    if (isset($existing_lead['phone']) && $existing_lead['phone'] === $phone) {
        // Allow duplicate but log it
        // You can uncomment below to prevent duplicates
        /*
        http_response_code(400);
        echo json_encode([
            'ok' => false,
            'message' => 'This phone number has already been registered'
        ]);
        exit;
        */
    }
}

// Add new lead
$leads[] = $lead;

// Save to file with proper locking
$json_data = json_encode($leads, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

if (file_put_contents($storage_file, $json_data, LOCK_EX) === false) {
    http_response_code(500);
    echo json_encode([
        'ok' => false,
        'message' => 'Failed to save lead data'
    ]);
    exit;
}

// Set proper permissions
@chmod($storage_file, 0644);

// Success response
http_response_code(200);
echo json_encode([
    'ok' => true,
    'message' => 'Your information has been saved successfully!',
    'data' => [
        'name' => $name,
        'course' => $course
    ]
]);

// Optional: Send email notification (uncomment and configure)
/*
$to = 'admin@primeacademy.com';
$subject = 'New Photo Booth Lead: ' . $name;
$message = "New lead captured:\n\n";
$message .= "Name: $name\n";
$message .= "Phone: $phone\n";
$message .= "Course Interest: $course\n";
$message .= "Time: " . $lead['created_at'] . "\n";

$headers = 'From: noreply@primeacademy.com' . "\r\n" .
           'Reply-To: noreply@primeacademy.com' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

@mail($to, $subject, $message, $headers);
*/

// Optional: Save to CSV as backup (uncomment if needed)
/*
$csv_file = $storage_dir . '/leads.csv';
$csv_exists = file_exists($csv_file);
$csv_handle = fopen($csv_file, 'a');

if ($csv_handle) {
    // Add header if file is new
    if (!$csv_exists || filesize($csv_file) == 0) {
        fputcsv($csv_handle, ['Name', 'Phone', 'Course', 'Created At', 'IP Address']);
    }
    
    fputcsv($csv_handle, [
        $lead['name'],
        $lead['phone'],
        $lead['course'],
        $lead['created_at'],
        $lead['ip_address']
    ]);
    
    fclose($csv_handle);
    @chmod($csv_file, 0644);
}
*/

?>
