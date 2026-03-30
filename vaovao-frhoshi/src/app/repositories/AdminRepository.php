<?php
require_once ROOT_PATH . "/app/repositories/DatabaseRepository.php";

class AdminRepository extends DatabaseRepository {

    public function getAllAdmins() {
        return $this->fetchAll("SELECT * FROM admins ORDER BY id DESC");
    }

    public function createAdmin($username, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $this->execute(
            "INSERT INTO admins(username,password) VALUES (?,?)",
            [$username, $hash]
        );
    }

    public function deleteAdmin($id) {
        return $this->execute("DELETE FROM admins WHERE id=?", [$id]);
    }
}