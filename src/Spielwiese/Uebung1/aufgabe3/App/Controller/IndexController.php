<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';
require_once 'App/Model/ItemModel.php';

class IndexController extends BaseController {
    /**
     * Process incoming HTTP request data (GET, POST, etc.).
     *
     * @return void
     */
    public function processData(): void {

    }

    /**
     * Retrieve all data necessary for the response.
     *
     * @return array Data array (assoziativ oder indexiert)
     */
    private function getData(): array {
       
    }

    /**
     * Generate the full response output.
     * This method may output HTML, JSON, or other formats as needed.
     *
     * @return void
     */
    public function generateResponse(): void {
        
    }

    /**
     * Handles the full request lifecycle
     *
     * @return void
     */
    public function handleRequest(): void {
       
    }
}

/*
Code-Snippets
1. ----
$data = [];
$model = new ItemModel();
$data = $model->getAll();
return $data;
2. ----
$this->generateResponse();
3. ----
$data = $this->getData();
$this->renderHtml('App/View/index.view.php', ['data' => $data]);
*/