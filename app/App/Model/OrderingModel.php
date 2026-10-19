<?php
declare(strict_types=1);

require_once 'App/Core/BaseModel.php';

class OrderingModel extends BaseModel {

    public function createOrdering(string $address): int { 
        // Prepared Statement: SQL-Struktur wird mit Platzhaltern (?) definiert,
    // OHNE dass die Nutzereingabe ($address) direkt in den SQL-String eingefügt wird.
    // -> verhindert SQL-Injection, da $address später getrennt von der Query übertragen wird.
        $stmt = $this->db->prepare(
            "INSERT INTO ordering (address, ordering_time) VALUES (?, NOW())" #Platzhalter für die Adresse, damit wir Prepared Statements verwenden können und so SQL Injections verhindern können.
        );

    // prepare() gibt false zurück, wenn z.B. Syntaxfehler in der Query sind.
        if (!$stmt) {
            throw new Exception($this->db->error);
        }
    // bind_param() bindet $address an den Platzhalter (?).
    // "s" gibt den Typ an (string). Die Datenbank behandelt $address
    // ab hier ausschließlich als reinen Datenwert, nicht als SQL-Code.
    // Selbst wenn $address Zeichen wie ' oder -- enthält, werden diese
    // nicht als SQL-Syntax interpretiert.
       $stmt->bind_param("s", $address); 
       // Führt die Query mit dem gebundenen Wert aus.
        $stmt->execute(); 

    // insert_id liefert die ID des soeben eingefügten Datensatzes
    // (Primärschlüssel der neuen Bestellung, z.B. ordering_id).
        return $this->db->insert_id;

    }

    public function createOrderedArticle(int $orderingId, int $articleId, int $status = 0): void {
        $stmt = $this->db->prepare(
            "INSERT INTO ordered_article (ordering_id, article_id, status) VALUES (?, ?, ?)"
        );

        if (!$stmt) {
            throw new Exception($this->db->error);
        }

        $stmt->bind_param("iii", $orderingId, $articleId, $status);
        $stmt->execute();
    }
    public function getAllOrders(): array {
    $sql = "
        SELECT 
            o.ordering_id,
            o.address,
            o.ordering_time,
            a.name,
            a.price,
            oa.status
        FROM ordering o
        JOIN ordered_article oa ON o.ordering_id = oa.ordering_id
        JOIN article a ON oa.article_id = a.article_id
        ORDER BY o.ordering_id DESC
    ";

    $result = $this->db->query($sql);

    if (!$result) {
        throw new Exception($this->db->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}
    public function getPizzasForBaker(): array {
    $sql = "
        SELECT 
            oa.ordered_article_id,
            o.ordering_id,
            a.name,
            oa.status
        FROM ordered_article oa
        JOIN article a ON oa.article_id = a.article_id
        JOIN ordering o ON oa.ordering_id = o.ordering_id
        WHERE oa.status IN (0, 1)
        ORDER BY o.ordering_id ASC
    ";

    $result = $this->db->query($sql);

    if (!$result) {
        throw new Exception($this->db->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}
public function getOrderingDetails(int $orderingId): array {
    $sql = "
        SELECT 
            o.ordering_id,
            o.address,
            o.ordering_time,
            a.name,
            a.price,
            oa.status
        FROM ordering o
        JOIN ordered_article oa ON o.ordering_id = oa.ordering_id
        JOIN article a           ON oa.article_id = a.article_id
        WHERE o.ordering_id = ?
    ";

    $stmt = $this->db->prepare($sql);
    if (!$stmt) {
        throw new Exception($this->db->error);
    }

    $stmt->bind_param('i', $orderingId);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}
public function updateOrderedArticleStatus(int $orderedArticleId, int $status): void {
    $stmt = $this->db->prepare(
        "UPDATE ordered_article SET status = ? WHERE ordered_article_id = ?"
    );

    if (!$stmt) {
        throw new Exception($this->db->error);
    }

    $stmt->bind_param("ii", $status, $orderedArticleId);
    $stmt->execute();
}
public function getOrdersForDriver(): array {
    // Eine Zeile pro Bestellung: Lieferadresse und Gesamtpreis (Summe aller
    // auslieferbaren Artikel). MIN(status) liefert den Sammelstatus der Bestellung.
    $sql = "
        SELECT
            o.ordering_id,
            o.address,
            SUM(a.price)  AS total_price,
            MIN(oa.status) AS status
        FROM ordered_article oa
        JOIN article a   ON oa.article_id = a.article_id
        JOIN ordering o  ON oa.ordering_id = o.ordering_id
        WHERE oa.status IN (2, 3)
        GROUP BY o.ordering_id, o.address
        ORDER BY o.ordering_id ASC
    ";

    $result = $this->db->query($sql);

    if (!$result) {
        throw new Exception($this->db->error);
    }

    return $result->fetch_all(MYSQLI_ASSOC);
}

public function updateOrderStatus(int $orderingId, int $status): void {
    // Setzt den Status aller auslieferbaren Artikel einer Bestellung gemeinsam.
    $stmt = $this->db->prepare(
        "UPDATE ordered_article SET status = ? WHERE ordering_id = ? AND status IN (2, 3)"
    );

    if (!$stmt) {
        throw new Exception($this->db->error);
    }

    $stmt->bind_param("ii", $status, $orderingId);
    $stmt->execute();
}

public function deleteOrder(int $orderingId): void {
    // Löscht die ganze Bestellung. Die zugehörigen ordered_article-Zeilen
    // werden per ON DELETE CASCADE (Fremdschlüssel) automatisch entfernt.
    $stmt = $this->db->prepare(
        "DELETE FROM ordering WHERE ordering_id = ?"
    );

    if (!$stmt) {
        throw new Exception($this->db->error);
    }

    $stmt->bind_param("i", $orderingId);
    $stmt->execute();
}
public function getOrderById(int $orderingId): array {
    $stmt = $this->db->prepare("
        SELECT 
            o.ordering_id,
            o.address,
            o.ordering_time,
            a.name,
            a.price,
            oa.status
        FROM ordering o
        JOIN ordered_article oa ON o.ordering_id = oa.ordering_id
        JOIN article a ON oa.article_id = a.article_id
        WHERE o.ordering_id = ?
        ORDER BY oa.ordered_article_id ASC
    ");

    if (!$stmt) {
        throw new Exception($this->db->error);
    }

    $stmt->bind_param("i", $orderingId);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}
}