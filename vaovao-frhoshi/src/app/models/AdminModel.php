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

    public function addAdmin($username, $password) {
        if (strlen($username) < 3) {
            die("Username trop court");
        }
        $this->repo->createAdmin($username, $password);
    }

    public function deleteAdmin($id) {
        $this->repo->deleteAdmin($id);
    }
}