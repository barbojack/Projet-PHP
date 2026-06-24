<?php
// ARCHITECTURE MVC : Résolution de dépendances et portabilité 
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'db.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Review.php';

class ReviewController
{
    // Encapsulation : Propriété privée pour stocker l'instance du modèle métier
    private $reviewModel;

    // DESIGN PATTERN : Injection de dépendance 
    // Le contrôleur reçoit l'objet d'accès aux données ($pdo) et l'injecte dans le modèle
    public function __construct($pdo)
    {
        $this->reviewModel = new Review($pdo);
    }

    public function list()
    {
        // Extraction des données via le modèle
        $reviews = $this->reviewModel->findAll();
        // Acheminement vers la vue correspondante 
        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'reviews' . DIRECTORY_SEPARATOR . 'liste.php';
    }

    public function detail($pdo)
    {
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            header("Location: /f1_2026/index.php?page=reviews");
            exit();
        }

        $id = (int) $_GET["id"];
        $review = $this->reviewModel->findById($id);

        // Gestion de l'erreur 404 applicative : Redirection si l'ID ne correspond à aucune review réelle
        if (!$review) {
            header("Location: /f1_2026/index.php?page=reviews");
            exit();
        }

        // On charge le modèle Comment uniquement car l'action en a besoin ici
        require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Comment.php';
        $commentModel = new Comment($pdo);

        $erreur = "";

        // CYCLE DE VIE DE REQUÊTE : Traitement de l'envoi d'un commentaire 
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // Contrôle de l'état de sécurité : Seul un utilisateur connecté peut soumettre des données
            if (!isset($_SESSION["user_id"])) {
                $erreur = "Vous devez être connecté pour commenter.";
            } else {
                // Suppression des espaces vides pour assainir la saisie
                $contenu = trim($_POST["content"]);

                // Règle métier : Blocage des soumissions vides
                if (empty($contenu)) {
                    $erreur = "Le commentaire ne peut pas être vide.";
                } else {
                    // Persistance de la liaison : Création du commentaire lié à la review et à l'utilisateur
                    $commentModel->create($contenu, $id, $_SESSION["user_id"]);
                    // Post-Redirect-Get pattern : Redirection pour éviter la resoumission du formulaire au rafraîchissement
                    header("Location: /f1_2026/index.php?page=review_detail&id=$id");
                    exit();
                }
            }
        }

        // Récupération des données associées pour alimenter la vue
        $commentaires = $commentModel->findByReviewId($id);
        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'reviews' . DIRECTORY_SEPARATOR . 'detail.php';
    }

    public function create()
    { 
        // Mur de sécurité : Si non connecté OU si le drapeau isAdmin n'est pas actif, accès refusé
        if (!isset($_SESSION["user_id"]) || $_SESSION["isAdmin"] != 1) {
            header("Location: /f1_2026/index.php");
            exit();
        }

        $erreur = "";
        $succes = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $gp_name      = trim($_POST["title"]);
            $custom_title = trim($_POST["custom_title"]);
            $description  = trim($_POST["description"]);
            $mark         = (int) $_POST["mark"];

            // LOGIQUE MÉTIER FORMATION DU TITRE
            // Concaténation adaptative : Crée un titre propre selon que l'admin a complété ou non le titre personnalisé
            $title = $gp_name;
            if (!empty($custom_title)) {
                $title = $gp_name . " — " . $custom_title;
            }

            // VÉRIFICATIONS DE CONFORMITÉ DES DONNÉES
            if (empty($gp_name)) {
                $erreur = "Veuillez choisir un Grand Prix.";
            } elseif (empty($description)) {
                $erreur = "Le texte de la review est obligatoire.";
                // Contrôle de cohérence : Validation des limites numériques de la note F1
            } elseif ($mark < 0 || $mark > 20) {
                $erreur = "La note doit être comprise entre 0 et 20.";
            } else {
                // Enregistrement de la nouvelle review en y associant l'ID de l'admin auteur
                $this->reviewModel->create($title, $description, $mark, $_SESSION["user_id"]);
                $succes = "Review publiée avec succès !";
            }
        }

        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'reviews' . DIRECTORY_SEPARATOR . 'creer.php';
    }

    public function modificate()
    {
        if (!isset($_SESSION["user_id"]) || $_SESSION["isAdmin"] != 1) {
            header("Location: /f1_2026/index.php");
            exit();
        }

        // Validation du paramètre d'URL GET
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            header("Location: /f1_2026/index.php?page=reviews");
            exit();
        }

        $id = (int) $_GET["id"];
        $review = $this->reviewModel->findById($id);

        if (!$review) {
            header("Location: /f1_2026/index.php?page=reviews");
            exit();
        }

        $erreur = "";
        $succes = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $title       = trim($_POST["title"]);
            $description = trim($_POST["description"]);
            $mark        = (int) $_POST["mark"];

            if (empty($title) || empty($description)) {
                $erreur = "Tous les champs sont obligatoires.";
            } elseif ($mark < 0 || $mark > 20) {
                $erreur = "La note doit être comprise entre 0 et 20.";
            } else {
                // Mise à jour de l'entité via le modèle
                $this->reviewModel->update($id, $title, $description, $mark);
                $succes = "Review modifiée avec succès !";
                // Récupération de l'état rafraîchi de la donnée pour ré-alimenter les champs du formulaire
                $review = $this->reviewModel->findById($id);
            }
        }

        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'reviews' . DIRECTORY_SEPARATOR . 'modifier.php';
    }

    public function manage($pdo)
    {
        // Vérification des droits d'accès
        if (!isset($_SESSION["user_id"]) || $_SESSION["isAdmin"] != 1) {
            header("Location: /f1_2026/index.php");
            exit();
        }

        require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Comment.php';
        $commentModel = new Comment($pdo);

        $reviews = $this->reviewModel->findAll();
        // Déclaration des structures d'accueil des indicateurs
        $totalCommentaires = 0;
        $nbCommentairesParReview = [];

        // Boucle itérative pour croiser les données des Reviews avec le volume de Commentaires associés
        foreach ($reviews as $review) {
            // Comptage dynamique des sous-éléments
            $nb = count($commentModel->findByReviewId($review["id"]));
            // Cartographie : Stockage de la correspondance [ID de la review => Nombre de commentaires]
            $nbCommentairesParReview[$review["id"]] = $nb;
            // Cumul global pour le tableau de bord généraliste
            $totalCommentaires += $nb;
        }

        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'reviews' . DIRECTORY_SEPARATOR . 'gerer.php';
    }

    public function delete()
    {
        // Contrôle d'habilitation administrateur de sécurité
        if (!isset($_SESSION["user_id"]) || $_SESSION["isAdmin"] != 1) {
            header("Location: /f1_2026/index.php");
            exit();
        }

        // Contrôle d'existence du paramètre ciblé
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            header("Location: /f1_2026/index.php?page=reviews");
            exit();
        }

        $id = (int) $_GET["id"];
        // Ordre de suppression envoyé à la base de données via la méthode du modèle
        $this->reviewModel->delete($id);

        // Redirection vers le tableau de contrôle de gestion
        header("Location: /f1_2026/index.php?page=gerer_reviews");
        exit();
    }
}
