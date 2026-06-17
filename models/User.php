<?php

class User
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Trouver un utilisateur par son username
    public function findByUsername($username)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Users WHERE username = ?");
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Trouver un utilisateur par son email
    public function findByEmail($email)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Trouver un utilisateur par username OU email
    public function findByUsernameOrEmail($identifiant)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Users WHERE username = ? OR email = ?");
        $stmt->execute([$identifiant, $identifiant]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Créer un nouvel utilisateur
    public function create($username, $email, $password)
    {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO Users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hash]);
    }
}
