<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';

class OrderController extends BaseController {

    public function processData(): void {
        // Später: Formular-Daten verarbeiten
    }

    private function getData(): array {
        // Später: Pizzen aus Datenbank holen
        return [];
    }

    public function generateResponse(): void {
        $data = $this->getData();
        $this->renderHtml('App/View/order.view.php', ['data' => $data]);
    }

    public function handleRequest(): void {
        $this->processData();
        $this->generateResponse();
    }
}