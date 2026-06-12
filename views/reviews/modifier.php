<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <title>Modifier la review — F1 2026</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.php?page=reviews">← Retour aux reviews</a>

    <h1>Modifier la review</h1>

    <?php if ($erreur): ?>
        <p style="color:#e10600"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <?php if ($succes): ?>
        <p style="color:#4ade80"><?= htmlspecialchars($succes) ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?page=modifier_review&id=<?= $id ?>">
        <div>
            <label>Titre de la review</label>
            <input type="text" name="title" value="<?= htmlspecialchars($review["title"]) ?>" required>
        </div>
        <div>
            <label>Note /20</label>
            <input type="number" name="mark" min="0" max="20" value="<?= $review["mark"] ?>" required>
        </div>
        <div>
            <label>Texte de la review</label>
            <textarea name="description" rows="8" required><?= htmlspecialchars($review["description"]) ?></textarea>
        </div>
        <button type="submit">Enregistrer les modifications</button>
    </form>
</body>
</html>