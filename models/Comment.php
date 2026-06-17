<?php

class Comment
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Récupérer tous les commentaires d'une review
    public function findByReviewId($reviewId)
    {
        $stmt = $this->pdo->prepare("
            SELECT Comments.*, Users.username 
            FROM Comments 
            JOIN Users ON Comments.authorId = Users.id 
            WHERE Comments.reviewId = ? 
            ORDER BY Comments.id ASC
        ");
        $stmt->execute([$reviewId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer un commentaire par son ID
    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Comments WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Créer un commentaire
    public function create($content, $reviewId, $authorId)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO Comments (content, reviewId, authorId) VALUES (?, ?, ?)
        ");
        $stmt->execute([$content, $reviewId, $authorId]);
    }

    // Modifier un commentaire
    public function update($id, $content)
    {
        $stmt = $this->pdo->prepare("UPDATE Comments SET content = ? WHERE id = ?");
        $stmt->execute([$content, $id]);
    }

    // Supprimer un commentaire
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Comments WHERE id = ?");
        $stmt->execute([$id]);
    }
}
