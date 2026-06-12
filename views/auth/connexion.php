<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <title>Connexion — F1 2026</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Se connecter</h1>

    <?php if ($erreur): ?>
        <p style="color:#e10600"><?= htmlspecialchars($erreur) ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?page=connexion">
        <div>
            <label>Nom d'utilisateur</label>
            <input type="text" name="username" required>
        </div>
        <div>
            <label>Mot de passe</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Se connecter</button>
    </form>

    <p>Pas encore de compte ? <a href="index.php?page=inscription">S'inscrire</a></p>
</body>
</html>