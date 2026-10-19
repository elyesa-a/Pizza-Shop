<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';
require_once 'App/Model/OrderingModel.php';

class DriverController extends BaseController {

    public function processData(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $orderingModel = new OrderingModel();

        foreach ($_POST['status'] ?? [] as $orderingId => $status) {
            $orderingId = (int)$orderingId;
            $status = (int)$status;

            if ($status === 4) {
                // Bestellung ausgeliefert -> komplette Bestellung loeschen
                $orderingModel->deleteOrder($orderingId);
            } else {
                $orderingModel->updateOrderStatus($orderingId, $status);
            }
        }

        header('Location: ' . Router::generateUrl('driver'));
        exit;
    }

    private function getData(): array {
        $orderingModel = new OrderingModel();

        return [
            'orders' => $orderingModel->getOrdersForDriver()
        ];
    }

    public function generateResponse(): void {
        $data = $this->getData();

        $this->renderHtml('App/View/driver.view.php', [
            'data' => $data,
            'pageTitle' => 'Pizzafahrer'
        ]);
    }

    public function handleRequest(): void {
        $this->processData();
        $this->generateResponse();
    }
}