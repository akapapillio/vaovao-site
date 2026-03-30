<?php
require_once ROOT_PATH . "/app/repositories/DatabaseRepository.php";

class ArticleRepository extends DatabaseRepository {

    public function getAllArticles($limit = null, $offset = 0) {
        $sql = "SELECT id, title, content, created_at FROM articles ORDER BY created_at DESC";
        if ($limit) {
            $limit = (int)$limit;
            $offset = (int)$offset;
            $sql .= " LIMIT $limit OFFSET $offset";
        }
        return $this->fetchAll($sql);
    }

    public function getArticleById($id) {
        return $this->fetch(
            "SELECT id, title, content, created_at FROM articles WHERE id = ?",
            [$id]
        );
    }

    public function createArticle($title, $content) {
        return $this->execute(
            "INSERT INTO articles(title, content) VALUES (?, ?)",
            [$title, $content]
        );
    }

    public function updateArticle($id, $title, $content) {
        return $this->execute(
            "UPDATE articles SET title = ?, content = ? WHERE id = ?",
            [$title, $content, $id]
        );
    }

    public function deleteArticle($id) {
        return $this->execute("DELETE FROM articles WHERE id = ?", [$id]);
    }

    public function countArticles() {
        $result = $this->fetch("SELECT COUNT(*) as total FROM articles");
        return $result['total'] ?? 0;
    }
}
