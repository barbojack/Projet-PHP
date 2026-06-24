<?php

//Gère les interactions avec la table 'Users' (Authentification et Inscriptions)
 //Centralise la logique de sécurité liée aux comptes utilisateurs
class User
{
    // Encapsulation : Propriété privée isolant l'objet PDO pour protéger l'accès à la BDD
    private $pdo;

    // Le constructeur récupère la connexion globale pour exécuter les requêtes de cette classe
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    //Utilisé lors de l'inscription pour vérifier l'unicité du pseudonyme
    public function findByUsername($username)
    {
        // Sécurisation : Requête préparée pour prémunir le système contre les injections SQL
        $stmt = $this->pdo->prepare("SELECT * FROM Users WHERE username = ?");
        $stmt->execute([$username]);

        // Retourne un tableau associatif de l'utilisateur ou 'false' si aucun ne correspond
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //Utilisé pour interdire la création de comptes doublons avec le même email
    public function findByEmail($email)
    {
        // Sécurisation : Utilisation du driver PDO pour neutraliser les données dynamiques
        $stmt = $this->pdo->prepare("SELECT * FROM Users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

     //Améliore l'expérience utilisateur lors de la phase de connexion
    public function findByUsernameOrEmail($identifiant)
    {
        // Flexibilité SQL : Permet à l'utilisateur de se connecter indifféremment avec son pseudo ou son mail
        $stmt = $this->pdo->prepare("SELECT * FROM Users WHERE username = ? OR email = ?");

        // On passe deux fois la même variable '$identifiant' car la requête contient deux marqueurs '?'
        $stmt->execute([$identifiant, $identifiant]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * PERSISTANCE / CRÉATION D'UN COMPTE UTILISATEUR (CREATE)
     * Intègre les exigences modernes de sécurité cryptographique
     */
    public function create($username, $email, $password)
    {
        // SÉCURITÉ CRYPTOGRAPHIQUE : password_hash 
        // On ne stocke JAMAIS un mot de passe en clair.
        // PASSWORD_DEFAULT utilise l'algorithme de hachage le plus robuste
        $hash = password_hash($password, PASSWORD_DEFAULT);

        // Insertion sécurisée du tuple dans la base de données avec le mot de passe haché
        $stmt = $this->pdo->prepare("INSERT INTO Users (username, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$username, $email, $hash]);
    }
}
