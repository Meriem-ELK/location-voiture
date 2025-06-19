<?php
require_once('../classes/Client.php');

$clientObj = new Client();
$message = '';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $client_data = [
        'nom' => $_POST['nom'],
        'prenom' => $_POST['prenom'],
        'adresse' => $_POST['adresse'],
        'email' => $_POST['email'],
        'telephone' => $_POST['telephone'],
        'permis_conduire' => $_POST['permis_conduire'],
        'date_inscription' => date('Y-m-d')
    ];
    
    if ($clientObj->addClient($client_data)) {
        header('Location: ../clients.php');
        exit;
    } else {
        $message = "Erreur lors de l'ajout du client.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Client</title>
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
        <?php if (!empty($message)): ?>
            <div class="message error"><?= $message ?></div>
        <?php endif; ?>

        <section class="form-control">
            <h2>Nouveau Client</h2>
            <form action="client-ajouter.php" method="post">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" required>
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" id="adresse" name="adresse" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="tel" id="telephone" name="telephone" required>
                </div>
                <div class="form-group">
                    <label for="permis_conduire">Numéro de permis</label>
                    <input type="text" id="permis_conduire" name="permis_conduire" required>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn add">Enregistrer</button>
                    <a href="../clients.php" class="btn cancel">Annuler</a>
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