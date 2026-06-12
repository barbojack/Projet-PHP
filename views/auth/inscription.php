<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <title>Inscription — F1 2026</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Créer un compte</h1>

    <?php if ($erreur): ?>
        <p style="color:#e10600"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <?php if ($succes): ?>
        <p style="color:#4ade80"><?= htmlspecialchars($succes) ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?page=inscription">
        <div>
            <label>Nom d'utilisateur</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label>Adresse e-mail</label>
            <input type="email" name="email" required>
        </div>
        <div>
            <label>Mot de passe</label>
            <input type="password" name="password" required>
        </div>
        <div>
            <label>Confirmer le mot de passe</label>
            <input type="password" name="confirm" required>
        </div>
        <button type="submit">Créer mon compte</button>
    </form>

    <p>Déjà un compte ? <a href="index.php?page=connexion">Se connecter</a></p>
</body>
</html>