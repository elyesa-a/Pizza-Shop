<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';
require_once 'App/Model/OrderingModel.php';

class CustomerController extends BaseController {

    public function processData(): void {
        // Für Customer erstmal nichts zu verarbeiten
    }

    private function getData(): array {
        $orderingModel = new OrderingModel();
$id = $_SESSION['last_ordering_id'] ?? null; #Hiermit wird die ID der letzten Bestellung aus der Session ausgelesen, damit wir sie später in der Bestellübersicht anzeigen können.
$pizzas = $id ? $orderingModel->getOrderingDetails($id) : [];
        return [
            'pizzas' => $pizzas #getallorders() wurde gelöscht, damit der Kunde nur noch seine eigenen Bestellungen sieht
        ];
    }
    #Wenn der Kunde jetzt die Kundenstatus-Seite aufruft, wird aus seiner eigenen Session ($_SESSION['last_ordering_id']) die zuvor gespeicherte ID gelesen. 
    #Diese ID wird dann an getOrderingDetails($id) übergeben, welches per Prepared Statement (OrderingModel.php:105, WHERE o.ordering_id = ?) nur die Zeilen dieser einen Bestellung aus der Datenbank holt. 
    #Der ?? null-Fallback sorgt dafür, dass jemand, der noch nie bestellt hat (dessen Session also keinen last_ordering_id-Eintrag hat), sauber ein leeres Array bekommt statt eines Fehlers.

    public function generateResponse(): void {
       
        $data = $this->getData();

$this->renderHtml('App/View/customer.view.php', [
            'data' => $data,
            'pageTitle' => 'Kunden-Status'
        ]);
    }

    public function handleRequest(): void {
        $this->processData();
        $this->generateResponse();
    }
}