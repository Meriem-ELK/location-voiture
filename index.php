<?php 
require_once('classes/Client.php');
require_once('classes/Vehicule.php');
require_once('classes/Reservation.php');

$clientObj = new Client();
$clients = $clientObj->getAllClients();

// Récupérer les statistiques pour le tableau de bord
$vehiculeObj = new Vehicule();
$reservationObj = new Reservation();

$totalClients = count($clients);
$totalVehicules = count($vehiculeObj->getAllVehicules());

$vehiculesDisponibles = $vehiculeObj->getNombreVehiculesDisponibles();
$totalReservations = count($reservationObj->getAllReservations());



?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LocAuto- Système de Location de Voitures</title>
    <link rel="stylesheet" href="css/style.css">
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
                    <li><a href="index.php" class="active"><i class="fas fa-home"></i> Accueil</a></li>
                    <li><a href="clients.php"><i class="fas fa-users"></i> Clients</a></li>
                    <li><a href="vehicules.php"><i class="fas fa-car-side"></i> Véhicules</a></li>
                    <li><a href="reservations.php"><i class="fas fa-calendar-check"></i> Réservations</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="page-header">
            <h2>Tableau de bord</h2>
            <div class="actions">
                <a href="reservations/reservation-ajouter.php" class="btn add"><i class="fas fa-plus"></i> Nouvelle réservation</a>
            </div>
        </div>

        <section class="dashboard">
            <div class="dashboard-item">
                <div class="stats-icon clients">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stats-info">
                    <h3>Clients</h3>
                    <p class="stats-number"><?php echo $totalClients; ?></p>
                    <a href="clients.php" class="stats-link">Voir tous les clients <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="dashboard-item">
                <div class="stats-icon vehicles">
                    <i class="fas fa-car-side"></i>
                </div>
                <div class="stats-info">
                    <h3>Véhicules</h3>
                    <p class="stats-number"><?php echo $totalVehicules; ?></p>
                    <p class="stats-detail"><?php echo $vehiculesDisponibles; ?> disponibles</p>
                    <a href="vehicules.php" class="stats-link">Voir tous les véhicules <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>

            <div class="dashboard-item">
                <div class="stats-icon reservations">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <div class="stats-info">
                    <h3>Réservations</h3>
                    <p class="stats-number"><?php echo $totalReservations; ?></p>
                    <a href="reservations.php" class="stats-link">Voir toutes les réservations <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </section>


        <section class="quick-actions">
            <h2>Actions rapides</h2>
            <div class="actions-grid">
                <a href="clients/client-ajouter.php" class="action-card">
                    <i class="fas fa-user-plus"></i>
                    <span>Ajouter un client</span>
                </a>
                <a href="vehicules/vehicule-ajouter.php" class="action-card">
                    <i class="fas fa-car-alt"></i>
                    <span>Ajouter un véhicule</span>
                </a>
                <a href="reservations/reservation-ajouter.php" class="action-card">
                    <i class="fas fa-calendar-plus"></i>
                    <span>Nouvelle réservation</span>
                </a>
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