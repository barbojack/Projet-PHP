<?php
session_start();
require 'db.php';

// Chemin de base absolu compatible Windows
define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR);

$page = $_GET["page"] ?? "accueil";

switch ($page) {

    case "accueil":
        require BASE_PATH . 'views' . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR . 'accueil.php';
        break;

    case "resultats":
        require BASE_PATH . 'views' . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR . 'resultats.php';
        break;

    case "inscription":
        require_once BASE_PATH . 'controllers' . DIRECTORY_SEPARATOR . 'AuthController.php';
        $controller = new AuthController($pdo);
        $controller->inscription();
        break;

    case "connexion":
        require_once BASE_PATH . 'controllers' . DIRECTORY_SEPARATOR . 'AuthController.php';
        $controller = new AuthController($pdo);
        $controller->connexion();
        break;

    case "deconnexion":
        require_once BASE_PATH . 'controllers' . DIRECTORY_SEPARATOR . 'AuthController.php';
        $controller = new AuthController($pdo);
        $controller->deconnexion();
        break;

    case "reviews":
        require_once BASE_PATH . 'controllers' . DIRECTORY_SEPARATOR . 'ReviewController.php';
        $controller = new ReviewController($pdo);
        $controller->liste();
        break;

    case "review_detail":
        require_once BASE_PATH . 'controllers' . DIRECTORY_SEPARATOR . 'ReviewController.php';
        $controller = new ReviewController($pdo);
        $controller->detail($pdo);
        break;

    case "creer_review":
        require_once BASE_PATH . 'controllers' . DIRECTORY_SEPARATOR . 'ReviewController.php';
        $controller = new ReviewController($pdo);
        $controller->creer();
        break;

    case "modifier_review":
        require_once BASE_PATH . 'controllers' . DIRECTORY_SEPARATOR . 'ReviewController.php';
        $controller = new ReviewController($pdo);
        $controller->modifier();
        break;

    case "supprimer_review":
        require_once BASE_PATH . 'controllers' . DIRECTORY_SEPARATOR . 'ReviewController.php';
        $controller = new ReviewController($pdo);
        $controller->supprimer();
        break;

    case "modifier_commentaire":
        require_once BASE_PATH . 'controllers' . DIRECTORY_SEPARATOR . 'CommentController.php';
        $controller = new CommentController($pdo);
        $controller->modifier();
        break;

    case "supprimer_commentaire":
        require_once BASE_PATH . 'controllers' . DIRECTORY_SEPARATOR . 'CommentController.php';
        $controller = new CommentController($pdo);
        $controller->supprimer();
        break;

    default:
        require BASE_PATH . 'views' . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR . 'accueil.php';
        break;
}
?>