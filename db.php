<?php

// Informations de connexion à la base de données
$hote = "localhost";
$nom_bdd = "f1_2026";
$utilisateur = "root";
$mot_de_passe = ""; // Vide par défaut sur XAMPP

// On tente de se connecter avec PDO
try {
    $pdo = new PDO(
        "mysql:host=$hote;dbname=$nom_bdd;charset=utf8",
        $utilisateur,
        $mot_de_passe
    );

    // PDO affichera les erreurs SQL au lieu de les cacher
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Si la connexion échoue, on arrête tout et on affiche l'erreur
    die("Erreur de connexion : " . $e->getMessage());
}
