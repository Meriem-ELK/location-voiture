<?php
require_once('../classes/Vehicule.php');

$vehiculeObj = new Vehicule();
$categories = $vehiculeObj->getAllCategories();
$message = '';

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehicule_data = [
        'marque' => $_POST['marque'],
        'modele' => $_POST['modele'],
        'annee' => $_POST['annee'],
        'immatriculation' => $_POST['immatriculation'],
        'couleur' => $_POST['couleur'],
        'kilometrage' => $_POST['kilometrage'],
        'disponible' => isset($_POST['disponible']) ? 1 : 0,
        'categorie_id' => $_POST['categorie_id']
    ];
    
    if ($vehiculeObj->addVehicule($vehicule_data)) {
        header('Location: ../vehicules.php');
        exit;
    } else {
        $message = "Erreur lors de l'ajout du véhicule.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Véhicule</title>
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
        <?php if (!empty($message)): ?>
            <div class="message error"><?= $message ?></div>
        <?php endif; ?>

        <section class="form-control">
            <h2>Nouveau Véhicule</h2>
            <form action="vehicule-ajouter.php" method="post">
                <div class="form-group">
                    <label for="marque">Marque</label>
                    <input type="text" id="marque" name="marque" required>
                </div>
                <div class="form-group">
                    <label for="modele">Modèle</label>
                    <input type="text" id="modele" name="modele" required>
                </div>
                <div class="form-group">
                    <label for="annee">Année</label>
                    <input type="number" id="annee" name="annee" min="1900" max="<?= date('Y') + 1 ?>" value="<?= date('Y') ?>">
                </div>
                <div class="form-group">
                    <label for="immatriculation">Immatriculation</label>
                    <input type="text" id="immatriculation" name="immatriculation" required>
                </div>
                <div class="form-group">
                    <label for="couleur">Couleur</label>
                    <input type="text" id="couleur" name="couleur">
                </div>
                <div class="form-group">
                    <label for="kilometrage">Kilométrage</label>
                    <input type="number" id="kilometrage" name="kilometrage" min="0" value="0">
                </div>
                <div class="form-group">
                    <label for="categorie_id">Catégorie</label>
                    <select id="categorie_id" name="categorie_id" required>
                        <option value="">Sélectionnez une catégorie</option>
                        <?php foreach($categories as $categorie): ?>
                            <option value="<?= $categorie['id'] ?>"><?= $categorie['nom'] ?> - <?= number_format($categorie['tarif_journalier'], 2, ',', ' ') ?> €/jour</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group checkbox-group">
                    <input type="checkbox" id="disponible" name="disponible" checked>
                    <label for="disponible">Disponible à la location</label>
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn add">Enregistrer</button>
                    <a href="../vehicules.php" class="btn cancel">Annuler</a>
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