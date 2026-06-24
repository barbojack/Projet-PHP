<?php

/**
 * COUCHE MODÈLE : Classe Comment
 * Gère l'intégralité des interactions structurelles et des requêtes SQL avec la table 'Comments'
 */
class Comment
{
    // Encapsulation : Instance de connexion PDO accessible uniquement au sein du modèle
    private $pdo;
    // Le constructeur reçoit la connexion PDO globale transmise par le contrôleur
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function findByReviewId($reviewId)
    {
        // SÉCURITÉ CRITIQUE : Requête Préparée (Anti-Injection SQL)
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

    public function findById($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM Comments WHERE id = ?");
        $stmt->execute([$id]);

        // fetch() sans All car l'identifiant étant unique, la requête ne retournera qu'une seule ligne (ou false)
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($content, $reviewId, $authorId)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO Comments (content, reviewId, authorId) VALUES (?, ?, ?)
        ");
        // Les 3 variables sont injectées de manière hermétique par le driver PDO
        $stmt->execute([$content, $reviewId, $authorId]);
    }

    public function update($id, $content)
    {
        $stmt = $this->pdo->prepare("UPDATE Comments SET content = ? WHERE id = ?");
        // L'ordre des variables dans le tableau doit correspondre exactement à l'ordre des '?' dans la requête
        $stmt->execute([$content, $id]);
    }

    //SUPPRESSION PHYSIQUE D'UN COMMENTAIRE (DELETE)
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Comments WHERE id = ?");
        $stmt->execute([$id]);
    }
}
