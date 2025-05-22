<?php
require_once('../classes/Reservation.php');

$reservationObj = new Reservation();

// Vérifier si un ID a été passé dans l'URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    // Récupérer l'ID de la réservation depuis l'URL
    $id = $_GET['id'];
    
    // Récupérer les détails de la réservation avant suppression
    $reservation = $reservationObj->getReservationById($id);
    
    // Supprimer la réservation
    if ($reservationObj->deleteReservation($id)) {

        header('Location: ../reservations.php?message=Réservation supprimée avec succès');
    } else {
        header('Location: ../reservations.php?error=Erreur lors de la suppression de la réservation');
    }
} else {
    header('Location: ../reservations.php');
}
exit;
?>