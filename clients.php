<?php
require_once('classes/Client.php');

$clientObj = new Client();
$clients = $clientObj->getAllClients();
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
                    <li><a href="index.php"><i class="fas fa-home"></i> Accueil</a></li>
                    <li><a href="clients.php" class="active"><i class="fas fa-users"></i> Clients</a></li>
                    <li><a href="vehicules.php"><i class="fas fa-car-side"></i> Véhicules</a></li>
                    <li><a href="reservations.php"><i class="fas fa-calendar-check"></i> Réservations</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>

            <?php if(isset($_GET['message'])): ?>
                <div class="message success"><?= $_GET['message'] ?></div>
            <?php endif; ?>
            
            <?php if(isset($_GET['error'])): ?>
                <div class="message error"><?= $_GET['error'] ?></div>
            <?php endif; ?>

        <section class="clients-list">
            <h2>Liste des Clients</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($clients as $client): ?>
                    <tr>
                        <td><?= $client['nom'] ?></td>
                        <td><?= $client['prenom'] ?></td>
                        <td><?= $client['email'] ?></td>
                        <td><?= $client['telephone'] ?></td>
                        <td>
                            <a href="clients/client-details.php?id=<?= $client['id'] ?>" class="btn view">Voir</a>
                            <a href="clients/client-modifier.php?id=<?= $client['id'] ?>" class="btn edit">Modifier</a>
                            <a href="clients/client-supprimer.php?id=<?= $client['id'] ?>" class="btn delete" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce client?')">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <br>
            <a href="clients/client-ajouter.php" class="btn add">Ajouter un client</a>
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