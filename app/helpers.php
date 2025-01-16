<?php
function base_url($path = '') {

    if(defined('BASE_URL')) {
        return BASE_URL . ltrim($path, '/');
    }
    // https:// or http://
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' )|| $_SERVER['SERVER_PORT'] == 443 ? "https://" : "http://";

    // edwindiaz.com/
    $host = $_SERVER['HTTP_HOST'];

    // /blog
    $base =  rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

    return $protocol . $host . $base . '/' . ltrim($path, '/');
}

function base_path($path = '') {
    return realpath(__DIR__ . '/../' . '/' . ltrim($path, '/'));
}

function views_path($path = '') {
    return base_path('app/views' . '/' . ltrim($path, '/'));
}   


function redirect($path = '', $queryParams = []){
    $url = base_url($path);
    if(!empty($queryParams)){
        $url .= "?" . http_build_query($queryParams); 
    }
    header("Location: " . $url);
    exit();
}

function getCurrentRoute() {
    // Parse the current URL
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    // Trim leading and trailing slashes, and return the first part of the URL
    $segments = explode('/', trim($uri, '/'));
    return $segments[0]; // return the first segment (page name)
}

function render($view, $data = [], $layout = 'layout'){

    extract($data);

    ob_start();

    require views_path($view . '.php');

    $content = ob_get_clean();

    require views_path($layout . ".php");
}
function isLoggedIn() {
    return isset($_SESSION['user']) && !empty($_SESSION['user']);
}
function config($key){
    $config = require base_path('config/config.php');
    $keys= explode('.', $key);
    $value = $config;
    foreach($keys as $key){
        if(!isset($value[$key])){
            throw new Exception("Key $key not found in config file");
        }
        $value = $value[$key];
    }
    return $value;
}

function uploadFile($file) {
// Define allowed file types and max file size
    $allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
    $maxFileSize = 5 * 1024 * 1024; // 5 MB

    // Check if the file is valid
    if ($file['error'] === UPLOAD_ERR_OK) {
        $fileType = $file['type'];
        $fileSize = $file['size'];

        if (!in_array($fileType, $allowedTypes)) {
            echo 'Invalid file type.';
            return null;
        }
        if ($fileSize > $maxFileSize) {
            echo 'File size exceeds the limit.';
            return null;
        }

        // Generate unique file name and move the uploaded file
        $fileName = uniqid('event_', true) . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $uploadDir = 'uploads/images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $filePath = $uploadDir . $fileName;
        move_uploaded_file($file['tmp_name'], $filePath);

        return $filePath;
    }

    return null;
}
?>