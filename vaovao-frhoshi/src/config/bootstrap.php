<?php

// Racine absolue du projet
define('ROOT_PATH', dirname(__DIR__));

// Inclure la DB
require_once __DIR__ . '/db.php';

// Inclure les controllers (pour admin/admins.php)
require_once ROOT_PATH . '/app/controllers/AdminController.php';

session_start();