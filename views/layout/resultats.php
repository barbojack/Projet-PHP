<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <title>Résultats — F1 2026</title>
    <link rel="stylesheet" href="/f1_2026/css/global.css">
    <link rel="stylesheet" href="/f1_2026/css/resultats.css">
    <script src="/f1_2026/javascript/script.js" defer></script>
</head>

<body>

    <!-- SIDEBAR -->
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
            <a href="/f1_2026/index.php?page=resultats" class="nav-item active">
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

            <?php if (isset($_SESSION["user_id"])): ?>
                <a href="/f1_2026/index.php?page=deconnexion" class="nav-item">
                    <svg class="nav-icon" viewBox="0 0 24 24">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
                    Déconnexion
                </a>
            <?php else: ?>
                <a href="/f1_2026/index.php?page=connexion" class="nav-item">
                    <svg class="nav-icon" viewBox="0 0 24 24">
                        <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4" />
                        <polyline points="10 17 15 12 10 7" />
                        <line x1="15" y1="12" x2="3" y2="12" />
                    </svg>
                    Connexion
                </a>
            <?php endif; ?>

            <?php if (isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1): ?>
                <div class="nav-section-label">Admin</div>
                <a href="/f1_2026/index.php?page=creer_review" class="nav-item">
                    <svg class="nav-icon" viewBox="0 0 24 24">
                        <line x1="12" y1="5" x2="12" y2="19" />
                        <line x1="5" y1="12" x2="19" y2="12" />
                    </svg>
                    Nouvelle review
                </a>
                <a href="/f1_2026/index.php?page=gerer_reviews" class="nav-item">
                    <svg class="nav-icon" viewBox="0 0 24 24">
                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                    </svg>
                    Gérer les reviews
                </a>
            <?php endif; ?>
        </nav>

        <div class="sidebar-bottom">
            <?php if (isset($_SESSION["user_id"])): ?>
                <div class="user-card">
                    <div class="avatar"><?= strtoupper(substr($_SESSION["username"], 0, 1)) ?></div>
                    <div>
                        <div class="user-name"><?= htmlspecialchars($_SESSION["username"]) ?></div>
                        <div class="user-role"><?= $_SESSION["isAdmin"] ? "Administrateur" : "Utilisateur" ?></div>
                    </div>
                </div>
            <?php else: ?>
                <div class="user-role">Non connecté</div>
            <?php endif; ?>
        </div>
    </div>

    <!-- MAIN -->
    <div class="main">

        <div class="topbar">
            <div class="topbar-left">Résultats</div>
        </div>

        <div class="content">
            <div class="page-title">Saison 2026 — Résultats F1</div>

            <div id="conteneur-courses">
                <p class="loading">Connexion aux stands et récupération de la saison...</p>
            </div>
        </div>
    </div>

</body>

</html>