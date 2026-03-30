<?php
require_once ROOT_PATH . "/app/models/ArticleModel.php";

class ArticleController {

    private $model;
    private $articlesPerPage = 6;

    public function __construct() {
        $this->model = new ArticleModel();
    }

    /**
     * Récupère la liste de tous les articles avec pagination
     */
    public function index() {
        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page); // Pas moins que 1

        $offset = ($page - 1) * $this->articlesPerPage;
        $articles = $this->model->getAllArticles($this->articlesPerPage, $offset);
        $total = $this->model->getTotalArticles();
        $totalPages = ceil($total / $this->articlesPerPage);

        return [
            'articles' => $articles,
            'page' => $page,
            'total_pages' => $totalPages,
            'total_articles' => $total
        ];
    }

    /**
     * Récupère un article spécifique par ID
     */
    public function show($id) {
        $article = $this->model->getArticleById($id);
        if (!$article) {
            http_response_code(404);
            return ['error' => 'Article non trouvé'];
        }
        return ['article' => $article];
    }

    /**
     * Crée un nouvel article (pour le BO)
     */
    public function create($title, $content, $keywords = '', $featured_image = '') {
        try {
            $this->model->addArticle($title, $keywords, $featured_image, $content);
            return ['success' => 'Article créé avec succès'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Met à jour un article (pour le BO)
     */
    public function update($id, $title, $content, $keywords = '', $featured_image = '') {
        try {
            $this->model->updateArticle($id, $title, $keywords, $featured_image, $content);
            return ['success' => 'Article mis à jour'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * Supprime un article (pour le BO)
     */
    public function delete($id) {
        try {
            $this->model->deleteArticle($id);
            return ['success' => 'Article supprimé'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
