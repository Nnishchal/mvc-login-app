<?php
class HomeController {
    public function index() {
        session_start();
        if (!isset($_SESSION['user'])) {
            header('Location: index.php?page=login');
            exit;
        }

        $username = $_SESSION['user'];
        include 'views/home.php';
    }
}
