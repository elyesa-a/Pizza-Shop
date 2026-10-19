<?php
declare(strict_types=1);

class Router {
    /**
     * Returns the current route split into base, resource and parameter.
     * Example: "/index" -> ["base" => "index", "resource" => null, "parameter" => null]
     * Example: "/api/items/5" -> ["base" => "api", "resource" => "items", "parameter" => "5"]
     */
    public function getRoute(): array {
        $route = trim((string)($_GET['url'] ?? ''), '/');
        $routeParts = explode('/', $route);

        return [
            'base' => $routeParts[0] ?? '',
            'resource' => $routeParts[1] ?? null,
            'parameter' => $routeParts[2] ?? null
        ];
    }

    /**
     * Creates a clean URL inside this project.
     * Example: Router::generateUrl('index') -> ".../index"
     */
    public static function generateUrl(string $path = ''): string {
        $base = rtrim(dirname((string)$_SERVER['SCRIPT_NAME']), '/');
        $path = ltrim($path, '/');
        
        return $path === '' ? $base . '/' : $base . '/' . $path;
    }
}
