<?php
require_once 'models/User.php';

class LoginController {
    public function login($pdo) {
        session_start();
        $userModel = new User($pdo);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            $user = $userModel->findUser($username);

            $failedCount = $userModel->failedAttemptsInLastMinute($username);

            if ($failedCount >= 3) {
                $lastTime = strtotime($userModel->lastFailedAttemptTime($username));
                if (time() - $lastTime < 60) {
                    die("Too many failed attempts. Try again in 60 seconds.");
                }
            }

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user'] = $username;
                $userModel->logAttempt($username, 'good');
                header('Location: index.php?page=home');
            } else {
                $userModel->logAttempt($username, 'bad');
                echo "Login failed";
            }
        }

        include 'views/login.php';
    }

    public function create($pdo) {
        $userModel = new User($pdo);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            if ($userModel->createUser($username, $password)) {
                echo "User created. <a href='index.php?page=login'>Login</a>";
            } else {
                echo "Failed to create user.";
            }
        }

        include 'views/register.php';
    }
}