<?php

class UserManager {
    private $conn;

    public function __construct($pdo) {
        $this->conn = $pdo;
    }

    public function register($name, $email, $password, $role = 'staff') {
        if (empty($name) || empty($email) || empty($password)) {
            die("All fields are required");
        }
    
        $hash_password = password_hash($password, PASSWORD_DEFAULT);
    
        // Add 'approved' field to the SQL query
        $sql = "INSERT INTO users (name, email, password, role, approved) VALUES (:name, :email, :password, :role, 0)";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt === false) {
            die("Prepare failed: " . implode(", ", $this->conn->errorInfo()));
        }
    
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hash_password);
        $stmt->bindParam('role', $role);
    
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            return $this->conn->lastInsertId();
        } else {
            return null;
        }
    }
    
    

    public function validateLogin($email, $password) {
        $sql = "SELECT id, name, password, role, approved FROM users WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
    
        if ($stmt === false) {
            die("Prepare failed: " . implode(", ", $this->conn->errorInfo()));
        }
    
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        if ($stmt->errorCode() != '00000') {
            die("Execute failed: " . implode(", ", $stmt->errorInfo()));
        }
    
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user) {
            if ($user['approved'] == 0) {
                // User is not approved
                return ['error' => 'Your account is not approved yet. Please wait for admin approval.'];
            } elseif (password_verify($password, $user['password'])) {
                return $user;
            }
        }
    
        return null;
    }
}   