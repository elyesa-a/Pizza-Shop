<?php
declare(strict_types=1);

require_once 'App/Core/BaseModel.php';

class ArticleModel extends BaseModel {

    public function getAllArticles(): array {

        $sql = "SELECT * FROM article";

        $result = $this->db->query($sql);

        if (!$result) {
            throw new Exception($this->db->error);
        }

        $articles = [];

        while ($row = $result->fetch_assoc()) {
            $articles[] = $row;
        }

        return $articles;
    }
}