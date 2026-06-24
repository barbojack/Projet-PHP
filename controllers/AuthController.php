<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'db.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'User.php';

class AuthController
{
    private $userModel;

    public function __construct($pdo)
    {
        $this->userModel = new User($pdo);
    }

    public function registration()
    {
        $erreur = "";
        $succes = "";
        $username_saisi = "";
        $email_saisi = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $username = trim($_POST["username"]);
            $email    = trim($_POST["email"]);
            $password = trim($_POST["password"]);
            $confirm  = trim($_POST["confirm"]);

            $username_saisi = $username;
            $email_saisi    = $email;

            if (empty($username) || empty($email) || empty($password) || empty($confirm)) {
                $erreur = "Tous les champs sont obligatoires.";
            } elseif ($password !== $confirm) {
                $erreur = "Les mots de passe ne correspondent pas.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erreur = "L'adresse email n'est pas valide.";
            } elseif ($this->userModel->findByUsername($username)) {
                $erreur = "Ce nom d'utilisateur est déjà pris.";
            } elseif ($this->userModel->findByEmail($email)) {
                $erreur = "Cette adresse email est déjà utilisée.";
            } else {
                $this->userModel->create($username, $email, $password);
                $succes = "Compte créé avec succès ! Vous pouvez vous connecter.";
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
                $utilisateur = $this->userModel->findByUsernameOrEmail($identifiant);

                if (!$utilisateur || !password_verify($password, $utilisateur["password"])) {
                    $erreur = "Identifiant ou mot de passe incorrect.";
                } else {
                    $_SESSION["user_id"]  = $utilisateur["id"];
                    $_SESSION["username"] = $utilisateur["username"];
                    $_SESSION["isAdmin"]  = $utilisateur["isAdmin"];

                    header("Location: /f1_2026/index.php");
                    exit();
                }
            }
        }

        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'auth' . DIRECTORY_SEPARATOR . 'connexion.php';
    }

    public function disconnection()
    {
        session_destroy();
        header("Location: /f1_2026/index.php?page=connexion");
        exit();
    }
}
