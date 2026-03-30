<?php
require_once ROOT_PATH . "/app/models/UserModel.php";

class UserController {

    private $model;

    public function __construct() {
        $this->model = new UserModel();
    }

    public function getUserByEmail($email) {
        return $this->model->getUserByEmail($email);
    }

    public function getUserByNom($nom) {
        return $this->model->getUserByNom($nom);
    }

    public function getAllUsers() {
        return $this->model->getAllUsers();
    }

    public function create($nom, $email, $password) {
        try {
            $this->model->addUser($nom, $email, $password);
            return ['success' => 'Utilisateur créé avec succès'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    public function delete($id) {
        try {
            $this->model->deleteUser($id);
            return ['success' => 'Utilisateur supprimé'];
        } catch (Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }
}
