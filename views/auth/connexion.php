<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 HUB - Connexion</title>
    <link rel="stylesheet" href="/f1_2026/css/global.css">
    <link rel="stylesheet" href="/f1_2026/css/auth.css">
</head>

<body>

    <div class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-f1">F1 2026</div>
            <div class="logo-season">Saison en cours</div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Navigation</div>
            <a href="/f1_2026/index.php" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                </svg>
                Accueil
            </a>
            <a href="/f1_2026/index.php?page=resultats" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <circle cx="12" cy="12" r="10" />
                    <polyline points="12 6 12 12 16 14" />
                </svg>
                Résultats
            </a>
            <a href="/f1_2026/index.php?page=reviews" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                </svg>
                Reviews
            </a>

            <div class="nav-section-label">Compte</div>
            <a href="/f1_2026/index.php?page=profil" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                    <circle cx="12" cy="7" r="4" />
                </svg>
                Mon profil
            </a>
            <a href="/f1_2026/index.php?page=connexion" class="nav-item active">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                    <polyline points="10 17 15 12 10 7" />
                    <line x1="15" y1="12" x2="3" y2="12" />
                </svg>
                Connexion
            </a>
        </nav>

        <div class="sidebar-bottom">
            <div class="user-role">Non connecté</div>
        </div>
    </div>

    <div class="main">

        <div class="topbar">
            <div style="display:flex;align-items:center;gap:12px;">
                <button class="hamburger" onclick="toggleSidebar()" aria-label="Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="topbar-left">Connexion</div>
            </div>
        </div>

        <div class="content">

            <div class="visual-bg">
                <div class="stripe stripe-1"></div>
                <div class="stripe stripe-2"></div>
                <div class="stripe stripe-3"></div>
                <div class="stripe stripe-4"></div>
                <div class="stripe stripe-5"></div>
            </div>

            <div class="visual-content">
                <div class="visual-tag">Saison 2026</div>
                <div class="visual-title">Rejoignez<br>la communauté</div>
                <div class="visual-desc">Connectez-vous pour commenter les reviews des Grands Prix, partager vos analyses et suivre la saison avec d'autres passionnés de Formule 1.</div>
                <div class="stats-row">
                    <div>
                        <div class="stat-val">7</div>
                        <div class="stat-lbl">Reviews publiées</div>
                    </div>
                    <div>
                        <div class="stat-val">6+</div>
                        <div class="stat-lbl">Commentaires</div>
                    </div>
                    <div>
                        <div class="stat-val">15</div>
                        <div class="stat-lbl">GP restants</div>
                    </div>
                </div>
            </div>

            <div class="form-box">

                <div class="tabs">
                    <a href="/f1_2026/index.php?page=connexion" class="tab active">Se connecter</a>
                    <a href="/f1_2026/index.php?page=inscription" class="tab">S'inscrire</a>
                </div>

                <div class="form-box-title"><span class="title-accent"></span>Bon retour !</div>
                <div class="form-box-sub">Connectez-vous pour accéder à votre compte</div>

                <?php if ($erreur): ?>
                    <p class="erreur-msg"><?= htmlspecialchars($erreur) ?></p>
                <?php endif; ?>

                <form method="POST" action="/f1_2026/index.php?page=connexion">
                    <div class="form-group">
                        <label>Nom d'utilisateur ou e-mail</label>
                        <?php
                        $valeur_champ = !empty($identifiant_saisi) ? $identifiant_saisi : ($_COOKIE['remember_me'] ?? '');
                        ?>
                        <input type="text" name="identifiant" placeholder="votre@email.com ou pseudo" value="<?= htmlspecialchars($valeur_champ) ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Mot de passe</label>
                        <input type="password" name="password" placeholder="••••••••" required>
                    </div>

                    <div class="form-group-checkbox" style="display: flex; align-items: center; gap: 8px; margin-bottom: 20px;">
                        <input type="checkbox" name="remember" id="remember" <?= isset($_COOKIE['remember_me']) ? 'checked' : '' ?>>
                        <label for="remember" style="margin-bottom: 0; cursor: pointer; font-size: 0.9rem; color: #fff;">Se souvenir de moi</label>
                    </div>

                    <button type="submit" class="btn-submit">Se connecter</button>
                </form>

                <div class="switch-text">
                    Pas encore de compte ? <a href="/f1_2026/index.php?page=inscription" class="switch-link">Créer un compte</a>
                </div>

            </div>

        </div>
    </div>

    <div class="sidebar-overlay" id="sidebar-overlay" onclick="toggleSidebar()"></div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        }
    </script>

</body>

</html>