<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Gérer les reviews — F1 2026</title>
    <link rel="stylesheet" href="/f1_2026/css/global.css">
    <link rel="stylesheet" href="/f1_2026/css/gerer_reviews.css">
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
            <a href="/f1_2026/index.php?page=deconnexion" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                    <polyline points="16 17 21 12 16 7" />
                    <line x1="21" y1="12" x2="9" y2="12" />
                </svg>
                Déconnexion
            </a>

            <div class="nav-section-label">Admin</div>
            <a href="/f1_2026/index.php?page=creer_review" class="nav-item">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <line x1="12" y1="5" x2="12" y2="19" />
                    <line x1="5" y1="12" x2="19" y2="12" />
                </svg>
                Nouvelle review
            </a>
            <a href="/f1_2026/index.php?page=gerer_reviews" class="nav-item active">
                <svg class="nav-icon" viewBox="0 0 24 24">
                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                </svg>
                Gérer les reviews
            </a>
        </nav>

        <div class="sidebar-bottom">
            <div class="user-card">
                <div class="avatar"><?= strtoupper(substr($_SESSION["username"], 0, 1)) ?></div>
                <div>
                    <div class="user-name"><?= htmlspecialchars($_SESSION["username"]) ?></div>
                    <div class="user-role">Administrateur</div>
                </div>
            </div>
        </div>
    </div>

    <!-- MAIN -->
    <div class="main">

        <div class="topbar">
            <div class="topbar-left">Gérer les reviews</div>
            <div class="topbar-right">
                <div class="admin-topbadge">
                    <svg style="width:12px;height:12px;fill:none;stroke:currentColor;stroke-width:1.5" viewBox="0 0 24 24">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                    </svg>
                    Accès Admin
                </div>
            </div>
        </div>

        <div class="content">

            <!-- Stats -->
            <div class="stats-row">
                <div class="stat-card">
                    <div class="stat-icon red">
                        <svg viewBox="0 0 24 24">
                            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2" />
                        </svg>
                    </div>
                    <div>
                        <div class="stat-val"><?= count($reviews) ?></div>
                        <div class="stat-lbl">Reviews publiées</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon orange">
                        <svg viewBox="0 0 24 24">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                            <polyline points="14 2 14 8 20 8" />
                        </svg>
                    </div>
                    <div>
                        <div class="stat-val">0</div>
                        <div class="stat-lbl">Brouillons</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon green">
                        <svg viewBox="0 0 24 24">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                        </svg>
                    </div>
                    <div>
                        <div class="stat-val"><?= $totalCommentaires ?></div>
                        <div class="stat-lbl">Commentaires au total</div>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon gray">
                        <svg viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10" />
                            <polyline points="12 6 12 12 16 14" />
                        </svg>
                    </div>
                    <div>
                        <div class="stat-val"><?= 22 - count($reviews) ?></div>
                        <div class="stat-lbl">GP sans review</div>
                    </div>
                </div>
            </div>

            <!-- Tableau -->
            <div class="table-header">
                <div class="section-title">Toutes les reviews</div>
            </div>

            <table>
                <thead>
                    <tr>
                        <th>Grand Prix</th>
                        <th>Note</th>
                        <th>Statut</th>
                        <th>Commentaires</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reviews as $index => $review): ?>
                        <?php $nbCommentaires = $nbCommentairesParReview[$review["id"]] ?? 0; ?>
                        <tr>
                            <td>
                                <div class="td-round">Manche <?= str_pad($index + 1, 2, '0', STR_PAD_LEFT) ?></div>
                                <div class="td-name"><?= htmlspecialchars($review["title"]) ?></div>
                            </td>
                            <td>
                                <span class="score-badge"><?= $review["mark"] ?></span>
                                <span class="score-small">/20</span>
                            </td>
                            <td>
                                <span class="status-pill published">
                                    <span class="status-dot"></span>Publié
                                </span>
                            </td>
                            <td>
                                <span class="comments-count">
                                    <svg viewBox="0 0 24 24">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                    </svg>
                                    <?= $nbCommentaires ?>
                                </span>
                            </td>
                            <td>
                                <div class="actions">
                                    <a href="/f1_2026/index.php?page=review_detail&id=<?= $review["id"] ?>" class="btn-action">
                                        <svg viewBox="0 0 24 24">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z" />
                                            <circle cx="12" cy="12" r="3" />
                                        </svg>
                                        Voir
                                    </a>
                                    <a href="/f1_2026/index.php?page=modifier_review&id=<?= $review["id"] ?>" class="btn-action">
                                        <svg viewBox="0 0 24 24">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                        </svg>
                                        Modifier
                                    </a>
                                    <a href="#" class="btn-action danger" onclick="ouvrirModal(<?= $review["id"] ?>, '<?= addslashes(htmlspecialchars($review["title"])) ?>')">
                                        <svg viewBox="0 0 24 24">
                                            <polyline points="3 6 5 6 21 6" />
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                        </svg>
                                        Supprimer
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>

    <!-- MODALE SUPPRESSION -->
    <div class="modal-overlay" id="modal" style="display:none">
        <div class="modal">
            <div class="modal-icon">
                <svg viewBox="0 0 24 24">
                    <polyline points="3 6 5 6 21 6" />
                    <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                    <path d="M10 11v6" />
                    <path d="M14 11v6" />
                </svg>
            </div>
            <div class="modal-title">Supprimer la review</div>
            <div class="modal-sub" id="modal-sub">Cette action est irréversible.</div>
            <div class="modal-actions">
                <button class="modal-cancel" onclick="document.getElementById('modal').style.display='none'">Annuler</button>
                <a href="#" class="modal-confirm" id="modal-confirm-btn">Supprimer</a>
            </div>
        </div>
    </div>

    <script>
        function ouvrirModal(id, nom) {
            document.getElementById('modal-sub').textContent =
                'Vous allez supprimer la review "' + nom + '". Cette action est irréversible.';
            document.getElementById('modal-confirm-btn').href =
                '/f1_2026/index.php?page=supprimer_review&id=' + id;
            document.getElementById('modal').style.display = 'flex';
        }
    </script>

</body>

</html>