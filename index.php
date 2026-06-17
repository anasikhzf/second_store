<?php
// index.php

// Prevent raw PHP errors from being displayed
ini_set('display_errors', '0');
error_reporting(0);

// Global Exception Handler
set_exception_handler(function ($exception) {
    http_response_code(500);
    $title = "Terjadi Kesalahan Sistem - Second Store";
    if (file_exists('app/views/error.php')) {
        include 'app/views/error.php';
    } else {
        echo "<h1>Terjadi Kesalahan Internal</h1><p>Mohon maaf, sistem sedang mengalami gangguan. Silakan hubungi admin atau coba lagi nanti.</p>";
    }
    exit();
});

// Convert errors to exceptions
set_error_handler(function ($severity, $message, $file, $line) {
    if (!(error_reporting() & $severity)) {
        return;
    }
    throw new ErrorException($message, 0, $severity, $file, $line);
});

// Load Configuration and Core Framework files
require_once 'config/config.php';
require_once 'app/core/Database.php';
require_once 'app/core/App.php';

// Register public routes
App::get('/', 'HomeController@index');

App::get('/product', 'ProductController@index');
App::get('/product/{id}', 'ProductController@detail');

App::get('/blog', 'BlogController@index');
App::get('/blog/{id}', 'BlogController@detail');

App::get('/about', 'AboutController@index');
App::get('/contact', 'ContactController@index');

App::get('/cart', 'CartController@index');
App::post('/cart/add', 'CartController@add');
App::get('/cart/remove/{id}', 'CartController@remove');
App::get('/cart/checkout', 'CartController@checkout');

// Register Admin routes
App::get('/admin', 'AdminController@dashboard');
App::get('/admin/login', 'AdminController@login');
App::post('/admin/login', 'AdminController@login');
App::get('/admin/logout', 'AdminController@logout');

App::get('/admin/products', 'AdminController@products');
App::post('/admin/products', 'AdminController@products');
App::post('/admin/products/delete', 'AdminController@deleteProduct');

App::get('/admin/categories', 'AdminController@categories');
App::post('/admin/categories', 'AdminController@categories');
App::post('/admin/categories/delete', 'AdminController@deleteCategory');

App::get('/admin/blogs', 'AdminController@blogs');
App::post('/admin/blogs', 'AdminController@blogs');
App::post('/admin/blogs/delete', 'AdminController@deleteBlog');

// Run application
$app = new App();
$app->run();
