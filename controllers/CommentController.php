<?php
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'db.php';
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'models' . DIRECTORY_SEPARATOR . 'Comment.php';

class CommentController
{
    private $commentModel;

    public function __construct($pdo)
    {
        $this->commentModel = new Comment($pdo);
    }

    public function modifier()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php");
            exit();
        }

        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            header("Location: index.php?page=reviews");
            exit();
        }

        $id        = (int) $_GET["id"];
        $review_id = (int) $_GET["review_id"];
        $commentaire = $this->commentModel->findById($id);

        if (!$commentaire || $commentaire["authorId"] != $_SESSION["user_id"]) {
            header("Location: index.php?page=reviews");
            exit();
        }

        $erreur = "";

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $contenu = trim($_POST["content"]);
            if (empty($contenu)) {
                $erreur = "Le commentaire ne peut pas être vide.";
            } else {
                $this->commentModel->update($id, $contenu);
                header("Location: index.php?page=review_detail&id=$review_id");
                exit();
            }
        }

        require __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'reviews' . DIRECTORY_SEPARATOR . 'modifier_commentaire.php';
    }

    public function supprimer()
    {
        if (!isset($_SESSION["user_id"])) {
            header("Location: index.php");
            exit();
        }

        if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
            header("Location: index.php?page=reviews");
            exit();
        }

        $id        = (int) $_GET["id"];
        $review_id = (int) $_GET["review_id"];
        $commentaire = $this->commentModel->findById($id);

        if (!$commentaire || $commentaire["authorId"] != $_SESSION["user_id"]) {
            header("Location: index.php?page=reviews");
            exit();
        }

        $this->commentModel->delete($id);
        header("Location: index.php?page=review_detail&id=$review_id");
        exit();
    }
}
