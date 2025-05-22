<?php
require_once('../classes/Vehicule.php');

// Créer une instance de Vehicule
$vehiculeObj = new Vehicule();
$message = '';

// Vérifier si un ID a été passé dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    // Récupérer les informations du véhicule actuel
    $vehicule = $vehiculeObj->getVehiculeById($id);
    
    // Vérifier si le véhicule existe
    if (!$vehicule) {
        header('Location: vehicules.php');
        exit;
    }
    
    // Récupérer les catégories pour le formulaire
    $categories = $vehiculeObj->getAllCategories();
    
    // Traitement du formulaire de mise à jour
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 
        $vehicule_data = [
            'marque' => $_POST['marque'],
            'modele' => $_POST['modele'],
            'annee' => $_POST['annee'],
            'immatriculation' => $_POST['immatriculation'],
            'couleur' => $_POST['couleur'],
            'kilometrage' => $_POST['kilometrage'],
            'categorie_id' => $_POST['categorie_id'],
            'disponible' => isset($_POST['disponible']) ? 1 : 0
        ];
        
        if ($vehiculeObj->updateVehicule($id, $vehicule_data)) {
            header('Location: vehicule-details.php?id=' . $id);
            exit;
        } else {
            $message = "Erreur lors de la mise à jour du véhicule.";
        }
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
    <title>Modifier un Véhicule</title>
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
            <h2>Modifier un Véhicule</h2>
            <div class="actions">
                <a href="vehicule-details.php?id=<?= $id ?>" class="btn"><i class="fas fa-arrow-left"></i> Retour aux détails</a>
            </div>
        </div>

        <?php if (!empty($message)): ?>
            <div class="message error"><?= $message ?></div>
        <?php endif; ?>

        <section class="form-container">
            <h3>Informations du véhicule</h3>
            <form action="vehicule-modifier.php?id=<?= $id ?>" method="post">
                <div class="form-group">
                    <label for="marque">Marque</label>
                    <input type="text" id="marque" name="marque" value="<?= $vehicule['marque'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="modele">Modèle</label>
                    <input type="text" id="modele" name="modele" value="<?= $vehicule['modele'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="annee">Année</label>
                    <input type="number" id="annee" name="annee" value="<?= $vehicule['annee'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="immatriculation">Immatriculation</label>
                    <input type="text" id="immatriculation" name="immatriculation" value="<?= $vehicule['immatriculation'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="couleur">Couleur</label>
                    <input type="text" id="couleur" name="couleur" value="<?= $vehicule['couleur'] ?>">
                </div>
                
                <div class="form-group">
                    <label for="kilometrage">Kilométrage</label>
                    <input type="number" id="kilometrage" name="kilometrage" value="<?= $vehicule['kilometrage'] ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="categorie_id">Catégorie</label>
                    <select id="categorie_id" name="categorie_id" required>
                        <?php foreach ($categories as $categorie): ?>
                            <option value="<?= $categorie['id'] ?>" <?= ($categorie['id'] == $vehicule['categorie_id']) ? 'selected' : '' ?>>
                                <?= $categorie['nom'] ?> (<?= $categorie['tarif_journalier'] ?> €/jour)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-group checkbox">
                    <input type="checkbox" id="disponible" name="disponible" <?= $vehicule['disponible'] ? 'checked' : '' ?>>
                    <label for="disponible">Disponible</label>
                </div>
                
                <div class="form-buttons">
                    <button type="submit" class="btn add"><i class="fas fa-save"></i> Enregistrer les modifications</button>
                    <a href="vehicule-details.php?id=<?= $id ?>" class="btn cancel"><i class="fas fa-times"></i> Annuler</a>
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