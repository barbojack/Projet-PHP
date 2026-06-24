<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <title>F1 HUB - Modifier le commentaire</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <a href="index.php?page=review_detail&id=<?= $review_id ?>">← Retour à la review</a>

    <h1>Modifier mon commentaire</h1>

    <?php if ($erreur): ?>
        <p style="color:#e10600"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?page=modifier_commentaire&id=<?= $id ?>&review_id=<?= $review_id ?>">
        <textarea name="content" rows="4" required><?= htmlspecialchars($commentaire["content"]) ?></textarea>
        <button type="submit">Enregistrer</button>
    </form>
</body>

</html>