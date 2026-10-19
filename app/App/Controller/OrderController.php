<?php
declare(strict_types=1);

require_once 'App/Core/BaseController.php';
require_once 'App/Model/ArticleModel.php';
require_once 'App/Model/OrderingModel.php';


class OrderController extends BaseController
{

    public function processData(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $address = trim($_POST['adresse'] ?? '');
        $cart = $_POST['warenkorb'] ?? [];

        if ($address === '' || empty($cart)) {
            return;
        }

        $orderingModel = new OrderingModel();
        $orderingId = $orderingModel->createOrdering($address);

        foreach ($cart as $articleId) {
            $orderingModel->createOrderedArticle($orderingId, (int) $articleId);
        }
        $_SESSION['last_ordering_id'] = $orderingId; #Hiermit werden nach dem Input der Bestellung die Daten der Bestellung in der Session gespeichert, damit wir sie später in der Bestellübersicht anzeigen können.
        header('Location: ' . Router::generateUrl('customer'));
        exit;
    }
    #Nachdem die Bestellung in der Datenbank angelegt wurde (createOrdering() liefert die neue ordering_id als $orderingId zurück), wird genau diese ID in $_SESSION['last_ordering_id'] geschrieben. 
    #Das passiert nur für den Browser, der gerade bestellt hat – seine Session-Datei auf dem Server bekommt diesen Eintrag, kein anderer Browser (= kein anderer Kunde) hat Zugriff auf diese Datei.


    private function getData(): array
    {
        $articleModel = new ArticleModel();

        return [
            'articles' => $articleModel->getAllArticles()
        ];
    }

    public function generateResponse(): void
    {
        $data = $this->getData();
        $this->renderHtml('App/View/order.view.php', ['data' => $data]);
    }

    public function handleRequest(): void
    {
        $this->processData();
        $this->generateResponse();
    }
}