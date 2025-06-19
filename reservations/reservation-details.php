<?php
// Inclure la classe Reservation
require_once('../classes/Reservation.php');

// Créer une instance de Reservation
$reservationObj = new Reservation();

// Vérifier si un ID a été passé dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Récupérer l'ID de la réservation depuis l'URL
    $id = $_GET['id'];
    
    // Récupérer les détails complets de la réservation par son ID
    $reservation = $reservationObj->getReservationDetails($id);
    
    // Vérifier si la réservation existe
    if (!$reservation) {
        header('Location: ../reservations.php');
        exit;
    }
} else {
    header('Location: ../reservations.php');
    exit;
}

// Formater les dates
$date_debut_formattee = date('d/m/Y', strtotime($reservation['date_debut']));
$date_fin_formattee = date('d/m/Y', strtotime($reservation['date_fin']));

// Calculer la durée de la réservation
$debut = new DateTime($reservation['date_debut']);
$fin = new DateTime($reservation['date_fin']);
$duree = $debut->diff($fin)->days + 1; // +1 car on compte le jour de début

// Déterminer la classe CSS pour le statut
$statut_class = '';
switch ($reservation['statut']) {
    case 'confirmée':
        $statut_class = 'status-confirmed';
        break;
    case 'en attente':
        $statut_class = 'status-pending';
        break;
    case 'annulée':
        $statut_class = 'status-cancelled';
        break;
    case 'terminée':
        $statut_class = 'status-completed';
        break;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Réservation</title>
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
                    <li><a href="../vehicules.php"><i class="fas fa-car-side"></i> Véhicules</a></li>
                    <li><a href="../reservations.php" class="active"><i class="fas fa-calendar-check"></i> Réservations</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="page-header">
            <h2>Détails de la Réservation</h2>
            <div class="actions">
                <a href="reservation-modifier.php?id=<?= $reservation['id'] ?>" class="btn edit"><i class="fas fa-edit"></i> Modifier</a>
                <a href="../reservations.php" class="btn"><i class="fas fa-arrow-left"></i> Retour à la liste</a>
            </div>
        </div>

        <section class="details-section">

        <div class="details-card">
                <div class="details-header">
                    <h3>Informations</h3>
                </div>
                
                <div class="details-content">
                    <h4>Informations du Client</h4>
                    <div class="details-item">
                        <span class="label"><i class="fas fa-user"></i> Nom complet:</span>
                        <span class="value">
                            <a href="../client/client-details.php?id=<?= $reservation['client_id'] ?>">
                                <?= $reservation['client_prenom'] . ' ' . $reservation['client_nom'] ?>
                            </a>
                        </span>
                    </div>
                </div>

                <div class="reservation-summary">
                        <div class="summary-box">
                            <h4>Date de début</h4>
                            <p><i class="fas fa-calendar-day"></i> <?= $date_debut_formattee ?></p>
                        </div>
                        <div class="summary-box">
                            <h4>Date de fin</h4>
                            <p><i class="fas fa-calendar-day"></i> <?= $date_fin_formattee ?></p>
                        </div>
                        <div class="summary-box">
                            <h4>Durée</h4>
                            <p><i class="fas fa-clock"></i> <?= $duree ?> jour<?= ($duree > 1) ? 's' : '' ?></p>
                        </div>
                        <div class="summary-box">
                            <h4>Prix Total</h4>
                            <p class="price-tag"><?= number_format($reservation['prix_total'], 2, ',', ' ') ?> €</p>
                        </div>
                        <div class="summary-box">
                            <h4>Statut</h4>
                            <span class="status-badge <?= $statut_class ?>"><?= $reservation['statut'] ?></span>
                        </div>
                </div>

                <div class="details-content">
                    <h4>Informations du Véhicule</h4>
                    <div class="details-item">
                        <span class="label"><i class="fas fa-car"></i> Véhicule:</span>
                        <span class="value">
                            <?= $reservation['marque'] . ' ' . $reservation['modele'] ?>
                        </span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-tag"></i> Immatriculation:</span>
                        <span class="value"><?= $reservation['immatriculation'] ?></span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-list"></i> Catégorie:</span>
                        <span class="value"><?= $reservation['categorie'] ?></span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-euro-sign"></i> Tarif journalier:</span>
                        <span class="value"><?= number_format($reservation['tarif_journalier'], 2, ',', ' ') ?> €</span>
                    </div>
                </div>

       
                <div class="details-content">
                    <h4>Détails de la Réservation</h4>
                    <div class="details-item">
                        <span class="label"><i class="fas fa-hashtag"></i> Numéro de réservation:</span>
                        <span class="value"><?= $reservation['id'] ?></span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-calculator"></i> Calcul du prix:</span>
                        <span class="value">
                            <?= number_format($reservation['tarif_journalier'], 2, ',', ' ') ?> € × <?= $duree ?> jour<?= ($duree > 1) ? 's' : '' ?> = 
                            <?= number_format($reservation['prix_total'], 2, ',', ' ') ?> €
                        </span>
                    </div>
                </div>

                 </div>
           
        </section>

        <div class="actions-bottom">
            <a href="reservation-modifier.php?id=<?= $reservation['id'] ?>" class="btn edit"><i class="fas fa-edit"></i> Modifier la réservation</a>

        </div>
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