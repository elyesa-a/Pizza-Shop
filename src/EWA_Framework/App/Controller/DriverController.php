<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';

class DriverController extends BaseController {

    // 1. Hier verarbeitest du später die Formulardaten (POST)
    public function processData(): void {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Wenn das Formular abgeschickt wurde, landen die Daten hier
            // z.B. $status = $_POST['status'] ?? null;
        }
    }

    // 2. Hier werden die Daten bereitgestellt (später über ein Model aus der DB)
    private function getData(): array {
        return [
            [
                'id' => 1,
                'name' => 'Bestellung 1',
                'adresse' => 'Musterstraße 12, 64289 Darmstadt',
                'pizzen' => 'Salami, Margherita',
                'preis' => '18,50 €'
            ],
            [
                'id' => 2,
                'name' => 'Bestellung 2',
                'adresse' => 'Beispielweg 5, 64295 Darmstadt',
                'pizzen' => 'Tonno',
                'preis' => '9,00 €'
            ]
        ];
    }

    // 3. Hier wird die View geladen und die Daten übergeben
    public function generateResponse(): void {
        $orders = $this->getData();
        
        // WICHTIG: Wir nennen den Key 'orders', damit in der View $orders existiert!
        $this->renderHtml('App/View/driver.view.php', [
            'orders' => $orders
        ]);
    }

    // Die Steuerungszentrale des Controllers
    public function handleRequest(): void {
        $this->processData();
        $this->generateResponse();
    }
}