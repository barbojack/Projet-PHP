<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <title>Reviews — F1 2026</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Reviews de la saison 2026</h1>

    <a href="index.php">← Accueil</a>

    <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1): ?>
        <a href="index.php?page=creer_review">+ Nouvelle review</a>
    <?php endif; ?>

    <div id="conteneur-courses">
        <?php if (empty($reviews)): ?>
            <p class="loading">Aucune review pour le moment.</p>
        <?php else: ?>
            <?php foreach ($reviews as $review): ?>
                <div>
                    <h2><?= htmlspecialchars($review["title"]) ?></h2>
                    <p><strong>Note :</strong> <?= $review["mark"] ?>/20</p>
                    <p><?= htmlspecialchars(substr($review["description"], 0, 150)) ?>...</p>
                    <p><em>Par <?= htmlspecialchars($review["username"]) ?></em></p>
                    <a href="index.php?page=review_detail&id=<?= $review["id"] ?>">Lire la review →</a>
                    <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1): ?>
                        <a href="index.php?page=modifier_review&id=<?= $review["id"] ?>">Modifier</a>
                        <a href="index.php?page=supprimer_review&id=<?= $review["id"] ?>"
                           onclick="return confirm('Supprimer cette review ?')">Supprimer</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</body>
</html>