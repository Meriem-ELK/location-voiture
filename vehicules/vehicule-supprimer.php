<?php
require_once('../classes/Vehicule.php');

$vehiculeObj = new Vehicule();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Récupérer l'ID du véhicule depuis l'URL
    $id = $_GET['id'];
    
    // Vérifier si le véhicule est actuellement réservé
    if ($vehiculeObj->isVehiculeReserve($id)) {
        header('Location: ../vehicules.php?error=Impossible de supprimer ce véhicule car il possède des réservations actives');
    } else {

        if ($vehiculeObj->deleteVehicule($id)) {
            header('Location: ../vehicules.php?message=Véhicule supprimé avec succès');
        } else {
            header('Location: ../vehicules.php?error=Erreur lors de la suppression du véhicule');
        }
    }
} else {
    header('Location: ../vehicules.php');
}
exit;
?>