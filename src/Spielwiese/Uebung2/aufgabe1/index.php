<?php
declare(strict_types=1);

require_once 'App/Core/Router.php';
require_once 'App/Core/DebugHelper.php';

// Routing light:
// .htaccess rewrites "/something" to "index.php?url=something"
$router = new Router();
$route = $router->getRoute();

switch ($route['base']) {
    case '':
    case 'index':
        require_once 'App/Controller/IndexController.php';
        $controller = new IndexController();
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

try {
    $controller->handleRequest();
} catch (Exception $e) {
    header("Content-type: text/html; charset=UTF-8");
    echo "<h1>Unexpected error occurred</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}
