<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($review["title"]) ?> — F1 2026</title>
    <link rel="stylesheet" href="/f1_2026/css/global.css">
    <link rel="stylesheet" href="/f1_2026/css/review_detail.css">
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
            <a href="/f1_2026/index.php?page=reviews" class="nav-item active">
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
            <div style="display:flex;align-items:center;gap:12px;">
                <button class="hamburger" onclick="toggleSidebar()" aria-label="Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="breadcrumb">
                    <a href="/f1_2026/index.php?page=reviews">Reviews</a> ›
                    <span class="current"><?= htmlspecialchars($review["title"]) ?></span>
                </div>
            </div>
        </div>

        <div class="content">

            <div class="detail-layout">

                <!-- Colonne gauche : review -->
                <div>
                    <div class="review-round">Review</div>
                    <div class="review-title"><?= htmlspecialchars($review["title"]) ?></div>

                    <div class="review-meta">
                        <span class="admin-badge">Admin</span>
                        <span>·</span>
                        <span>Rédigé par <strong style="color:#ccc"><?= htmlspecialchars($review["username"]) ?></strong></span>
                    </div>

                    <div class="score-big">
                        <span class="score-big-num"><?= $review["mark"] ?></span>
                        <span class="score-big-denom">/20</span>
                        <div class="score-bar-wrap">
                            <div class="score-bar-label">Note globale</div>
                            <div class="score-bar-big">
                                <div class="score-fill" style="width: <?= ($review["mark"] / 20) * 100 ?>%"></div>
                            </div>
                            <?php
                            $note = $review["mark"];
                            if ($note >= 18) $verdict = "Course parfaite";
                            elseif ($note >= 16) $verdict = "Excellent Grand Prix";
                            elseif ($note >= 12) $verdict = "Bonne course";
                            elseif ($note >= 8) $verdict = "Correct";
                            elseif ($note >= 4) $verdict = "Décevant";
                            else $verdict = "Très décevant";
                            ?>
                            <div class="score-verdict"><?= $verdict ?></div>
                        </div>
                    </div>

                    <div class="review-body">
                        <?= nl2br(htmlspecialchars($review["description"])) ?>
                    </div>
                </div>

                <!-- Colonne droite : commentaires -->
                <div>
                    <div class="comments-title">
                        Commentaires
                        <span class="comments-count-badge"><?= count($commentaires) ?> commentaire<?= count($commentaires) > 1 ? 's' : '' ?></span>
                    </div>

                    <?php if (empty($commentaires)): ?>
                        <p class="no-comments">Aucun commentaire pour le moment.</p>
                    <?php else: ?>
                        <?php foreach ($commentaires as $commentaire): ?>
                            <div class="comment" id="comment-<?= $commentaire["id"] ?>">
                                <div class="comment-top">
                                    <div class="comment-avatar"><?= strtoupper(substr($commentaire["username"], 0, 1)) ?></div>
                                    <div class="comment-author"><?= htmlspecialchars($commentaire["username"]) ?></div>
                                </div>

                                <div class="comment-text" id="comment-text-<?= $commentaire["id"] ?>"><?= nl2br(htmlspecialchars($commentaire["content"])) ?></div>

                                <form method="POST" action="/f1_2026/index.php?page=modifier_commentaire&id=<?= $commentaire["id"] ?>&review_id=<?= $id ?>" class="comment-edit-form" id="comment-form-<?= $commentaire["id"] ?>" style="display:none">
                                    <textarea name="content" class="comment-edit-textarea"><?= htmlspecialchars($commentaire["content"]) ?></textarea>
                                    <div class="comment-edit-actions">
                                        <button type="submit">Enregistrer</button>
                                        <button type="button" onclick="annulerEdition(<?= $commentaire["id"] ?>)">Annuler</button>
                                    </div>
                                </form>

                                <?php if (isset($_SESSION["user_id"]) && $_SESSION["user_id"] == $commentaire["authorId"]): ?>
                                    <div class="comment-actions" id="comment-actions-<?= $commentaire["id"] ?>">
                                        <a href="#" onclick="modifierCommentaire(<?= $commentaire["id"] ?>); return false;">Modifier</a>
                                        <a href="#" class="danger" onclick="confirmerSuppression(<?= $commentaire["id"] ?>); return false;">Supprimer</a>
                                    </div>

                                    <div class="delete-confirm" id="delete-confirm-<?= $commentaire["id"] ?>" style="display:none">
                                        <span>Supprimer ce commentaire ?</span>
                                        <a href="/f1_2026/index.php?page=supprimer_commentaire&id=<?= $commentaire["id"] ?>&review_id=<?= $id ?>" class="confirm-yes">Oui, supprimer</a>
                                        <a href="#" onclick="annulerSuppression(<?= $commentaire["id"] ?>); return false;" class="confirm-no">Annuler</a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <div class="comment-form-block">
                        <?php if (isset($_SESSION["user_id"])): ?>
                            <div class="comment-form-label">Connecté en tant que <strong><?= htmlspecialchars($_SESSION["username"]) ?></strong> — Laissez un commentaire</div>

                            <?php if ($erreur): ?>
                                <p class="erreur-msg"><?= htmlspecialchars($erreur) ?></p>
                            <?php endif; ?>

                            <form method="POST" action="/f1_2026/index.php?page=review_detail&id=<?= $id ?>" class="comment-form">
                                <textarea name="content" placeholder="Votre avis sur ce Grand Prix..." required></textarea>
                                <button type="submit">Publier</button>
                            </form>
                        <?php else: ?>
                            <p class="login-prompt"><a href="/f1_2026/index.php?page=connexion">Connectez-vous</a> pour laisser un commentaire.</p>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- Overlay sidebar mobile -->
    <div class="sidebar-overlay" id="sidebar-overlay" onclick="toggleSidebar()"></div>

    <script>
        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        function modifierCommentaire(id) {
            document.getElementById('comment-text-' + id).style.display = 'none';
            document.getElementById('comment-actions-' + id).style.display = 'none';
            document.getElementById('comment-form-' + id).style.display = 'block';
        }

        function annulerEdition(id) {
            document.getElementById('comment-text-' + id).style.display = 'block';
            document.getElementById('comment-actions-' + id).style.display = 'flex';
            document.getElementById('comment-form-' + id).style.display = 'none';
        }

        function confirmerSuppression(id) {
            document.getElementById('comment-actions-' + id).style.display = 'none';
            document.getElementById('delete-confirm-' + id).style.display = 'flex';
        }

        function annulerSuppression(id) {
            document.getElementById('comment-actions-' + id).style.display = 'flex';
            document.getElementById('delete-confirm-' + id).style.display = 'none';
        }
    </script>

</body>

</html>