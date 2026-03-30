<?php
require_once ROOT_PATH . "/app/repositories/UserRepository.php";

class UserModel {

    private $repo;

    public function __construct() {
        $this->repo = new UserRepository();
    }

    public function getUserByEmail($email) {
        if (empty($email)) {
            return null;
        }
        return $this->repo->getUserByEmail($email);
    }

    public function getUserByNom($nom) {
        if (empty($nom)) {
            return null;
        }
        return $this->repo->getUserByNom($nom);
    }

    public function getAllUsers($limit = null, $offset = 0) {
        return $this->repo->getAllUsers($limit, $offset);
    }

    public function addUser($nom, $email, $password) {
        if (empty($nom) || strlen($nom) < 3) {
            throw new Exception("Le nom doit contenir au moins 3 caractères");
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("L'email est invalide");
        }
        if (empty($password) || strlen($password) < 6) {
            throw new Exception("Le mot de passe doit contenir au moins 6 caractères");
        }
        return $this->repo->createUser($nom, $email, $password);
    }

    public function deleteUser($id) {
        if (!is_numeric($id) || $id <= 0) {
            throw new Exception("ID invalide");
        }
        return $this->repo->deleteUser($id);
    }

    public function getTotalUsers() {
        return $this->repo->countUsers();
    }
}
