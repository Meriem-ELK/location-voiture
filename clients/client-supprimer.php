<?php
require_once('../classes/Client.php');

$clientObj = new Client();

// Vérifier si un ID a été passé dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    
    // Supprimer le client
    $result = $clientObj->deleteClient($id);
    
    if ($result === "reservation_exists") {
        header('Location: ../clients.php?error=Impossible de supprimer ce client car il a des réservations associées');
    } elseif ($result) {
        header('Location: ../clients.php?message=Client supprimé avec succès');
    } else {
        header('Location: ../clients.php?error=Erreur lors de la suppression du client');
    }
} else {
    header('Location: ../clients.php');
}
exit;
?>