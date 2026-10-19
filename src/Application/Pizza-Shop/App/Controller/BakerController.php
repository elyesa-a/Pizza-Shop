<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';
require_once 'App/Model/OrderingModel.php';

class BakerController extends BaseController {

    public function processData(): void {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $orderingModel = new OrderingModel();

        foreach ($_POST['status'] ?? [] as $orderedArticleId => $status) {
            $orderingModel->updateOrderedArticleStatus(
                (int)$orderedArticleId,
                (int)$status
            );
        }

        header('Location: ' . Router::generateUrl('baker'));
        exit;
    }

    private function getData(): array {
        $orderingModel = new OrderingModel();

        return [
            'pizzas' => $orderingModel->getPizzasForBaker()
        ];
    }

    public function generateResponse(): void {
        $data = $this->getData();

        $this->renderHtml('App/View/baker.view.php', [
            'data' => $data,
            'pageTitle' => 'Pizzabäcker'
        ]);
    }

    public function handleRequest(): void {
        $this->processData();
        $this->generateResponse();
    }
}