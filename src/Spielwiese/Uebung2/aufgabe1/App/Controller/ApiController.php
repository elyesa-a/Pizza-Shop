<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';
require_once 'App/Core/Router.php';
require_once 'App/Model/ItemModel.php';

class ApiController extends BaseController {
    /**
     * Process incoming HTTP request data (GET, POST, etc.).
     *
     * @return void
     */
    public function processData(): void {
        $router = new Router();
        $route = $router->getRoute();
        $resource = $route['resource'];
        $id = $route['parameter'];

        if ($resource === 'items') {
            $model = new ItemModel();
        } else {
            http_response_code(404); // Not Found
            return;
        }

        // JSON auslesen
        $json = file_get_contents('php://input');
        $jsonData = json_decode($json, true) ?? [];
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // --- Item erstellen ---
            if (!empty($jsonData['name'])) {
                $model->create($jsonData['name']);
                http_response_code(201); // Created
            } else {
                http_response_code(400); // Bad Request
            }
        } else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
            // --- Item aktualisieren ---
            if ($id !== null && !empty($jsonData['name'])) {
                $success = $model->update((int)$id, $jsonData['name']);
                if ($success) {
                    http_response_code(200); // OK
                } else {
                    http_response_code(404); // Not Found
                }
            } else {
                http_response_code(400); // Bad Request
            }
        } else if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
            // --- Item löschen ---
            if ($id !== null) {
                $success = $model->delete((int)$id);
                if ($success) {
                    http_response_code(200); // OK
                } else {
                    http_response_code(404); // Not Found
                }
            } else {
                http_response_code(400); // Bad Request
            }
        } else {
            http_response_code(405); // Method Not Allowed
        }
    }

    /**
     * Retrieve data for the response.
     * Returns all items or one item as an array.
     *
     * @return array Data array (assoziativ oder indexiert)
     */
    private function getData(): array {
        $data = [];
        $router = new Router();
        $route = $router->getRoute();
        $resource = $route['resource'];
        $id = $route['parameter'];

        if ($resource === 'items') {
            $model = new ItemModel();
        } else {
            http_response_code(404); // Not Found
            return $data;
        }

        if ($id !== null) {
            $item = $model->getById((int)$id);
            if ($item) {
                $data[] = $item;
            } else {
                http_response_code(404); // Not Found
            }
        } else {
            $data = $model->getAll();
        }
        return $data;
    }

    /**
     * Generate the full response output.
     * This method may output HTML, JSON, or other formats as needed.
     *
     * @return void
     */
    public function generateResponse(): void {
        $data = $this->getData();
        $this->renderJson($data);
    }

    /**
     * Handles the full request lifecycle
     *
     * @return void
     */
    public function handleRequest(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            $this->processData();
        } else {
            $this->generateResponse();
        }
    }
}
