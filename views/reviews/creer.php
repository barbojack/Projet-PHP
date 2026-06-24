<!DOCTYPE html>
<html lang="fr-FR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle review — F1 2026</title>
    <link rel="stylesheet" href="/f1_2026/css/global.css">
    <link rel="stylesheet" href="/f1_2026/css/creer_review.css">
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
            <a href="/f1_2026/index.php?page=creer_review" class="nav-item active">
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
            <div style="display:flex;align-items:center;gap:12px;">
                <button class="hamburger" onclick="toggleSidebar()" aria-label="Menu">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
                <div class="topbar-left">Nouvelle review</div>
            </div>
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

            <div class="page-title-block">
                <div class="page-title">Créer une review</div>
                <div class="page-sub">Remplissez le formulaire — l'aperçu se met à jour en temps réel</div>
            </div>

            <?php if ($erreur): ?>
                <p class="erreur-msg"><?= htmlspecialchars($erreur) ?></p>
            <?php endif; ?>

            <?php if ($succes): ?>
                <p class="succes-msg"><?= htmlspecialchars($succes) ?></p>
            <?php endif; ?>

            <div class="creer-layout">

                <!-- Formulaire -->
                <div>
                    <form method="POST" action="/f1_2026/index.php?page=creer_review" id="review-form">

                        <div class="form-grid">

                            <div class="form-group">
                                <label>Grand Prix</label>
                                <select name="title" id="gp-select" onchange="updatePreview()">
                                    <option value="">-- Choisir un Grand Prix --</option>
                                    <option value="Grand Prix d'Australie">round 01 — Grand Prix d'Australie</option>
                                    <option value="Grand Prix de Chine">round 02 — Grand Prix de Chine</option>
                                    <option value="Grand Prix du Japon">round 03 — Grand Prix du Japon</option>
                                    <option value="Grand Prix de Miami">round 04 — Grand Prix de Miami</option>
                                    <option value="Grand Prix du Canada">round 05 — Grand Prix du Canada</option>
                                    <option value="Grand Prix de Monaco">round 06 — Grand Prix de Monaco</option>
                                    <option value="Grand Prix de Barcelone">round 07 — Grand Prix de Barcelone</option>
                                    <option value="Grand Prix d'Autriche">round 08 — Grand Prix d'Autriche</option>
                                    <option value="Grand Prix de Grande-Bretagne">round 09 — Grand Prix de Grande-Bretagne</option>
                                    <option value="Grand Prix de Belgique">round 10 — Grand Prix de Belgique</option>
                                    <option value="Grand Prix d'Hongire">round 11 — Grand Prix d'Hongrie</option>
                                    <option value="Grand Prix des Pays-Bas">round 12 — Grand Prix des Pays-Bas</option>
                                    <option value="Grand Prix d'Italie">round 13 — Grand Prix d'Italie</option>
                                    <option value="Grand Prix de Madrid">round 14 — Grand Prix de Madrid</option>
                                    <option value="Grand Prix d'Azerbaijan">round 15 — Grand Prix d'Azerbaijan</option>
                                    <option value="Grand Prix de Singapoure">round 16 — Grand Prix de Singapoure</option>
                                    <option value="Grand Prix des Etats-Unis">round 17 — Grand Prix des Etats-Unis</option>
                                    <option value="Grand Prix du Mexique">round 18 — Grand Prix du Mexique</option>
                                    <option value="Grand Prix du Brésil">round 19 — Grand Prix du Brésil</option>
                                    <option value="Grand Prix de Las Vegas">round 20 — Grand Prix de Las Vegas</option>
                                    <option value="Grand Prix du Qatar">round 21 — Grand Prix du Qatar</option>
                                    <option value="Grand Prix d'Abu Dhabi">round 22 — Grand Prix d'Abu Dhabi</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Titre de la review</label>
                                <input type="text" name="custom_title" id="titre-input" placeholder="Ex : Un Grand Prix sous tension..." oninput="updatePreview()">
                            </div>

                            <div class="form-group full">
                                <label>Note — <span id="note-label">10</span>/20</label>
                                <div class="note-row">
                                    <div>
                                        <span class="note-display" id="note-display">10</span>
                                        <span class="note-denom">/20</span>
                                    </div>
                                    <div class="slider-wrap">
                                        <input type="range" name="mark" id="note-slider" min="0" max="20" value="10" oninput="updateNote()">
                                        <div class="slider-labels">
                                            <span>0</span><span>5</span><span>10</span><span>15</span><span>20</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group full">
                                <label>Texte de la review</label>
                                <textarea name="description" id="texte-input" placeholder="Rédigez votre analyse du Grand Prix..." oninput="updatePreview()"></textarea>
                            </div>

                        </div>

                        <div class="form-actions">
                            <button type="submit" class="btn-publish">Publier la review</button>
                            <button type="button" class="btn-draft">Sauvegarder en brouillon</button>
                        </div>

                    </form>
                </div>

                <!-- Aperçu -->
                <div class="preview-col">
                    <div class="preview-label">Aperçu de la carte</div>
                    <div class="preview-card">
                        <div class="preview-round" id="p-round">Round ?? · —</div>
                        <div class="preview-name" id="p-name">Nom du Grand Prix</div>
                        <div class="preview-score-row">
                            <span class="preview-score-num" id="p-score">10</span>
                            <span class="preview-score-denom">/20</span>
                        </div>
                        <div class="preview-excerpt" id="p-excerpt">Le texte de votre review apparaîtra ici...</div>
                        <div class="preview-footer">
                            <span class="preview-badge">Admin</span>
                            <span class="preview-date" id="p-date"></span>
                        </div>
                    </div>
                    <div class="preview-hint">L'aperçu reflète ce que les utilisateurs verront sur la page liste des reviews.</div>
                </div>

            </div>

        </div>
    </div>

    <!-- Overlay sidebar mobile -->
    <div class="sidebar-overlay" id="sidebar-overlay" onclick="toggleSidebar()"></div>

    <script>
        const gpData = {
            "Grand Prix d'Australie": {
                round: "Round 01",
                ville: "Melbourne"
            },
            "Grand Prix de Chine": {
                round: "Round 02",
                ville: "Shanghai"
            },
            "Grand Prix du Japon": {
                round: "Round 03",
                ville: "Suzuka"
            },
            "Grand Prix de Miami": {
                round: "Round 04",
                ville: "Miami"
            },
            "Grand Prix du Canada": {
                round: "Round 05",
                ville: "Montréal"
            },
            "Grand Prix de Monaco": {
                round: "Round 06",
                ville: "Monaco"
            },
            "Grand Prix de Barcelone": {
                round: "Round 07",
                ville: "Barcelone"
            },
            "Grand Prix d'Autriche": {
                round: "Round 08",
                ville: "Spielberg"
            },
            "Grand Prix de Grande-Bretagne": {
                round: "Round 09",
                ville: "Silverstone"
            },
            "Grand Prix de Belgique": {
                round: "Round 10",
                ville: "Spa"
            },
            "Grand Prix d'Hongire": {
                round: "Round 11",
                ville: "Budapest"
            },
            "Grand Prix des Pays-Bas": {
                round: "Round 12",
                ville: "Zandvoort"
            },
            "Grand Prix d'Italie": {
                round: "Round 13",
                ville: "Monza"
            },
            "Grand Prix de Madrid": {
                round: "Round 14",
                ville: "Madrid"
            },
            "Grand Prix d'Azerbaijan": {
                round: "Round 15",
                ville: "Bakou"
            },
            "Grand Prix de Singapoure": {
                round: "Round 16",
                ville: "Singapour"
            },
            "Grand Prix des Etats-Unis": {
                round: "Round 17",
                ville: "Austin"
            },
            "Grand Prix du Mexique": {
                round: "Round 18",
                ville: "Mexico"
            },
            "Grand Prix du Brésil": {
                round: "Round 19",
                ville: "São Paulo"
            },
            "Grand Prix de Las Vegas": {
                round: "Round 20",
                ville: "Las Vegas"
            },
            "Grand Prix du Qatar": {
                round: "Round 21",
                ville: "Lusail"
            },
            "Grand Prix d'Abu Dhabi": {
                round: "Round 22",
                ville: "Abu Dhabi"
            }
        };

        function updateNote() {
            const val = document.getElementById('note-slider').value;
            document.getElementById('note-display').textContent = val;
            document.getElementById('note-label').textContent = val;
            document.getElementById('p-score').textContent = val;
            updatePreview();
        }

        function updatePreview() {
            const gpVal = document.getElementById('gp-select').value;
            const texte = document.getElementById('texte-input').value;

            if (gpVal && gpData[gpVal]) {
                const data = gpData[gpVal];
                document.getElementById('p-round').textContent = data.round + ' · ' + data.ville;
                document.getElementById('p-name').textContent = gpVal;
                document.getElementById('p-name').style.color = 'var(--text-primary)';
            } else {
                document.getElementById('p-round').textContent = 'Round ?? · —';
                document.getElementById('p-name').textContent = 'Nom du Grand Prix';
            }

            if (texte.trim().length > 0) {
                const extrait = texte.length > 100 ? texte.substring(0, 100) + '...' : texte;
                document.getElementById('p-excerpt').textContent = extrait;
                document.getElementById('p-excerpt').style.fontStyle = 'normal';
                document.getElementById('p-excerpt').style.color = 'var(--text-secondary)';
            } else {
                document.getElementById('p-excerpt').textContent = 'Le texte de votre review apparaîtra ici...';
                document.getElementById('p-excerpt').style.fontStyle = 'italic';
                document.getElementById('p-excerpt').style.color = 'var(--text-muted)';
            }

            const now = new Date();
            document.getElementById('p-date').textContent = now.toLocaleDateString('fr-FR', {
                day: 'numeric',
                month: 'short'
            });
        }

        function toggleSidebar() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            sidebar.classList.toggle('open');
            overlay.classList.toggle('active');
        }

        updatePreview();
    </script>

</body>

</html>