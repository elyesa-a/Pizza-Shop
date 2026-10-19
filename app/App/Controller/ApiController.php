<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';
require_once 'App/Model/OrderingModel.php';

class ApiController extends BaseController {

    public function processData(): void {
        // API verarbeitet erstmal keine POST-Daten
    }

    private function getData(): array {
        if (!isset($_SESSION['last_ordering_id'])) {
            return [
                'orders' => []
            ];
        }

        $orderingModel = new OrderingModel();

        return [
            'orders' => $orderingModel->getOrderById((int)$_SESSION['last_ordering_id'])
        ];
    }

    public function generateResponse(): void {
        $data = $this->getData();
        $this->renderJson($data);
    }

    public function handleRequest(): void {
        $this->processData();
        $this->generateResponse();
    }
}