<?php
declare(strict_types=1);
session_start(); // Damit beginnt die Session bei jedem Request automatisch und
                 // wir müssen das nicht in jedem Controller einzeln machen.

require_once 'App/Core/Router.php';

// Routing light:
// .htaccess rewrites "/something" to "index.php?url=something"
$router = new Router();

try {
    switch ($router->getRoute()) {
        case '':
        case 'order':
            require_once 'App/Controller/OrderController.php';
            $controller = new OrderController();
            break;
        case 'customer':
            require_once 'App/Controller/CustomerController.php';
            $controller = new CustomerController();
            break;

        case 'baker':
            require_once 'App/Controller/BakerController.php';
            $controller = new BakerController();
            break;

        case 'driver':
            require_once 'App/Controller/DriverController.php';
            $controller = new DriverController();
            break;
        case 'api':
            require_once 'App/Controller/ApiController.php';
            $controller = new ApiController();
            break;
        default:
            http_response_code(404);
            echo '<h1>404 - Page not found</h1>';
            exit;
    }

    if (!isset($controller)) {
        http_response_code(404);
        throw new Exception('No controller selected for this route.');
    }

    $controller->handleRequest();
} catch (Exception $e) {
    header('Content-type: text/html; charset=UTF-8');
    echo '<h1>Unexpected error occurred</h1>';
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}
