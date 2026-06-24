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
        $controller->registration();
        break;

    case "connexion":
        $controller = new AuthController($pdo);
        $controller->connection();
        break;

    case "deconnexion":
        $controller = new AuthController($pdo);
        $controller->disconnection();
        break;

    case "reviews":
        $controller = new ReviewController($pdo);
        $controller->list();
        break;

    case "review_detail":
        $controller = new ReviewController($pdo);
        $controller->detail($pdo);
        break;

    case "creer_review":
        $controller = new ReviewController($pdo);
        $controller->create();
        break;

    case "modifier_review":
        $controller = new ReviewController($pdo);
        $controller->modificate();
        break;

    case "supprimer_review":
        $controller = new ReviewController($pdo);
        $controller->delete();
        break;

    case "gerer_reviews":
        $controller = new ReviewController($pdo);
        $controller->manage($pdo);
        break;

    case "modifier_commentaire":
        $controller = new CommentController($pdo);
        $controller->modificate();
        break;

    case "supprimer_commentaire":
        $controller = new CommentController($pdo);
        $controller->delete();
        break;

    default:
        require BASE_PATH . 'views' . DIRECTORY_SEPARATOR . 'layout' . DIRECTORY_SEPARATOR . 'accueil.php';
        break;
}
