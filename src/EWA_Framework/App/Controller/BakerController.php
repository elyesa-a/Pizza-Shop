<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';

class BakerController extends BaseController {

    public function processData(): void {
    }

    private function getData(): array {
        return [];
    }

    public function generateResponse(): void {
        $data = $this->getData();
        $this->renderHtml('App/View/baker.view.php', ['data' => $data]);
    }

    public function handleRequest(): void {
        $this->processData();
        $this->generateResponse();
    }
}