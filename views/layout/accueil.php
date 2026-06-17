<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Accueil — F1 2026</title>
    <link rel="stylesheet" href="/f1_2026/css/global.css">
    <link rel="stylesheet" href="/f1_2026/css/acceuil.css">
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
            <a href="/f1_2026/index.php" class="nav-item active">
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
            <div class="topbar-left">Accueil</div>
            <div class="topbar-right">
                <div class="stat-pill">Saison <span>2026</span></div>
                <div class="stat-pill">Round <span>6 / 22</span></div>
            </div>
        </div>

        <div class="content">

            <!-- Hero -->
            <div class="hero">
                <div>
                    <div class="hero-tag">Championnat du Monde</div>
                    <div class="hero-title">Formule 1<br>Saison 2026</div>
                    <div class="hero-sub">Suivez les résultats de chaque Grand Prix, lisez les reviews des admins et commentez avec la communauté.</div>
                </div>
                <div class="hero-stats">
                    <div>
                        <div class="hero-stat-val">6</div>
                        <div class="hero-stat-lbl">Courses disputées</div>
                    </div>
                    <div>
                        <div class="hero-stat-val">16</div>
                        <div class="hero-stat-lbl">Courses restantes</div>
                    </div>
                    <div>
                        <div class="hero-stat-val">22</div>
                        <div class="hero-stat-lbl">Pilotes en piste</div>
                    </div>
                    <div>
                        <div class="hero-stat-val">11</div>
                        <div class="hero-stat-lbl">Écuries</div>
                    </div>
                </div>
            </div>

            <!-- Derniers résultats -->
            <div>
                <div class="section-header">
                    <div class="section-title">Derniers résultats</div>
                    <a href="/f1_2026/index.php?page=resultats" class="see-all">Voir tous les résultats ›</a>
                </div>
                <div class="results-grid">

                    <div class="result-card">
                        <div class="rc-round">Round 06 · Monaco</div>
                        <div class="rc-name">Monaco GP</div>
                        <div class="podium">
                            <div class="podium-row">
                                <span class="podium-pos p1">1</span>
                                <span class="podium-driver">A. Antonelli</span>
                                <span class="podium-team">Mercedes</span>
                            </div>
                            <div class="podium-row">
                                <span class="podium-pos p2">2</span>
                                <span class="podium-driver">L. Hamilton</span>
                                <span class="podium-team">Ferrari</span>
                            </div>
                            <div class="podium-row">
                                <span class="podium-pos p3">3</span>
                                <span class="podium-driver">I. Hadjar</span>
                                <span class="podium-team">Red Bull</span>
                            </div>
                        </div>
                    </div>

                    <div class="result-card">
                        <div class="rc-round">Round 05 · Montréal</div>
                        <div class="rc-name">Canadian GP</div>
                        <div class="podium">
                            <div class="podium-row">
                                <span class="podium-pos p1">1</span>
                                <span class="podium-driver">A. Antonelli</span>
                                <span class="podium-team">Mercedes</span>
                            </div>
                            <div class="podium-row">
                                <span class="podium-pos p2">2</span>
                                <span class="podium-driver">L. Hamilton</span>
                                <span class="podium-team">Ferrari</span>
                            </div>
                            <div class="podium-row">
                                <span class="podium-pos p3">3</span>
                                <span class="podium-driver">M. Verstappen</span>
                                <span class="podium-team">Red Bull</span>
                            </div>
                        </div>
                    </div>

                    <div class="result-card">
                        <div class="rc-round">Round 04 · Miami</div>
                        <div class="rc-name">Miami GP</div>
                        <div class="podium">
                            <div class="podium-row">
                                <span class="podium-pos p1">1</span>
                                <span class="podium-driver">A. Antonelli</span>
                                <span class="podium-team">Mercedes</span>
                            </div>
                            <div class="podium-row">
                                <span class="podium-pos p2">2</span>
                                <span class="podium-driver">L. Norris</span>
                                <span class="podium-team">McLaren</span>
                            </div>
                            <div class="podium-row">
                                <span class="podium-pos p3">3</span>
                                <span class="podium-driver">O. Piastri</span>
                                <span class="podium-team">McLaren</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Dernière review -->
            <?php
            require_once __DIR__ . '/../../models/Review.php';
            $reviewModelAcceuil = new Review($pdo);
            $reviews = $reviewModelAcceuil->findAll();
            $derniereReview = !empty($reviews) ? $reviews[0] : null;
            ?>

            <?php if ($derniereReview): ?>
                <div>
                    <div class="section-header">
                        <div class="section-title">Dernière review</div>
                        <a href="/f1_2026/index.php?page=reviews" class="see-all">Toutes les reviews ›</a>
                    </div>
                    <a href="/f1_2026/index.php?page=review_detail&id=<?= $derniereReview["id"] ?>" class="review-banner">
                        <div>
                            <span class="rb-score"><?= $derniereReview["mark"] ?></span>
                            <span class="rb-denom">/20</span>
                        </div>
                        <div class="rb-divider"></div>
                        <div>
                            <div class="rb-tag">Dernière review</div>
                            <div class="rb-name"><?= htmlspecialchars($derniereReview["title"]) ?></div>
                            <div class="rb-excerpt"><?= htmlspecialchars(substr($derniereReview["description"], 0, 100)) ?>...</div>
                        </div>
                        <div class="rb-arrow">›</div>
                    </a>
                </div>
            <?php endif; ?>

        </div>
    </div>

</body>

</html>