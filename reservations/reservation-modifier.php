<?php
require_once('../classes/Reservation.php');

$reservationObj = new Reservation();
$message = '';

// Vérifier si un ID a été passé dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    // Récupérer les informations de la réservation actuelle
    $reservation = $reservationObj->getReservationById($id);
    
    // Vérifier si la réservation existe
    if (!$reservation) {
        header('Location: ../reservations.php');
        exit;
    }
    
    // Récupérer tous les clients et véhicules pour le formulaire
    $clients = $reservationObj->getAllClients();
    $vehicules = $reservationObj->getAllVehicules();
    
    // Traitement du formulaire de mise à jour
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Vérification des dates
        $date_debut = $_POST['date_debut'];
        $date_fin = $_POST['date_fin'];
        $vehicule_id = $_POST['vehicule_id'];
        
        // Vérifier que la date de fin est après la date de début
        if (strtotime($date_fin) < strtotime($date_debut)) {
            $message = "La date de fin doit être après la date de début.";
        }
        // Vérifier que le véhicule est disponible pour cette période (en excluant la réservation actuelle)
        elseif (!$reservationObj->isVehiculeDisponible($vehicule_id, $date_debut, $date_fin, $id)) {
            $message = "Ce véhicule n'est pas disponible pour la période sélectionnée.";
        }
        else {
            // Calculer le prix total
            $prix_total = $reservationObj->calculerPrixTotal($vehicule_id, $date_debut, $date_fin);
            
            if ($prix_total === false) {
                $message = "Erreur lors du calcul du prix.";
            } else {
                // Préparer les données de la réservation à mettre à jour
                $reservation_data = [
                    'client_id' => $_POST['client_id'],
                    'vehicule_id' => $vehicule_id,
                    'date_debut' => $date_debut,
                    'date_fin' => $date_fin,
                    'prix_total' => $prix_total,
                    'statut' => $_POST['statut']
                ];
                
                // Mettre à jour la réservation
                if ($reservationObj->updateReservation($reservation_data, $id)) {
                    header('Location: reservation-details.php?id=' . $id);
                    exit;
                } else {
                    $message = "Erreur lors de la mise à jour de la réservation.";
                }
            }
        }
    }
} else {
    header('Location: ../reservations.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Réservation</title>
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
            <h2>Modifier une Réservation</h2>
            <div class="actions">
                <a href="reservation-details.php?id=<?= $id ?>" class="btn"><i class="fas fa-arrow-left"></i> Retour aux détails</a>
            </div>
        </div>

        <?php if (!empty($message)): ?>
            <div class="message error"><?= $message ?></div>
        <?php endif; ?>

        <section class="form-container">
            <h3>Informations de la réservation</h3>
            <form action="reservation-modifier.php?id=<?= $id ?>" method="post">
                <div class="form-group">
                    <label for="client_id">Client</label>
                    <select id="client_id" name="client_id" required>
                        <option value="">Sélectionner un client</option>
                        <?php foreach ($clients as $client): ?>
                            <option value="<?= $client['id'] ?>" <?= ($client['id'] == $reservation['client_id']) ? 'selected' : '' ?>>
                                <?= $client['nom'] . ' ' . $client['prenom'] ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="vehicule_id">Véhicule</label>
                    <select id="vehicule_id" name="vehicule_id" required>
                        
                        <option value="">Sélectionner un véhicule</option>
                            <?php foreach ($vehicules as $vehicule): ?>
                            <option value="<?= $vehicule['id'] ?>" <?= ($vehicule['id'] == $reservation['vehicule_id']) ? 'selected' : '' ?>>
                                <?= $vehicule['marque'] . ' ' . $vehicule['modele'] . ' - ' . $vehicule['immatriculation'] ?> 
                                (<?= $vehicule['categorie'] ?>, <?= $vehicule['tarif_journalier'] ?>€/jour)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="date_debut">Date de début</label>
                    <input type="date" id="date_debut" name="date_debut" value="<?= $reservation['date_debut'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="date_fin">Date de fin</label>
                    <input type="date" id="date_fin" name="date_fin" value="<?= $reservation['date_fin'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="statut">Statut</label>
                    <select id="statut" name="statut" required>
                        <option value="en attente" <?= ($reservation['statut'] == 'en attente') ? 'selected' : '' ?>>En attente</option>
                        <option value="confirmée" <?= ($reservation['statut'] == 'confirmée') ? 'selected' : '' ?>>Confirmée</option>
                        <option value="annulée" <?= ($reservation['statut'] == 'annulée') ? 'selected' : '' ?>>Annulée</option>
                        <option value="terminée" <?= ($reservation['statut'] == 'terminée') ? 'selected' : '' ?>>Terminée</option>
                    </select>
                </div>
                
                <div class="form-buttons">
                    <button type="submit" class="btn add"><i class="fas fa-save"></i> Enregistrer les modifications</button>
                    <a href="reservation-details.php?id=<?= $id ?>" class="btn cancel"><i class="fas fa-times"></i> Annuler</a>
                </div>
            </form>
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