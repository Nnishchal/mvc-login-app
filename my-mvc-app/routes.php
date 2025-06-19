<?php
$page = $_GET['page'] ?? 'login';
$pdo = new PDO("mysql:host=localhost;dbname=yourdb", 'user', 'pass');

switch ($page) {
    case 'login':
        require_once 'controllers/LoginController.php';
        (new LoginController)->login($pdo);
        break;
    case 'create':
        require_once 'controllers/LoginController.php';
        (new LoginController)->create($pdo);
        break;
    case 'home':
        require_once 'controllers/HomeController.php';
        (new HomeController)->index();
        break;
    default:
        echo "404";
}