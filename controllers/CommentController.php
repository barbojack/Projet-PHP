<?php
// ARCHITECTURE MVC : Résolution de chemins absolute et isolation
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'db.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Comment.php';

class CommentController
{
    // Encapsulation : Propriété privée pour restreindre l'accès direct au modèle de données
    private $commentModel;

    // CONSTRUCTEUR : Injection de dépendance
    // On injecte l'instance PDO pour centraliser la connexion et éviter d'instancier la BDD à l'infini
    public function __construct($pdo)
    {
        $this->commentModel = new Comment($pdo);
    }

    public function modificate()
    {
        // Authentification 
        // Contrôle d'accès : Si l'utilisateur n'est pas connecté, l'action est immédiatement bloquée
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php");
            exit(); // Bonne pratique : On stoppe l'exécution du script après une redirection de sécurité
        }

        // On vérifie la présence et le type numérique de l'identifiant pour éviter des bugs ou injections
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            header("Location: index.php?page=reviews");
            exit();
        }

        $id        = (int) $_GET["id"];
        $review_id = (int) $_GET["review_id"];

        // Requête de contrôle : On récupère l'état actuel du commentaire en base de données
        $commentaire = $this->commentModel->findById($id);

        // Sécurité critique : On vérifie si le commentaire existe ET si l'utilisateur connecté est bien son auteur.
        // Cela empêche un utilisateur malveillant de modifier le commentaire d'un autre en changeant simplement l'ID dans l'URL.
        if (!$commentaire || $commentaire["authorId"] != $_SESSION["user_id"]) {
            header("Location: index.php?page=reviews");
            exit();
        }

        $erreur = "";

        // PROTOCOLE D'ÉCRITURE : Traitement du formulaire de modification 
        // Séparation des flux HTTP : On ne traite les modifications que si la méthode utilisée est explicitement du POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Nettoyage de la saisie pour éliminer les espaces blancs inutiles
            $contenu = trim($_POST["content"]);

            // Validation de la règle métier : Interdiction de soumettre une chaîne vide
            if (empty($contenu)) {
                $erreur = "Le commentaire ne peut pas être vide.";
            } else {
                // Persistance des données : Mise à jour déléguée à la couche Modèle
                $this->commentModel->update($id, $contenu);
                // Redirection contextuelle vers le détail de la "Review" (le post F1 concerné)
                header("Location: index.php?page=review_detail&id=$review_id");
                exit();
            }
        }

        // CHARGEMENT DU RENDU (COUCHE VUE) 
        // L'architecture MVC prend tout son sens ici : le contrôleur transmet l'état du commentaire nettoyé à l'interface
        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'reviews' . DIRECTORY_SEPARATOR . 'modifier_commentaire.php';
    }

    public function delete()
    {
        // Contrôle d'accès : Seul un utilisateur authentifié peut initier une requête de suppression
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php");
            exit();
        }

        // Validation d'intégrité de l'ID passé en paramètre d'URL
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            header("Location: index.php?page=reviews");
            exit();
        }

        $id        = (int) $_GET["id"];
        $review_id = (int) $_GET["review_id"];
        $commentaire = $this->commentModel->findById($id);

        // Contrôle de légitimité de l'action : Interdiction formelle de supprimer le contenu d'un tiers
        if (!$commentaire || $commentaire["authorId"] != $_SESSION["user_id"]) {
            header("Location: index.php?page=reviews");
            exit();
        }

        // Délégation du traitement de suppression physique en base de données à la couche Modèle
        $this->commentModel->delete($id);

        // Redirection et rafraîchissement propre de l'interface utilisateur
        header("Location: index.php?page=review_detail&id=$review_id");
        exit();
    }
}
