<?php

class Controller {
    // Render a view with optional data
    protected function view($viewName, $data = []) {
        // Extract variables to be accessible in the view
        extract($data);

        $viewFile = 'app/views/' . $viewName . '.php';

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("View '$viewName' not found.");
        }
    }

    // Load a model
    protected function model($modelName) {
        $modelFile = 'app/models/' . $modelName . '.php';
        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $modelName();
        } else {
            die("Model '$modelName' not found.");
        }
    }

    // Redirect to another URL
    protected function redirect($url) {
        header("Location: " . BASE_URL . ltrim($url, '/'));
        exit;
    }

    // Return JSON response
    protected function json($data, $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }
}
