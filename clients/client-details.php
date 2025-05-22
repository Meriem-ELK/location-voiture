<?php
require_once('../classes/Client.php');

$clientObj = new Client();

// Vérifier si un ID a été passé dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Récupérer l'ID du client depuis l'URL
    $id = $_GET['id'];
    
    // Récupérer les détails du client par son ID
    $client = $clientObj->getClientById($id);
    
    // Vérifier si le client existe
    if (!$client) {
        header('Location: clients.php');
        exit;
    }
} else {
    header('Location: clients.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Client</title>
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
                    <li><a href="../clients.php" class="active"><i class="fas fa-users"></i> Clients</a></li>
                    <li><a href="../vehicules.php"><i class="fas fa-car-side"></i> Véhicules</a></li>
                    <li><a href="../reservations.php"><i class="fas fa-calendar-check"></i> Réservations</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <div class="page-header">
            <h2>Détails du Client</h2>
            <div class="actions">
                <a href="client-modifier.php?id=<?= $client['id'] ?>" class="btn edit"><i class="fas fa-edit"></i> Modifier</a>
                <a href="../clients.php" class="btn"><i class="fas fa-arrow-left"></i> Retour à la liste</a>
            </div>
        </div>

        <section class="client-details">
            <div class="details-card">
                <div class="details-header">
                    <h3><?= $client['prenom'] . ' ' . $client['nom'] ?></h3>
                    <p class="client-id">Client #<?= $client['id'] ?></p>
                </div>
                
                <div class="details-content">
                    <div class="details-item">
                        <span class="label"><i class="fas fa-envelope"></i> Email:</span>
                        <span class="value"><?= $client['email'] ?></span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-phone"></i> Téléphone:</span>
                        <span class="value"><?= $client['telephone'] ?></span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-map-marker-alt"></i> Adresse:</span>
                        <span class="value"><?= $client['adresse'] ?></span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-id-card"></i> Permis de conduire:</span>
                        <span class="value"><?= $client['permis_conduire'] ?></span>
                    </div>
                    
                    <div class="details-item">
                        <span class="label"><i class="fas fa-calendar-alt"></i> Date d'inscription:</span>
                        <span class="value"><?= date('d/m/Y', strtotime($client['date_inscription'])) ?></span>
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