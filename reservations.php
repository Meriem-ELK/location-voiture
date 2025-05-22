<?php
require_once('classes/Reservation.php');

$reservationObj = new Reservation();
$reservations = $reservationObj->getAllReservationsWithDetails();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LocAuto - Système de Location de Voitures</title>
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
                    <li><a href="index.php"><i class="fas fa-home"></i> Accueil</a></li>
                    <li><a href="clients.php"><i class="fas fa-users"></i> Clients</a></li>
                    <li><a href="vehicules.php"><i class="fas fa-car-side"></i> Véhicules</a></li>
                    <li><a href="reservations.php" class="active"><i class="fas fa-calendar-check"></i> Réservations</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="reservations-list">
            <h2>Liste des Réservations</h2>
            
            <?php if(isset($_GET['message'])): ?>
                <div class="message success"><?= $_GET['message'] ?></div>
            <?php endif; ?>
            
            <?php if(isset($_GET['error'])): ?>
                <div class="message error"><?= $_GET['error'] ?></div>
            <?php endif; ?>
            
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Véhicule</th>
                        <th>Date de début</th>
                        <th>Date de fin</th>
                        <th>Prix total</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($reservations)): ?>
                        <tr>
                            <td colspan="8" class="no-data">Aucune réservation trouvée.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach($reservations as $reservation): ?>
                            <tr>
                                <td><?= $reservation['id'] ?></td>
                                <td><?= $reservation['client_prenom'] . ' ' . $reservation['client_nom'] ?></td>
                                <td><?= $reservation['marque'] . ' ' . $reservation['modele'] . ' (' . $reservation['immatriculation'] . ')' ?></td>
                                <td><?= date('d/m/Y', strtotime($reservation['date_debut'])) ?></td>
                                <td><?= date('d/m/Y', strtotime($reservation['date_fin'])) ?></td>
                                <td><?= number_format($reservation['prix_total'], 2, ',', ' ') ?> €</td>
                                <td>
                                    <span class="status <?= strtolower($reservation['statut']) ?>">
                                        <?= $reservation['statut'] ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="reservations/reservation-details.php?id=<?= $reservation['id'] ?>" class="btn view">Voir</a>
                                    <a href="reservations/reservation-modifier.php?id=<?= $reservation['id'] ?>" class="btn edit">Modifier</a>
                                    <a href="reservations/reservation-supprimer.php?id=<?= $reservation['id'] ?>" class="btn delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette réservation?')">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            <br>
            <a href="reservations/reservation-ajouter.php" class="btn add">Ajouter une réservation</a>
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