<?php
// Inclure la classe Client
require_once('../classes/Client.php');

// Créer une instance de Client
$clientObj = new Client();
$message = '';

// Vérifier si un ID a été passé dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    // Récupérer les informations du client actuel
    $client = $clientObj->getClientById($id);
    
    // Vérifier si le client existe
    if (!$client) {
        header('Location: clients.php');
        exit;
    }
    
    // Traitement du formulaire de mise à jour
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Préparer les données du client à mettre à jour
        $client_data = [
            'nom' => $_POST['nom'],
            'prenom' => $_POST['prenom'],
            'adresse' => $_POST['adresse'],
            'email' => $_POST['email'],
            'telephone' => $_POST['telephone'],
            'permis_conduire' => $_POST['permis_conduire']
            // Ne pas mettre à jour la date d'inscription
        ];
        
        // Mettre à jour le client
        if ($clientObj->updateClient($client_data, $id)) {
            // Rediriger vers la page de détails après la mise à jour
            header('Location: client-details.php?id=' . $id);
            exit;
        } else {
            $message = "Erreur lors de la mise à jour du client.";
        }
    }
} else {
    // Rediriger vers la liste des clients si aucun ID n'est fourni
    header('Location: clients.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Client</title>
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
            <h2>Modifier un Client</h2>
            <div class="actions">
                <a href="client-details.php?id=<?= $id ?>" class="btn"><i class="fas fa-arrow-left"></i> Retour aux détails</a>
            </div>
        </div>

        <?php if (!empty($message)): ?>
            <div class="message error"><?= $message ?></div>
        <?php endif; ?>

        <section class="form-container">
            <h3>Informations du client</h3>
            <form action="client-modifier.php?id=<?= $id ?>" method="post">
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" id="nom" name="nom" value="<?= $client['nom'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" id="prenom" name="prenom" value="<?= $client['prenom'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" id="adresse" name="adresse" value="<?= $client['adresse'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?= $client['email'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="text" id="telephone" name="telephone" value="<?= $client['telephone'] ?>">
                </div>
                
                <div class="form-group">
                    <label for="permis_conduire">Numéro de permis</label>
                    <input type="text" id="permis_conduire" name="permis_conduire" value="<?= $client['permis_conduire'] ?>" required>
                </div>
                
                <div class="form-buttons">
                    <button type="submit" class="btn add"><i class="fas fa-save"></i> Enregistrer les modifications</button>
                    <a href="client-details.php?id=<?= $id ?>" class="btn cancel"><i class="fas fa-times"></i> Annuler</a>
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