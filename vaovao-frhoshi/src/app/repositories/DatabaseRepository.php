<?php
require_once ROOT_PATH . "/config/db.php";

class DatabaseRepository {

    protected $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    // 🔍 SELECT plusieurs lignes
    protected function fetchAll($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔍 SELECT une seule ligne
    protected function fetch($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ➕ INSERT / UPDATE / DELETE
    protected function execute($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    protected function lastInsertId() {
        return $this->pdo->lastInsertId();
    }
}