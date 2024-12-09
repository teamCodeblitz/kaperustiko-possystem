<?php
header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Determine the correct path to the root directory
$rootPath = dirname(__DIR__);

// Check if vendor/autoload.php exists
if (!file_exists($rootPath . '/vendor/autoload.php')) {
    die(json_encode(['error' => 'Vendor autoload.php not found. Did you run composer install?']));
}

require $rootPath . '/vendor/autoload.php';

// Check if .env file exists and load it
if (file_exists($rootPath . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable($rootPath);
    try {
        $dotenv->load();
    } catch (Exception $e) {
        die(json_encode(['error' => 'Error loading .env file: ' . $e->getMessage()]));
    }
} else {
    die(json_encode(['error' => '.env file not found in: ' . $rootPath]));
}

// Get database credentials
$servername = $_ENV['DB_SERVERNAME'] ?? null;
$username = $_ENV['DB_USERNAME'] ?? null;
$password = $_ENV['DB_PASSWORD'] ?? null;
$dbname = $_ENV['DB_DATABASE'] ?? null;

// Verify all required environment variables are set
if (!$servername || !$username || !$dbname) {
    $missing = [];
    if (!$servername) $missing[] = 'DB_SERVERNAME';
    if (!$username) $missing[] = 'DB_USERNAME';
    if (!$dbname) $missing[] = 'DB_DATABASE';
    
    die(json_encode([
        'error' => 'Missing required environment variables: ' . implode(', ', $missing),
        'debug' => [
            'root_path' => $rootPath,
            'env_file_exists' => file_exists($rootPath . '/.env'),
        ]
    ]));
}

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

// Database connection with error handling
try {
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    echo json_encode([
        'error' => $e->getMessage(),
        'debug' => [
            'servername' => $servername,
            'username' => $username,
            'database' => $dbname
        ]
    ]);
    exit;
}
