<?php
require_once ROOT_PATH . "/app/repositories/AdminRepository.php";

class AdminModel {

    private $repo;

    public function __construct() {
        $this->repo = new AdminRepository();
    }

    public function getAllAdmins() {
        return $this->repo->getAllAdmins();
    }

    public function addAdmin($nom, $email, $password) {
        if (strlen($nom) < 3) {
            die("Nom trop court");
        }
        $this->repo->createAdmin($nom, $email, $password);
    }

    public function deleteAdmin($id) {
        $this->repo->deleteAdmin($id);
    }
}