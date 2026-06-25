<?php
// ARCHITECTURE MVC : Inclusion sécurisée et découpage des responsabilités
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'db.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'User.php';

class AuthController
{
    // Encapsulation : Propriété privée pour isoler l'accès au modèle User
    private $userModel;

    // DESIGN PATTERN : Injection de dépendance 
    // On passe l'instance PDO de la base de données au constructeur pour la transmettre au Modèle
    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function registration()
    {
        // Initialisation des variables d'état destinées à la Vue
        $erreur = "";
        $succes = "";
        $username_saisi = "";
        $email_saisi = "";

        // Traitement de la requête de manière asynchrone par rapport à l'affichage initial
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            // Nettoyage des espaces superflus pour éviter les injections de données vides
            $username = trim($_POST["username"]);
            $email    = trim($_POST["email"]);
            $password = trim($_POST["password"]);
            $confirm  = trim($_POST["confirm"]);

            // Persistance de saisie : Améliore l'expérience utilisateur en cas d'erreur de validation
            $username_saisi = $username;
            $email_saisi    = $email;

            // PROTOCOLE DE VALIDATION 
            if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
                $erreur = "Tous les champs sont obligatoires.";
                // Vérification de la cohérence des mots de passe (Double saisie)
            } elseif ($password !== $confirm) {
                $erreur = "Les mots de passe ne correspondent pas.";
                // Validation de format via les filtres natifs de PHP (Sécurisation applicative)
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erreur = "L'adresse email n'est pas valide.";
                // Contrôle d'unicité de l'identifiant via une requête en base de données
            } elseif ($this->userModel->findByUsername($username)) {
                $erreur = "Ce nom d'utilisateur est déjà pris.";
                // Contrôle d'unicité de l'email (Évite les doublons de comptes)
            } elseif ($this->userModel->findByEmail($email)) {
                $erreur = "Cette adresse email est déjà utilisée.";
            } else {
                $this->userModel->create($username, $email, $password);
                $succes = "Compte créé avec succès ! Vous pouvez vous connecter.";

                // Réinitialisation des champs après le succès de l'opération
                $username_saisi = "";
                $email_saisi    = "";
            }
        }

        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'inscription.php';
    }

    public function connection()
    {
        $erreur = "";
        $identifiant_saisi = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $identifiant = trim($_POST["identifiant"]);
            $password    = trim($_POST["password"]);
            $identifiant_saisi = $identifiant;

            if (empty($identifiant) || empty($password)) {
                $erreur = "Tous les champs sont obligatoires.";
            } else {
                // Appel au modèle pour récupérer le profil utilisateur (par email ou par pseudo)
                $utilisateur = $this->userModel->findByUsernameOrEmail($identifiant);

                if (!$utilisateur || !password_verify($password, $utilisateur["password"])) {
                    $erreur = "Identifiant ou mot de passe incorrect.";
                } else {
                    // PERSISTANCE D'ÉTAT : Initialisation de la session globale PHP
                    $_SESSION["user_id"]  = $utilisateur["id"];
                    $_SESSION["username"] = $utilisateur["username"];
                    $_SESSION["isAdmin"]  = $utilisateur["isAdmin"];

                    // GESTION DU COOKIE DE PERSISTANCE (UX) : Mémorisation de l'identifiant pour pré-remplir le formulaire
                    // Sécurisation applicative : Activation du flag 'HttpOnly' (dernier paramètre à true) pour bloquer les attaques XSS
                    if (isset($_POST['remember'])) {
                        $expiration = time() + (3600 * 24 * 30); // Cycle de vie de 30 jours
                        setcookie("remember_me", $utilisateur["username"], $expiration, "/", "", false, true);
                    } else {
                        // Révocation du cookie si la case est décochée lors d'une authentification réussie
                        setcookie("remember_me", "", time() - 3600, "/");
                    }

                    // Redirection HTTP vers l'accueil et arrêt immédiat du script pour sécuriser le thread
                    header("Location: /f1_2026/index.php");
                    exit();
                }
            }
        }

        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'connexion.php';
    }

    public function disconnect()
    {
        // Destruction des données de session côté serveur
        session_destroy();

        // Redirection vers le formulaire d'authentification
        header("Location: /f1_2026/index.php?page=connexion");
        exit();
    }
}
