<?php
require_once('../classes/Vehicule.php');

$vehiculeObj = new Vehicule();

// Vérifier si un ID a été passé dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Récupérer l'ID du véhicule depuis l'URL
    $id = $_GET['id'];
    
    // Récupérer les détails du véhicule par son ID
    $vehicule = $vehiculeObj->getVehiculeById($id);
    
    // Vérifier si le véhicule existe
    if (!$vehicule) {
        header('Location: ../vehicules.php');
        exit;
    }
} else {
    header('Location: ../vehicules.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Véhicule</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <div class="header-container">
            <div class="logo">
                <i class="fas fa-car"></i>
                <h1>LocAuto</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="../index.php"><i class="fas fa-home"></i> Accueil</a></li>
                    <li><a href="../clients.php"><i class="fas fa-users"></i> Clients</a></li>
                    <li><a href="../vehicules.php" class="active"><i class="fas fa-car-side"></i> Véhicules</a></li>
                    <li><a href="../reservations.php"><i class="fas fa-calendar-check"></i> Réservations</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="page-header">
            <h2>Détails du Véhicule</h2>
            <div class="actions">
                <a href="vehicule-modifier.php?id=<?= $vehicule['id'] ?>" class="btn edit"><i class="fas fa-edit"></i> Modifier</a>
                <a href="../vehicules.php" class="btn"><i class="fas fa-arrow-left"></i> Retour à la liste</a>
            </div>
        </div>

        <section class="vehicule-details">
            <div class="details-card">
                <div class="details-header">
                    <h3><?= $vehicule['marque'] . ' ' . $vehicule['modele'] ?></h3>
                    <p class="vehicule-id">Véhicule #<?= $vehicule['id'] ?></p>
                </div>
                
                <div class="details-content">
                    <div class="details-item">
                        <span class="label"><i class="fas fa-car"></i> Immatriculation:</span>
                        <span class="value"><?= $vehicule['immatriculation'] ?></span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-calendar-alt"></i> Année:</span>
                        <span class="value"><?= $vehicule['annee'] ?></span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-palette"></i> Couleur:</span>
                        <span class="value"><?= $vehicule['couleur'] ?></span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-road"></i> Kilométrage:</span>
                        <span class="value"><?= number_format($vehicule['kilometrage'], 0, ',', ' ') ?> km</span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-tags"></i> Catégorie:</span>
                        <span class="value"><?= $vehicule['nom_categorie'] ?></span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-euro-sign"></i> Tarif journalier: </span>
                        <span class="value"> <?= number_format($vehicule['tarif_journalier'], 2, ',', ' ') ?> €</span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-check-circle"></i> Statut:</span>
                        <span class="value">
                            <?php if($vehicule['disponible']): ?>
                                <span class="badge badge-disponible">Disponible</span>
                            <?php else: ?>
                                <span class="badge badge-indisponible">Indisponible</span>
                            <?php endif; ?>
                        </span>
                    </div>
                </div>
            </div>

        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h2>LocAuto</h2>
                <p>Système de gestion de location de voitures</p>
            </div>
            <div class="footer-section">
                <h2>Contact</h2>
                <p><i class="fas fa-envelope"></i> contact@locauto.com</p>
                <p><i class="fas fa-phone"></i>555 555 88 99</p>
            </div>
            <div class="footer-section">
                <h2>Liens utiles</h2>
                <ul>
                    <li><a href="#">Aide</a></li>
                    <li><a href="#">Mentions légales</a></li>
                </ul>
            </div>
        </div>
        <div class="copyright">
            <p>Meriem El kouarir</p>
            <p>&copy; 2025 - LocAuto | Tous droits réservés</p>
        </div>
    </footer>
</body>
</html>