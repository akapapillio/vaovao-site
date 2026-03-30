<?php
// app/controllers/AdminController.php

require_once ROOT_PATH . '/app/models/AdminModel.php';

class AdminController
{
    private $model;

    public function __construct()
    {
        $this->model = new AdminModel();
    }

    public function index()
    {
        return $this->model->getAllAdmins();
    }

    public function create($nom, $email, $password)
    {
        return $this->model->addAdmin($nom, $email, $password);
    }

    public function delete($id)
    {
        return $this->model->deleteAdmin($id);
    }
}