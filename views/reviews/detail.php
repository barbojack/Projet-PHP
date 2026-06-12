<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($review["title"]) ?> — F1 2026</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.php?page=reviews">← Retour aux reviews</a>

    <h1><?= htmlspecialchars($review["title"]) ?></h1>
    <p><strong>Note :</strong> <?= $review["mark"] ?>/20</p>
    <p><?= nl2br(htmlspecialchars($review["description"])) ?></p>
    <p><em>Par <?= htmlspecialchars($review["username"]) ?></em></p>

    <hr>

    <h2>Commentaires (<?= count($commentaires) ?>)</h2>

    <?php if (empty($commentaires)): ?>
        <p>Aucun commentaire pour le moment.</p>
    <?php else: ?>
        <?php foreach ($commentaires as $commentaire): ?>
            <div>
                <strong><?= htmlspecialchars($commentaire["username"]) ?></strong>
                <p><?= nl2br(htmlspecialchars($commentaire["content"])) ?></p>
                <?php if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $commentaire["authorId"]): ?>
                    <a href="index.php?page=modifier_commentaire&id=<?= $commentaire["id"] ?>&review_id=<?= $id ?>">Modifier</a>
                    <a href="index.php?page=supprimer_commentaire&id=<?= $commentaire["id"] ?>&review_id=<?= $id ?>"
                       onclick="return confirm('Supprimer ce commentaire ?')">Supprimer</a>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

    <hr>

    <?php if (isset($_SESSION["user_id"])): ?>
        <h3>Laisser un commentaire</h3>
        <?php if ($erreur): ?>
            <p style="color:#e10600"><?= htmlspecialchars($erreur) ?></p>
        <?php endif; ?>
        <form method="POST" action="index.php?page=review_detail&id=<?= $id ?>">
            <textarea name="content" rows="4" placeholder="Votre commentaire..." required></textarea>
            <button type="submit">Publier</button>
        </form>
    <?php else: ?>
        <p><a href="index.php?page=connexion">Connectez-vous</a> pour laisser un commentaire.</p>
    <?php endif; ?>
</body>
</html>