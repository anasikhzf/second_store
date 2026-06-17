<?php
// app/config/config.php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'second_store');

// Base URL definition
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost';
$scriptName = dirname($_SERVER['SCRIPT_NAME'] ?? '');
$baseUrl = $protocol . '://' . $host . rtrim($scriptName, '/\\') . '/';

define('BASE_URL', $baseUrl);
