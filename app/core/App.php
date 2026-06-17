<?php

class App {
    private static $routes = [];

    // Register GET routes
    public static function get($route, $controllerMethod) {
        self::$routes['GET'][$route] = $controllerMethod;
    }

    // Register POST routes
    public static function post($route, $controllerMethod) {
        self::$routes['POST'][$route] = $controllerMethod;
    }

    public function run() {
        // Start session if not started
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $url = $this->parseUrl();
        $method = $_SERVER['REQUEST_METHOD'];

        // Find match
        $match = $this->matchRoute($method, $url);

        if ($match) {
            $controllerMethod = $match['handler'];
            $params = $match['params'];

            list($controllerName, $action) = explode('@', $controllerMethod);

            $controllerFile = 'app/controllers/' . $controllerName . '.php';
            if (file_exists($controllerFile)) {
                require_once $controllerFile;
                $controller = new $controllerName();

                if (method_exists($controller, $action)) {
                    call_user_func_array([$controller, $action], $params);
                    return;
                }
            }
        }

        // Default 404
        header("HTTP/1.0 404 Not Found");
        echo "404 Not Found";
    }

    private function parseUrl() {
        $url = $_GET['url'] ?? '';
        $url = filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL);
        return '/' . $url;
    }

    private function matchRoute($method, $url) {
        if (!isset(self::$routes[$method])) {
            return null;
        }

        // Direct match
        if (isset(self::$routes[$method][$url])) {
            return [
                'handler' => self::$routes[$method][$url],
                'params' => []
            ];
        }

        // Dynamic match (e.g. /product/{id} or /admin/product/delete/{id})
        foreach (self::$routes[$method] as $route => $handler) {
            // Convert {param} to regex capture group
            $pattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9_-]+)', $route);
            $pattern = '@^' . $pattern . '$@';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches); // remove first match (full string)
                return [
                    'handler' => $handler,
                    'params' => $matches
                ];
            }
        }

        return null;
    }
}
