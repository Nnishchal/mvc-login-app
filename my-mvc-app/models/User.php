<?php
class User {
    private $db;

    public function __construct($pdo) {
        $this->db = $pdo;
    }

    public function findUser($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch();
    }

    public function createUser($username, $password) {
        $stmt = $this->db->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
        return $stmt->execute([$username, password_hash($password, PASSWORD_DEFAULT)]);
    }

    public function logAttempt($username, $attempt) {
        $stmt = $this->db->prepare("INSERT INTO logs (username, attempt, attempt_time) VALUES (?, ?, NOW())");
        $stmt->execute([$username, $attempt]);
    }

    public function failedAttemptsInLastMinute($username) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM logs 
            WHERE username = ? AND attempt = 'bad' 
            AND attempt_time > (NOW() - INTERVAL 1 MINUTE)
        ");
        $stmt->execute([$username]);
        return $stmt->fetchColumn();
    }

    public function lastFailedAttemptTime($username) {
        $stmt = $this->db->prepare("
            SELECT attempt_time FROM logs 
            WHERE username = ? AND attempt = 'bad'
            ORDER BY attempt_time DESC LIMIT 1
        ");
        $stmt->execute([$username]);
        return $stmt->fetchColumn();
    }
}
