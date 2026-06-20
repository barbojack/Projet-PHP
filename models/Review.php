<?php

class Review
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupérer toutes les reviews avec le nom de l'auteur
    public function findAll()
    {
        $stmt = $this->pdo->query("
            SELECT Reviews.*, Users.username 
            FROM Reviews 
            JOIN Users ON Reviews.authorId = Users.id 
            ORDER BY Reviews.id ASC
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer une review par son ID
    public function findById($id)
    {
        $stmt = $this->pdo->prepare("
            SELECT Reviews.*, Users.username 
            FROM Reviews 
            JOIN Users ON Reviews.authorId = Users.id 
            WHERE Reviews.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Créer une review
    public function create($title, $description, $mark, $authorId)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO Reviews (title, description, mark, authorId) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$title, $description, $mark, $authorId]);
    }

    // Modifier une review
    public function update($id, $title, $description, $mark)
    {
        $stmt = $this->pdo->prepare("
            UPDATE Reviews SET title = ?, description = ?, mark = ? 
            WHERE id = ?
        ");
        $stmt->execute([$title, $description, $mark, $id]);
    }

    // Supprimer une review
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Reviews WHERE id = ?");
        $stmt->execute([$id]);
    }
}
