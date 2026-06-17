<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier la review — F1 2026</title>
    <link rel="stylesheet" href="/f1_2026/css/global.css">
    <link rel="stylesheet" href="/f1_2026/css/modifier_review.css">
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
            <div class="breadcrumb">
                <a href="/f1_2026/index.php?page=gerer_reviews">Gérer les reviews</a> ›
                <span class="current">Modifier</span>
            </div>
            <div class="admin-topbadge">
                <svg style="width:12px;height:12px;fill:none;stroke:currentColor;stroke-width:1.5" viewBox="0 0 24 24">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                </svg>
                Accès Admin
            </div>
        </div>

        <div class="content">

            <div class="page-title-block">
                <div class="page-title">Modifier la review</div>
                <div class="page-sub">Modifiez les informations — l'aperçu se met à jour en temps réel</div>
            </div>

            <?php if ($erreur): ?>
                <p class="erreur-msg"><?= htmlspecialchars($erreur) ?></p>
            <?php endif; ?>

            <?php if ($succes): ?>
                <p class="succes-msg"><?= htmlspecialchars($succes) ?></p>
            <?php endif; ?>

            <div class="modifier-layout">

                <!-- Formulaire -->
                <div>
                    <form method="POST" action="/f1_2026/index.php?page=modifier_review&id=<?= $id ?>">

                        <div class="form-group">
                            <label>Titre de la review</label>
                            <input type="text" name="title" id="titre-input" value="<?= htmlspecialchars($review["title"]) ?>" oninput="updatePreview()" required>
                        </div>

                        <div class="form-group">
                            <label>Note — <span id="note-label"><?= $review["mark"] ?></span>/20</label>
                            <div class="note-row">
                                <div>
                                    <span class="note-display" id="note-display"><?= $review["mark"] ?></span>
                                    <span class="note-denom">/20</span>
                                </div>
                                <div class="slider-wrap">
                                    <input type="range" name="mark" id="note-slider" min="0" max="20" value="<?= $review["mark"] ?>" oninput="updateNote()">
                                    <div class="slider-labels">
                                        <span>0</span><span>5</span><span>10</span><span>15</span><span>20</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Texte de la review</label>
                            <textarea name="description" id="texte-input" oninput="updatePreview()" required><?= htmlspecialchars($review["description"]) ?></textarea>
                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-save">Enregistrer les modifications</button>
                            <a href="/f1_2026/index.php?page=gerer_reviews" class="btn-cancel">Annuler</a>
                        </div>

                    </form>
                </div>

                <!-- Aperçu -->
                <div class="preview-col">
                    <div class="preview-label">Aperçu de la carte</div>
                    <div class="preview-card">
                        <div class="preview-name" id="p-name"><?= htmlspecialchars($review["title"]) ?></div>
                        <div class="preview-score-row">
                            <span class="preview-score-num" id="p-score"><?= $review["mark"] ?></span>
                            <span class="preview-score-denom">/20</span>
                        </div>
                        <div class="preview-excerpt" id="p-excerpt"><?= htmlspecialchars(substr($review["description"], 0, 100)) ?>...</div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script>
        function updateNote() {
            const val = document.getElementById('note-slider').value;
            document.getElementById('note-display').textContent = val;
            document.getElementById('note-label').textContent = val;
            document.getElementById('p-score').textContent = val;
        }

        function updatePreview() {
            const titre = document.getElementById('titre-input').value;
            const texte = document.getElementById('texte-input').value;

            document.getElementById('p-name').textContent = titre || 'Titre de la review';

            const extrait = texte.length > 100 ? texte.substring(0, 100) + '...' : texte;
            document.getElementById('p-excerpt').textContent = extrait;
        }
    </script>

</body>

</html>