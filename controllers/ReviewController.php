<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'db.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Review.php';

class ReviewController {
    private $reviewModel;

    public function __construct($pdo) {
        $this->reviewModel = new Review($pdo);
    }

    public function liste() {
        $reviews = $this->reviewModel->findAll();
        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'reviews' . DIRECTORY_SEPARATOR . 'liste.php';
    }

    public function detail($pdo) {
        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            header("Location: index.php?page=reviews");
            exit();
        }

        $id = (int) $_GET["id"];
        $review = $this->reviewModel->findById($id);

        if (!$review) {
            header("Location: index.php?page=reviews");
            exit();
        }

        require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Comment.php';
        $commentModel = new Comment($pdo);

        $erreur = "";
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            if (!isset($_SESSION["user_id"])) {
                $erreur = "Vous devez être connecté pour commenter.";
            } else {
                $contenu = trim($_POST["content"]);
                if (empty($contenu)) {
                    $erreur = "Le commentaire ne peut pas être vide.";
                } else {
                    $commentModel->create($contenu, $id, $_SESSION["user_id"]);
                    header("Location: index.php?page=review_detail&id=$id");
                    exit();
                }
            }
        }

        $commentaires = $commentModel->findByReviewId($id);
        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'reviews' . DIRECTORY_SEPARATOR . 'detail.php';
    }

    public function creer() {
        if (!isset($_SESSION["user_id"]) || $_SESSION["isAdmin"] != 1) {
            header("Location: index.php");
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
                $this->reviewModel->create($title, $description, $mark, $_SESSION["user_id"]);
                $succes = "Review publiée avec succès !";
            }
        }

        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'reviews' . DIRECTORY_SEPARATOR . 'creer.php';
    }

    public function modifier() {
        if (!isset($_SESSION["user_id"]) || $_SESSION["isAdmin"] != 1) {
            header("Location: index.php");
            exit();
        }

        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            header("Location: index.php?page=reviews");
            exit();
        }

        $id = (int) $_GET["id"];
        $review = $this->reviewModel->findById($id);

        if (!$review) {
            header("Location: index.php?page=reviews");
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
                $this->reviewModel->update($id, $title, $description, $mark);
                $succes = "Review modifiée avec succès !";
                $review = $this->reviewModel->findById($id);
            }
        }

        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'reviews' . DIRECTORY_SEPARATOR . 'modifier.php';
    }

    public function supprimer() {
        if (!isset($_SESSION["user_id"]) || $_SESSION["isAdmin"] != 1) {
            header("Location: index.php");
            exit();
        }

        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            header("Location: index.php?page=reviews");
            exit();
        }

        $id = (int) $_GET["id"];
        $this->reviewModel->delete($id);
        header("Location: index.php?page=reviews");
        exit();
    }
}