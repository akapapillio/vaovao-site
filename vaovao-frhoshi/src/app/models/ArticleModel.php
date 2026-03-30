<?php
require_once ROOT_PATH . "/app/repositories/ArticleRepository.php";

class ArticleModel {

    private $repo;

    public function __construct() {
        $this->repo = new ArticleRepository();
    }

    public function getAllArticles($limit = null, $offset = 0) {
        return $this->repo->getAllArticles($limit, $offset);
    }

    public function getArticleById($id) {
        if (!is_numeric($id) || $id <= 0) {
            return null;
        }
        return $this->repo->getArticleById($id);
    }

    public function addArticle($title, $keywords, $featured_image, $content) {
        if (empty($title) || strlen($title) < 3) {
            throw new Exception("Le titre doit contenir au moins 3 caractères");
        }
        if (empty($content)) {
            throw new Exception("Le contenu ne peut pas être vide");
        }
        return $this->repo->createArticle($title, $keywords, $featured_image, $content);
    }

    public function updateArticle($id, $title, $keywords, $featured_image, $content) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("ID invalide");
        }
        if (empty($title) || strlen($title) < 3) {
            throw new Exception("Le titre doit contenir au moins 3 caractères");
        }
        if (empty($content)) {
            throw new Exception("Le contenu ne peut pas être vide");
        }
        return $this->repo->updateArticle($id, $title, $keywords, $featured_image, $content);
    }

    public function deleteArticle($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("ID invalide");
        }
        return $this->repo->deleteArticle($id);
    }

    public function getTotalArticles() {
        return $this->repo->countArticles();
    }
}
