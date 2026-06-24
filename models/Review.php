<?php

//Réalise l'intégralité du cycle de vie CRUD (Create, Read, Update, Delete)
class Review
{
    // Encapsulation : Instance PDO de connexion à la base de données (isolée du reste de l'application)
    private $pdo;

    // Injection du composant de persistance PDO dans le constructeur pour assurer le couplage faible
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function findAll()
    {
        // PERFORMANCE & ARCHITECTURE : Pourquoi pdo->query() ici ? 
        // Comme cette requête ne contient AUCUNE variable provenant de l'utilisateur, 
        // il n'y a aucun risque d'injection SQL. L'utilisation directe de query() est donc plus rapide et optimisée.
        $stmt = $this->pdo->query("
            SELECT Reviews.*, Users.username 
            FROM Reviews 
            JOIN Users ON Reviews.authorId = Users.id 
            ORDER BY Reviews.id ASC
        ");

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function findById($id)
    {
        // SÉCURITÉ : Protection contre l'injection SQL 
        $stmt = $this->pdo->prepare("
            SELECT Reviews.*, Users.username 
            FROM Reviews 
            JOIN Users ON Reviews.authorId = Users.id 
            WHERE Reviews.id = ?
        ");

        // Liaison et exécution sécurisée du paramètre positionnel
        $stmt->execute([$id]);

        // fetch() : On attend une seule entité (identifiant unique de clé primaire)
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Gère l'écriture métier de l'analyse, de la note, et réalise l'association de l'auteur admin
    public function create($title, $description, $mark, $authorId)
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO Reviews (title, description, mark, authorId) 
            VALUES (?, ?, ?, ?)
        ");
        $stmt->execute([$title, $description, $mark, $authorId]);
    }

    //Met à jour uniquement l'état éditable de l'analyse, sans altérer l'auteur d'origine
    public function update($id, $title, $description, $mark)
    {
        $stmt = $this->pdo->prepare("
            UPDATE Reviews SET title = ?, description = ?, mark = ? 
            WHERE id = ?
        ");
        // Le driver PDO s'occupe de typer correctement les variables (chaînes et entier) lors de l'exécution
        $stmt->execute([$title, $description, $mark, $id]);
    }

    //SUPPRESSION PHYSIQUE D'UNE CRITIQUE DE GRAND PRIX (DELETE)
    public function delete($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM Reviews WHERE id = ?");
        $stmt->execute([$id]);
    }
}
