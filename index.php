<?php
session_start();
require 'db.php';

define('BASE_PATH', __DIR__ . DIRECTORY_SEPARATOR);

require_once BASE_PATH . 'controllers' . DIRECTORY_SEPARATOR . 'AuthController.php';
require_once BASE_PATH . 'controllers' . DIRECTORY_SEPARATOR . 'ReviewController.php';
require_once BASE_PATH . 'controllers' . DIRECTORY_SEPARATOR . 'CommentController.php';

$page = $_GET["page"] ?? "accueil";

switch ($page) {

    case "accueil":
        require BASE_PATH . 'views' . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR . 'accueil.php';
        break;

    case "resultats":
        require BASE_PATH . 'views' . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR . 'resultats.php';
        break;

    case "inscription":
        $controller = new AuthController($pdo);
        $controller->inscription();
        break;

    case "connexion":
        $controller = new AuthController($pdo);
        $controller->connexion();
        break;

    case "deconnexion":
        $controller = new AuthController($pdo);
        $controller->deconnexion();
        break;

    case "reviews":
        $controller = new ReviewController($pdo);
        $controller->liste();
        break;

    case "review_detail":
        $controller = new ReviewController($pdo);
        $controller->detail($pdo);
        break;

    case "creer_review":
        $controller = new ReviewController($pdo);
        $controller->creer();
        break;

    case "modifier_review":
        $controller = new ReviewController($pdo);
        $controller->modifier();
        break;

    case "supprimer_review":
        $controller = new ReviewController($pdo);
        $controller->supprimer();
        break;

    case "gerer_reviews":
        $controller = new ReviewController($pdo);
        $controller->gerer($pdo);
        break;

    case "modifier_commentaire":
        $controller = new CommentController($pdo);
        $controller->modifier();
        break;

    case "supprimer_commentaire":
        $controller = new CommentController($pdo);
        $controller->supprimer();
        break;

    default:
        require BASE_PATH . 'views' . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR . 'accueil.php';
        break;
}
