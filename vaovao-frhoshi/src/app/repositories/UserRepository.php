<?php
require_once ROOT_PATH . "/app/repositories/DatabaseRepository.php";

class UserRepository extends DatabaseRepository {

    public function getUserByEmail($email) {
        return $this->fetch(
            "SELECT id, nom, email, password FROM users WHERE email = ?",
            [$email]
        );
    }

    public function getUserByNom($nom) {
        return $this->fetch(
            "SELECT id, nom, email, password FROM users WHERE nom = ?",
            [$nom]
        );
    }

    public function getAllUsers($limit = null, $offset = 0) {
        $sql = "SELECT id, nom, email, created_at FROM users ORDER BY created_at DESC";
        if ($limit) {
            $limit = (int)$limit;
            $offset = (int)$offset;
            $sql .= " LIMIT $limit OFFSET $offset";
        }
        return $this->fetchAll($sql);
    }

    public function createUser($nom, $email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $this->execute(
            "INSERT INTO users(nom, email, password) VALUES (?, ?, ?)",
            [$nom, $email, $hash]
        );
    }

    public function deleteUser($id) {
        return $this->execute("DELETE FROM users WHERE id = ?", [$id]);
    }

    public function countUsers() {
        $result = $this->fetch("SELECT COUNT(*) as total FROM users");
        return $result['total'] ?? 0;
    }
}
